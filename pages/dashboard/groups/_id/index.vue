<template>
  <div v-if="group.data" id="group-profile">
    <div class="header-profile">
      <h1>Perfil do Grupo</h1>
      <hr />
    </div>
    <div class="card-profile md-card no-padding">
      <div class="__left">
        <img :src="getCapa" alt="" />

        <b-upload
          v-model="group.data.upload"
          @input="onFileChange"
          expanded
          required
          accept="image/*"
        >
          <a class="button is-primary is-fullwidth">
            <b-icon icon="upload"></b-icon>
            <span>{{ file.name || "Enviar Imagem" }}</span>
          </a>
        </b-upload>
      </div>
      <div class="__right">
        <ValidationObserver ref="observer" v-slot="{ handleSubmit }" tag="form">
          <b-field grouped>
            <b-field expanded label="Nome">
              <b-input type="text" v-model="group.data.name" expanded />
            </b-field>
            <b-field expanded label="Slug">
              <b-input type="text" v-model="group.data.slug" expanded />
              <p class="control">
                <span class="button is-info" @click="changeSlug">Gerar</span>
              </p>
            </b-field>
          </b-field>
          <b-field grouped>
            <b-field expanded label="Site">
              <b-input type="text" v-model="group.data.site" expanded />
            </b-field>
            <b-field expanded label="Feed">
              <b-input type="text" v-model="group.data.feed" expanded />
            </b-field>
          </b-field>
          <b-field grouped>
            <b-field expanded label="Doação Link">
              <b-input type="text" v-model="group.data.donation" expanded />
            </b-field>
            <b-field expanded label="Sistema">
              <b-switch
                v-model="group.data.is_active"
                :true-value="1"
                :false-value="0"
              >
                Ativada
              </b-switch>
            </b-field>
          </b-field>
          <b-field grouped>
            <b-field label="Sobre" expanded>
              <TuiEditor
                ref="toastuiEditor"
                v-if="group.data.id || $route.params.id == 'new'"
                :options="editorOptions"
                :initialValue="group.data.about"
              />
            </b-field>
          </b-field>
          <b-field grouped>
            <b-button @click="handleSubmit(sendForm)" type="is-primary" expanded>Salvar</b-button>
          </b-field>
        </ValidationObserver>
      </div>
    </div>
  </div>
</template>

