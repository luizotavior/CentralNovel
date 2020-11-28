<template>
  <div id="page-perfil">
    <div class="md-card is-flex-column" v-if="data.id">
      <div class="__header is-borded">
        <div class="__title">

          <h1 class="is-size-6 has-text-weight-medium">
            Perfil do Feed
          </h1>
        </div>
        <p class="is-size-7">Bla bla bla bla</p>
      </div>
      <div class="__body margin-md-t">
        <div id="change">
          <div id="change-profile">
            <h1 class="is-size-6 has-text-weight-medium">
              Informação básica
            </h1>
            <form>
              <b-field
                expanded
                label="Título"
                v-if="data.title"
              >
                <b-input
                  type="text"
                  v-model="data.title"
                  disabled
                />
              </b-field>
              <b-field
                grouped
              >
              <b-field
                expanded
                label="Grupo"
                v-if="data.group"
              >
                <b-input
                  type="text"
                  v-model="data.group.name"
                  disabled
                />
              </b-field>
              </b-field>
              <b-field
                expanded
                label="Link Publicação"
                v-if="data.permalink"
              >
                <b-input
                  type="text"
                  v-model="data.permalink"
                  disabled
                />
              </b-field>
              <b-field
                grouped
              >
              <b-field
                expanded
                label="Publicado"
                v-if="data.published_at"
              >
                <b-input
                  type="text"
                  :value="$moment(data.published_at).format('lll')"
                  disabled
                />
              </b-field>
              <b-field
                expanded
                label="Criado no Sistema"
                v-if="data.created_at"
              >
                <b-input
                  type="text"
                  :value="$moment(data.created_at).format('lll')"
                  disabled
                />
              </b-field>
              </b-field>
            </form>
          </div>
          <div id="change-password">
            <h1 class="is-size-6 has-text-weight-medium">

            </h1>
            <form>
              <b-field label="Descrição" expanded>
                <TuiViewer :initialValue="data.description"/>
              </b-field>
            </form>
          </div>
        </div>

      </div>
    </div>
    <div id="releases" class="md-card no-padding" v-if="data.id">
    <div class="__header">
      <div class="__top">
        <h1 class="is-size-5 has-text-grey-darker has-text-weight-medium">
          Releases
        </h1>
        <div class="__top-button">
          <b-button
            type="is-info"
            outlined
            @click="isCardModalActive = true"
          >
            Adicionar
          </b-button>
        </div>

      </div>
    </div>
    <div class="__body">
      <ul class="items">
        <li
          v-for="release in data.releases"
          :key="release.id"
          class="item"
        >
          <div class="item--left">
            <a :href="'/dashboard/series/' + release.serie.id" target="_blank">
              <b-tag type="is-info" >
                  {{ release.serie.title }}
              </b-tag>
            </a>
          </div>
          <div class="item-option">
            <b-field>
              <b-field
                label="Arco"
              >
                <b-input
                 size="is-small"
                  type="text"
                  v-model="release.arc"
                />
              </b-field>
              <b-field
                label="Volume"
              >
                <b-input
                 size="is-small"
                  type="text"
                  v-model="release.volume"
                />
              </b-field>
              <b-field
                label="Capítulo"
              >
                <b-input
                 size="is-small"
                  type="text"
                  v-model="release.chapter"
                />
              </b-field>
              <b-field
                label="Parte"
              >
                <b-input
                 size="is-small"
                  type="text"
                  v-model="release.part"
                />
              </b-field>
              <div
                class=" buttons"
              >
                <b-button
                  @click="confirmUpdateRelease(release)"
                  icon-left="check"
                  type="is-info"
                >Salvar</b-button>
                <b-button
                  @click="confirmDeleteRelease(release.id)"
                  icon-left="delete"
                  type="is-danger"
                >Remover</b-button>
              </div>
            </b-field>
          </div>
        </li>
      </ul>
      <div
        v-if="data.releases.length == 0"
        class="alert_icon"
      >
        <b-icon
          icon="alert-circle"
          size="is-medium"
        />
        <h1>Nenhum item encontrado</h1>
      </div>
    </div>

    <b-modal
      :active.sync="isCardModalActive"
      :width="600"
      scroll="keep"
    >
      <collaborator-new @refresh="getAsyncData (query)" />
    </b-modal>

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
      //Configs
      isCardModalActive: false,
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
    this.feedData()
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
    feedData() {
      this.loading = true;
      this.$axios
        .$get("/feeds/" + this.$route.params.id)
        .then(response => {
          var responseData = response.data;
          this.data = responseData;
          this.loading = false;
        })
        .catch(error => {
          // this.$router.push("/dashboard/feeds");
        });
    },
    confirmUpdateRelease (release) {
      this.$buefy.dialog.confirm({
        title: "Update account",
        message:
          "Are you sure you want to <b>update</b> your account? This action cannot be undone.",
        confirmText: "Update Account",
        type: "is-success",
        hasIcon: true,
        onConfirm: () => this.updateRelease(release)
      });
    },
    updateRelease(release){
      this.$buefy.toast.open({
        message: 'Carregando...'
      })
      release._method = 'PUT'
      this.$axios
        .post(
          "releases/"+release.id,
          release
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
          this.feedData()
        })
        .catch(e => {
          if (!e.response) {
            this.errors = {
              'error': ["Erro na Rede - Servidor Offline"]
            }
          } else {
            this.$buefy.toast.open({
              message: "[" + response.status + "] Ocorreu um Erro Inesperado."
            });
          }
        })
    },
    confirmDeleteRelease (id) {
      this.$buefy.dialog.confirm({
        title: "Deleting account",
        message:
          "Are you sure you want to <b>delete</b> your account? This action cannot be undone.",
        confirmText: "Delete Account",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => this.deleteRelease(id)
      });
    },
    deleteRelease(id){
      this.$buefy.toast.open({
        message: 'Carregando...'
      })
      this.$axios
        .delete(
          "releases/"+id
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
          this.feedData()
        })
        .catch(e => {
          if (!e.response) {
            this.errors = {
              'error': ["Erro na Rede - Servidor Offline"]
            }
          } else {
            this.$buefy.toast.open({
              message: "[" + response.status + "] Ocorreu um Erro Inesperado."
            });
          }
        })
    },
  }
};

