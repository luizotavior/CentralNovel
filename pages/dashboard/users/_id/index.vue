<template>
  <div id="page-perfil">
    <div class="md-card is-flex-column" v-if="data.id">
      <div class="__header is-borded">
        <div class="__title">

          <h1 class="is-size-6 has-text-weight-medium">
            Perfil do Usuário
          </h1>
        </div>
        <p class="is-size-7">Bla bla bla bla</p>
      </div>
      <div class="__body margin-md-t">
        <div id="change-avatar">
          <avatar
            :size="118"
            :username="data.username"
          />
        </div>
        <div id="change">
          <div id="change-profile">
            <h1 class="is-size-6 has-text-weight-medium">
              Informação básica
            </h1>
            <form>
              <b-field
                expanded
                label="Nome"
                v-if="data.name"
              >
                <b-input
                  type="text"
                  v-model="data.name"
                  placeholder="Nome"
                  disabled
                />
              </b-field>
              <b-field
                expanded
                label="Username"
                v-if="data.username"
              >
                <b-input
                  type="text"
                  v-model="data.username"
                  disabled
                />
              </b-field>
              <b-field
                expanded
                label="Email"
                v-if="data.email"
              >
                <b-input
                  type="text"
                  v-model="data.email"
                  disabled
                />
              </b-field>
              <b-field
                expanded
                label="Sexo"
                v-if="data.sex"
              >
                <b-input
                  type="text"
                  v-model="data.sex"
                  disabled
                />
              </b-field>
              <b-field
                expanded
                label="Data de Nascimento"
                v-if="data.birthday_at"
              >
                <b-input
                  type="text"
                  v-model="data.birthday_at"
                  disabled
                />
              </b-field>
              <b-field
                expanded
                label="Membro Desde"
                v-if="data.created_at"
              >
                <b-input
                  type="text"
                  v-model="data.created_at"
                  disabled
                />
              </b-field>
            </form>
          </div>
          <div id="change-password">
            <h1 class="is-size-6 has-text-weight-medium">
              Configurações
            </h1>
            <form>
              <b-field
                expanded
                label="Função Principal"
              >
                <b-select multiple expanded v-model="data.roles">
                    <option :value="role" v-for="role in roles.data" :key="role.id">
                        {{role.name}}
                    </option>
                </b-select>
              </b-field>
              <div
                class="is-flex-left buttons"
                expanded
              >
                <b-button
                  @click="changeUserRoles"
                  type="is-info"
                  expanded
                >Salvar</b-button>
              </div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </div>

</template>

<script>
import avatar from 'vue-avatar';
export default {
  layout: "dashboard",
  middleware: ['permissions'],
  meta: {
    permissions: [
      'users.edit'
    ]
  },
  components: { avatar },

  data() {
    return {
      data: {
      },
      roles: {
        data: [],
        loading: false
      },
      loading: false
    };
  },
  mounted() {
    this.rolesData()
    this.userData()
  },
  methods: {
    changeUserRoles(){
      this.$buefy.toast.open({
        message: 'Carregando...'
      })
      this.data._method = 'PUT'
      this.$axios
        .post(
          "users/"+this.data.id,
          this.data
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
        })
    },
    userData() {
      this.loading = true;
      this.$axios
        .$get("/users/" + this.$route.params.id)
        .then(response => {
          var responseData = response.data;
          this.data = responseData;
          this.loading = false;
        })
        .catch(error => {
          //this.$router.push("/dashboard/series");
        });
    },
    rolesData() {
      this.roles.loading = true;
      this.$axios
        .$get("/roles?paginate=false")
        .then(response => {
          var responseData = response.data;
          this.roles.data = responseData;
          this.roles.loading = false;
        })
        .catch(error => {});
    },
    async sendForm(){
      this.$buefy.toast.open({
        message: 'Carregando...'
      });
      this.errors = {}
      this.serie.data._method = 'PUT';
      this.$axios
        .post(
          "series"+(this.data.id ? '/'+this.data.id : ''),
          this.data,
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

div.md-container {
  @extend %justify-between;
  div.__left {
    @include col(3);
    max-width: 280px;
  }
  div.__right {
    @include col(9);
  }
}
#page-perfil {
  margin-top: 40px;
  .__header {
    p {
      color: #707683;
    }
    .__title {
      h1 {
        color: #334d6e;
      }
    }
  }
  #change-avatar {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  #change {
    display: flex;
    flex-direction: row;
    width: 100%;
    padding-top: 50px;
    h1 {
      color: #192a3e;
      font-weight: 500;
      line-height: 22px;
      letter-spacing: 0.01em;
      padding-bottom: 30px;
    }

    #change-profile {
      width: 50%;
      padding-right: 30px;
    }
    #change-password {
      padding-left: 30px;
      border-left: 1px solid #ebeff2;
      width: 50%;
    }
  }
}
</style>

<style lang="scss" >
#page-perfil {
  #change {
    #change-profile,
    #change-password {
      form {
        .field {
          label {
            font-weight: 500;
            font-size: 11px;
            line-height: 16px;
            letter-spacing: 0.01em;
            color: #818e9b;
          }

          input {
            border: none;
            border-bottom: 1px solid #ebeff2;
            font-weight: normal;
            font-size: 13px;
            line-height: 19px;
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
        }
      }
    }
  }
  #signature {
    .__body {
      h1 {
        padding-bottom: 20px;
      }
    }
  }
}
</style>
