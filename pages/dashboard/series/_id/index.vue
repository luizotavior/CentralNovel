<template>
  <div v-if="serie.data" id="serie-profile">
    <div class="header-profile">
      <h1>Perfil da Serie</h1>
      <hr />
    </div>
    <div class="card-profile md-card no-padding">
      <div class="__left">
        <img :src="getCapa" alt="" />

        <b-upload
          v-model="serie.data.upload"
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
            <b-field expanded label="Titulo">
              <b-input type="text" v-model="serie.data.title" expanded />
            </b-field>

            <b-field label="Nomes Alternativos" expanded>
              <b-taginput
                v-model="serie.data.associated_names"
                field="name"
                icon="label"
                expanded
                :allow-new="true"
                :createTag="newTag"
              />
            </b-field>
            <b-field expanded label="Slug">
              <b-input type="text" v-model="serie.data.slug" expanded />
              <p class="control">
                <span class="button is-info" @click="changeSlug">Gerar</span>
              </p>
            </b-field>
          </b-field>
          <b-field grouped>
            <b-field expanded label="Linguagem Original">
              <b-select expanded v-model="serie.data.language_id">
                <option
                  v-for="option in languages.data"
                  :value="option.id"
                  :key="option.id"
                >
                  {{ option.name }}
                </option>
              </b-select>
            </b-field>
            <b-field expanded label="Tipo">
              <b-select expanded v-model="serie.data.type_id">
                <option
                  v-for="option in types.data"
                  :value="option.id"
                  :key="option.id"
                >
                  {{ option.name }}
                </option>
              </b-select>
            </b-field>
            <b-field expanded label="Status">
              <b-select expanded v-model="serie.data.status_id">
                <option
                  v-for="option in statuses.data"
                  :value="option.id"
                  :key="option.id"
                >
                  {{ option.name }}
                </option>
              </b-select>
            </b-field>
          </b-field>
          <b-field grouped>
            <b-field expanded label="Sistema">
              <b-switch
                v-model="serie.data.is_active"
                :true-value="1"
                :false-value="0"
              >
                Ativada
              </b-switch>
            </b-field>
            <b-field expanded label="Classificação">
              <b-switch
                v-model="serie.data.is_adult"
                :true-value="1"
                :false-value="0"
              >
                Adulto (+18)
              </b-switch>
            </b-field>
            <b-field expanded label="Situação">
              <b-switch
                v-model="serie.data.is_completed"
                :true-value="1"
                :false-value="0"
              >
                Completo
              </b-switch>
            </b-field>
            <b-field expanded label="Ano de Lançamento">
              <b-numberinput
                :controls="false"
                v-model="serie.data.year"
                :min="1900"
                :max="new Date().getFullYear()"
              ></b-numberinput>
            </b-field>
          </b-field>
          <b-field grouped>
            <b-field label="Autor" expanded>
              <b-taginput
                v-model="serie.data.authors"
                :data="authors.data"
                autocomplete
                :open-on-focus="true"
                field="name"
                icon="label"
                expanded
              >
              </b-taginput>
            </b-field>
            <b-field label="Tradutor" expanded>
              <b-taginput
                v-model="serie.data.translators"
                :data="users.data"
                autocomplete
                :open-on-focus="true"
                field="username"
                icon="label"
                expanded
              />
            </b-field>
            <b-field label="Editor" expanded>
              <b-taginput
                v-model="serie.data.editors"
                :data="users.data"
                autocomplete
                :open-on-focus="true"
                field="username"
                icon="label"
                expanded
              >
              </b-taginput>
            </b-field>
          </b-field>
          <b-field grouped>
            <b-field label="Generos" expanded>
              <b-taginput
                v-model="serie.data.genres"
                :data="genres.data"
                autocomplete
                :open-on-focus="true"
                field="name"
                icon="label"
                expanded
              >
              </b-taginput>
            </b-field>
            <b-field label="Tags" expanded>
              <b-taginput
                v-model="tags.temp"
                :data="tags.data"
                autocomplete
                :open-on-focus="true"
                field="name"
                icon="label"
                expanded
              >
              </b-taginput>
            </b-field>
          </b-field>
          <b-field grouped>
            <b-field label="Sinopse" expanded>
              <TuiEditor
                ref="toastuiEditor"
                v-if="serie.data.id || $route.params.id == 'new'"
                :options="editorOptions"
                :initialValue="serie.data.synopsis"
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
      'series.edit'
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
      serie: {
        data: {
          is_adult: 0,
          is_completed: 0,
          is_active: 1,
          synopsis: "",
        },
        loading: false
      },
      languages: {
        data: [],
        loading: false
      },
      types: {
        data: [],
        loading: false
      },
      statuses: {
        data: [],
        loading: false
      },
      authors: {
        data: [],
        loading: false
      },
      editors: {
        loading: false
      },
      translators: {
        data: [],
        loading: false
      },
      users: {
        data: [],
        loading: false
      },
      genres: {
        data: [],
        loading: false
      },
      tags: {
        data: [],
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
        : this.serie.data.image == null
        ? "https://storage.googleapis.com/centralnovel.com.br/novels/default.jpg"
        : "https://storage.googleapis.com/centralnovel.com.br/" +
          this.serie.data.image;
    }
  },
  mounted() {
    this.languagesData();
    this.typesData();
    this.typesData();
    this.statusesData();
    this.authorsData();
    this.usersData();
    this.tagsData();
    this.genresData();
    if(this.$route.params.id != 'new'){this.serieData()}
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
    newTag(tagToAdd) {
      return {
        id: 0,
        name: tagToAdd
      };
    },
    getHtml() {
      return this.$refs.toastuiEditor.invoke("getHtml");
    },
    serieData() {
      this.serie.loading = true;
      this.$axios
        .$get("/series/" + this.$route.params.id)
        .then(response => {
          var responseData = response.data;
          this.serie.data = responseData;
          this.serie.loading = false;
        })
        .catch(error => {
          this.$router.push("/dashboard/series");
        });
    },
    languagesData() {
      this.languages.loading = true;
      this.$axios
        .$get("/languages")
        .then(response => {
          var responseData = response.data;
          this.languages.data = responseData;
          this.languages.loading = false;
        })
        .catch(error => {});
    },
    typesData() {
      this.types.loading = true;
      this.$axios
        .$get("/types")
        .then(response => {
          var responseData = response.data;
          this.types.data = responseData;
          this.types.loading = false;
        })
        .catch(error => {});
    },
    statusesData() {
      this.statuses.loading = true;
      this.$axios
        .$get("/statuses")
        .then(response => {
          var responseData = response.data;
          this.statuses.data = responseData;
          this.statuses.loading = false;
        })
        .catch(error => {});
    },
    authorsData() {
      this.authors.loading = true;
      this.$axios
        .$get("/authors")
        .then(response => {
          var responseData = response.data;
          this.authors.data = responseData;
          this.authors.loading = false;
        })
        .catch(error => {});
    },
    tagsData() {
      this.tags.loading = true;
      this.$axios
        .$get("/tags?paginate=false")
        .then(response => {
          var responseData = response.data;
          this.tags.data = responseData;
          this.tags.loading = false;
        })
        .catch(error => {});
    },
    genresData() {
      this.genres.loading = true;
      this.$axios
        .$get("/genres?paginate=false")
        .then(response => {
          var responseData = response.data;
          this.genres.data = responseData;
          this.genres.loading = false;
        })
        .catch(error => {});
    },
    usersData() {
      this.users.loading = true;
      this.$axios
        .$get("/users?paginate=false")
        .then(response => {
          var responseData = response.data;
          this.users.data = responseData;
          this.users.loading = false;
        })
        .catch(error => {});
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
      this.serie.data.slug = this.slugify(this.serie.data.title);
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
      this.serie.data.synopsis = this.getHtml();
      if(this.$route.params.id != 'new'){this.serie.data._method = 'PUT';}

      const config = { headers: { 'Content-Type': 'multipart/form-data' } };
      this.$axios
        .post(
          "series"+(this.serie.data.id ? '/'+this.serie.data.id : ''),
          this.getFormData(this.serie.data),
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
#serie-profile {
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
#serie-profile {
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