<script>
import avatar from "vue-avatar";
export default {
  layout: "dashboard",
  middleware: ['permissions'],
  meta: {
    permissions: [
      'groups.edit'
    ]
  },
  components: {
    avatar
  },
  data() {
    return {
      //Configs
      editorOptions: {
        minHeight: "200px",
        useCommandShortcut: true,
        useDefaultHTMLSanitizer: true,
        usageStatistics: true,
        hideModeSwitch: true,
        toolbarItems: [
          "heading",
          "bold",
          "italic",
          "strike",
          "divider",
          "hr",
          "quote",
          "divider",
          "ul",
          "ol",
          "task",
          "indent",
          "outdent",
          "divider",
          "table",
          "link",
          "divider",
          "code",
          "codeblock"
        ]
      },
      //Data
      group: {
        data: {
          is_active: 1,
          about: "",
        },
        loading: false
      },
      //Internal
      file: {},
      url: null,
      loading: false
    };
  },
  computed: {
    getCapa: function() {
      return this.url
        ? this.url
        : this.group.data.image == null
        ? "https://storage.googleapis.com/centralnovel.com.br/grupos/default.jpg"
        : "https://storage.googleapis.com/centralnovel.com.br/" +
          this.group.data.image;
    }
  },
  mounted() {
    if(this.$route.params.id != 'new'){this.groupData()}
  },
  methods: {
    getFormData(obj, form, namespace) {
      var fd = form || new FormData();
      var formKey;

      for(var property in obj) {
        if(obj.hasOwnProperty(property)) {

          if(namespace) {
            formKey = namespace + '[' + property + ']';
          } else {
            formKey = property;
          }

          // if the property is an object, but not a File,
          // use recursivity.
          if(typeof obj[property] === 'object' && !(obj[property] instanceof File)) {

            this.getFormData(obj[property], fd, formKey);

          } else {

            // if it's a string or a File object
            fd.append(formKey, obj[property]);
          }

        }
      }

      return fd;

    },
    getHtml() {
      return this.$refs.toastuiEditor.invoke("getHtml");
    },
    groupData() {
      this.group.loading = true;
      this.$axios
        .$get("/groups/" + this.$route.params.id)
        .then(response => {
          var responseData = response.data;
          this.group.data = responseData;
          this.group.loading = false;
        })
        .catch(error => {
          this.$router.push("/dashboard/groups");
        });
    },
    //Imagem Capa
    onFileChange(e) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = e => {
          this.url = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    //Slug Actions
    changeSlug() {
      this.group.data.slug = this.slugify(this.group.data.title);
      this.$buefy.snackbar.open("Slug Gerado");
    },
    slugify(text) {
      return text
        .toString() // Cast to string
        .toLowerCase() // Convert the string to lowercase letters
        .normalize("NFD") // The normalize() method returns the Unicode Normalization Form of a given string.
        .trim() // Remove whitespace from both sides of a string
        .replace(/\s+/g, "-") // Replace spaces with -
        .replace(/[^\w\-]+/g, "") // Remove all non-word chars
        .replace(/\-\-+/g, "-"); // Replace multiple - with single -
    },
    async sendForm(){
      this.$buefy.toast.open({
        message: 'Carregando...'
      });
      this.errors = {}
      this.group.data.about = this.getHtml();
      if(this.$route.params.id != 'new'){this.group.data._method = 'PUT';}

      const config = { headers: { 'Content-Type': 'multipart/form-data' } };
      this.$axios
        .post(
          "groups"+(this.group.data.id ? '/'+this.group.data.id : ''),
          this.getFormData(this.group.data),
          config
        )
        .then(response => {
          var msg = ""
          if(response.status == 200){
            msg = "Ação Realizada!"
          }else{
            msg = "Ocorreu um Erro! ["+response.status+"]"
          }
          this.$buefy.toast.open({
            message: msg
          });
        })
        .catch(e => {
          if (!e.response) {
            this.errors = {
              'error': ["Erro na Rede - Servidor Offline"]
            }
          } else if (e.response.status === 400) {
            this.errors = e.response.data
          } else if (e.response.status === 500) {
            this.errors = ["[500] Ocorreu um Erro no Servidor"]
          } else {
            this.$buefy.toast.open({
              message: "[" + response.status + "] Ocorreu um Erro Inesperado."
            });
          }
        });
    }
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#group-profile {
  .header-profile {
    display: flex;
    flex-direction: row;
    @extend %vertical-align-middle;
    @extend %justify-between;
    margin-bottom: 12px;
    margin-top: 24px;
    h1 {
      font-size: 26px;
      margin-right: 32px;
      white-space: nowrap;
    }
    hr {
      width: 100%;
      border-color: #d9d9d9;
      background-color: #d9d9d9;
    }
  }
  .card-profile {
    display: flex;
    flex-direction: row;
    border: 1px solid #dfdfdf;
    margin-bottom: 36px;
    .__left {
      display: flex;
      flex-direction: column;
      @include col(4);
      @extend %justify-center;
      @extend %vertical-align-middle;
      padding: 18px;
      img {
        max-width: 100%;
        width: 100%;
        height: auto;
        padding-bottom: 18px;
      }
    }
    .__right {
      display: flex;
      flex-direction: column;
      @include col(8);
      border-left: 1px solid #dfdfdf;
      padding-left: 0px;
      padding-right: 0px;
      margin: 0px;
      @extend %justify-between;
      form {
        display: flex;
        flex-direction: column;
        @extend %justify-between;
        height: 100%;
        padding: 18px;
      }
    }
  }
}
</style>

<style lang="scss">
@import "@/assets/sass/main.scss";
#group-profile {
  input,
  select {
    border: none;
    border-radius: 0px;
    box-shadow: none;
    border-bottom: 1px solid #ebeff2;
    font-weight: normal;
    letter-spacing: 0.01em;
    color: #323c47;

    &:focus {
      border: none;
      box-shadow: none;
      border-bottom: 1px solid #818e9b;
    }
    &:hover {
      border: none;
      border-bottom: 1px solid #818e9b;
    }
  }
  .taginput-container {
    border: none;
    box-shadow: none;
  }
}
</style>