</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#releases.md-card {
  display: flex;
  flex-direction: column;
  padding-bottom: 0px;
  .__header {
    display: flex;
    flex-direction: column;
    width: 100%;
    padding: 0 1.8461538462rem;
    border-bottom: 1px solid #ebeff2;
    .__top {
      display: flex;
      flex-direction: row;
      @extend %justify-between;
      @extend %vertical-align-middle;
      margin: 1.3846153846rem 0;
      .__top-button {
        display: flex;
        flex-direction: row;
        align-items: center;

        a {
          display: flex;
          flex-direction: row;
          align-content: baseline;
          padding-left: 20px;
        }
      }
    }
    .__bottom {
      display: flex;
      flex-direction: column;
    }
  }
  .__body {
    display: flex;
    flex-direction: column;
    ul.items {
      display: flex;
      flex-direction: column;
      li.item {
        display: flex;
        flex-direction: row;
        @extend %justify-between;
        @extend %vertical-align-middle;
        border-bottom: 1px solid #ebeff2;
        min-height: 72px;
        padding: 24px;
        div.item--left {
          display: flex;
          flex-direction: row;
          @extend %vertical-align-middle;
          margin-left: 24px;
        }
        .item-option {
          align-content: center;

          .field {
            .control {
              padding-right: 10px;
            }
          }
        }
      }
    }
    .alert_icon {
      display: flex;
      flex-direction: column;
      align-items: center;
      color: #b5b5b5;
      font-size: 18px;
      padding: 24px 0px;
    }
  }
}
</style>

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
    .__bottom {
      input:focus {
        border: none;
        box-shadow: none;
        width: 100%;
      }
      .mdi-search input {
        background-color: #f5f8fa;
        border: none;
      }
    }
  }
  .__body {
    .item {
      .item-option {
        .field {
          .control {
            .select {
              select {
                border: none;
                border-bottom: 1px solid #d3d8dd;
                &:focus {
                  box-shadow: none;
                }
              }
            }
          }
          p {
            color: #c2cfe0;
            display: flex;
            align-items: center;
          }
        }
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
