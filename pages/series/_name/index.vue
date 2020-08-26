<template>
  <div id="page-novel">

    <div class="__header">
      <div class="__container">
        <div class="__top">
          <breadcrumb :serie="serie" />
        </div>
        <div class="__bottom">
          <div class="__left">
            <div class="__capa">
              <img
                :src="getCapa"
                alt=""
              >
            </div>
          </div>
          <div class="__right">
            <div class="__content">
              <div class="__title">
                <h1>{{ serie.title }}</h1>
              </div>
              <div class="__infos">
                <ul>
                  <li>
                    <b-icon icon="book-open-page-variant"></b-icon> {{serie.releases_count}} Capítulos
                  </li>
                  <li>
                    <b-icon icon="calendar"></b-icon> {{ serie.releases_mounth/4 }} Caps / Semana
                  </li>
                  <li>
                    <b-icon icon="book"></b-icon> Em {{serie.favorites_count}} Bibliotecas
                  </li>
                  <li v-if="serie.pageviews && serie.pageviews >= 1">
                    <b-icon icon="eye"></b-icon> {{serie.pageviews}} Visualizações
                  </li>
                </ul>
              </div>
              <div
                v-if="serie.authors && serie.authors.length >= 1"
                class="__infos"
              >
                <span class="__list-title">{{ ( serie.authors.length > 1 ? 'Autores:' : 'Autor:') }}</span>
                <ul class="__authors">
                  <li
                    v-for="(author, index) in serie.authors"
                    :key="index"
                  >
                    <a :href="'/authors/'+author.slug">
                      {{author.name}}
                    </a>
                  </li>
                </ul>
              </div>
              <div
                v-if="serie.editors && serie.editors.length >= 1"
                class="__infos"
              >
                <span class="__list-title">{{ ( serie.editors.length > 1 ? 'Editores:' : 'Editor:') }}</span>
                <ul class="__authors">
                  <li
                    v-for="(editor, index) in serie.editors"
                    :key="index"
                  >
                    {{editor.name}}
                  </li>
                </ul>
              </div>
              <div
                v-if="serie.translators && serie.translators.length >= 1"
                class="__infos"
              >
                <span class="__list-title">{{ ( serie.translators.length > 1 ? 'Tradutores:' : 'Tradutor:') }}</span>
                <ul class="__authors">
                  <li
                    v-for="(translator, index) in serie.translators"
                    :key="index"
                  >
                    {{translator.name}}
                  </li>
                </ul>
              </div>

              <div class="__rating">
                <star-rating
                  size="is-medium"
                  :current-rating="serie.averageRating"
                  :current-votes="serie.numVotes"
                />

              </div>
            </div>
            <div class="__actions">
              <div>
                <b-button
                  type="is-primary"
                  rounded
                >Ler</b-button>
                <b-button
                  type="is-dark"
                  tag="router-link"
                  icon-left="plus"
                  v-if="!$store.state.auth.loggedIn"
                  to="/login"
                  rounded
                >Adicionar à Biblioteca</b-button>
                <b-button
                  type="is-dark"
                  icon-left="plus"
                  v-if="$store.state.auth.loggedIn && !inLibrary"
                  @click="addInLibrary"
                  rounded
                >Adicionar à Biblioteca</b-button>
                <b-button
                  type="is-dark"
                  icon-left="minus"
                  v-if="inLibrary && $store.state.auth.loggedIn"
                  @click="deleteInLibrary"
                  rounded
                >Remover da Biblioteca</b-button>
              </div>
              <div class="small">
                <a href="#">
                  <b-icon icon="flag"></b-icon> Reportar Problema
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="__body">
      <div class="__container">
        <nav class="__serie-nav">
          <ul>
            <li :class="{'active': bodyTab == 1}"><span @click="bodyTab = 1">Sobre</span></li>
            <li :class="{'active': bodyTab == 2}"><span @click="bodyTab = 2">Lançamentos</span></li>
            <hr />
          </ul>
        </nav>
        <div
          class="tab-about"
          v-if="bodyTab == 1"
        >
          <topic-title
            title="Sinopse"
            size="is-size-4"
          />
          <div
            class="__synopsis"
            v-html="serie.synopsis"
          />
          <div class="__reviews">
            <div class="__title">
              <h2>Avaliações</h2>
              <star-rating
                :current-rating="serie.averageRating"
                :current-votes="serie.numVotes"
              />
            </div>
            <div class="__content">
              <div class="__review-header">
                <div class="__review-header--left">
                  <ul>
                    <li>
                      <span>Qualidade de Tradução</span>
                      <star-rating
                        :current-rating="5"
                        :only-star="true"
                      />
                    </li>
                    <li>
                      <span>Estabilidade de atualizações</span>
                      <star-rating
                        :current-rating="5"
                        :only-star="true"
                      />
                    </li>
                    <li>
                      <span>Desenvolvimento de história</span>
                      <star-rating
                        :current-rating="5"
                        :only-star="true"
                      />
                    </li>
                    <li>
                      <span>Design de personagem</span>
                      <star-rating
                        :current-rating="5"
                        :only-star="true"
                      />
                    </li>
                    <li>
                      <span>Fundo Mundial</span>
                      <star-rating
                        :current-rating="5"
                        :only-star="true"
                      />
                    </li>
                  </ul>
                </div>
                <div class="__review-header--right">
                  <span>Compartilhe suas idéias com outras pessoas</span>
                  <b-button
                    type="is-dark"
                    size="is-medium"
                    icon-left="chat"
                    rounded
                  >Escreva uma crítica</b-button>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="tab-releases"
          v-if="bodyTab == 2"
        >
          <release-table
            v-if="serie.id"
            :serie="serie"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import releaseTable from '@/components/releaseTable.vue';
import starRating from "@/components/starRating.vue";
import breadcrumb from '@/components/breadcrumb.vue';
import topicTitle from '@/components/topicTitle.vue';
export default {
  components: {
    breadcrumb,
    releaseTable,
    starRating,
    topicTitle
  },
  data () {
    return {
      serie: {},
      bodyTab: 1,
    }
  },
  mounted () {
    this.serieData()
  },

  computed: {
    inLibrary: function () {
      return ((this.serie.in_library && Object.keys(this.serie.in_library).length != 1) ? false : true)
    },
    getCapa: function () {
      return this.serie.image == null ? "https://storage.googleapis.com/centralnovel.com.br/novels/default.jpg" : 'https://storage.googleapis.com/centralnovel.com.br/' + this.serie.image;
    },
  },
  methods: {
    serieData () {
      this.$axios.$get('/series?paginate=0&first=1&releases_mounth=1&slug=' + this.$route.params.name).then(response => {
        console.log(response.data.length)
        if (response.data.length === 0) throw ({ statusCode: 404, message: 'Serie not found' })
        this.serie = response.data
      }).catch(e => {
        return this.$nuxt.error(e)
      })
    },
    addInLibrary () {
      this.$axios
        .post("user/library", { series: [this.serie.id] })
        .then(response => {
          this.$buefy.toast.open({
            message: "Adicionado aos Favoritos"
          });
          this.serieData()
        })
        .catch(e => {
          this.$buefy.toast.open({
            message: "[" + e.status + "] Ocorreu um Erro Inesperado."
          });
        });
    },
    deleteInLibrary () {

      this.$axios
        .delete("user/library", { data: { series: [this.serie.id] } })
        .then(response => {
          this.$buefy.toast.open({
            message: "Removido dos Favoritos"
          });
          this.serieData()
        })
        .catch(e => {
          this.$buefy.toast.open({
            message: "[" + e.status + "] Ocorreu um Erro Inesperado."
          });
        });
    }
  }
}
</script>

<style lang="scss">
@import "@/assets/sass/main.scss";
#page-novel {
  .__header,
  .__body {
    display: flex;
    flex-direction: row;
    @extend %justify-center;
    .__container {
      display: flex;
      flex-direction: column;
      @extend %row;
      width: 100%;
    }
  }
  .__header {
    background-color: #f5f6fc;
    border-bottom: 1px solid #dcdce2;
    height: auto;

    .__container {
      > .__top {
      }
      > .__bottom {
        display: flex;
        flex-direction: row;
        > .__left {
          display: flex;
          flex-direction: column;
          width: 100%;
          max-width: 300px;
          margin-right: 60px;
          .__capa {
            max-height: 400px;
            img {
              width: 100%;
              height: auto;
              max-height: 400px;
            }
          }
        }
        > .__right {
          display: flex;
          flex-direction: column;
          @extend %justify-between;
          width: 100%;
          .__content {
            .__title {
              margin-bottom: 12px;
              h1 {
                font-size: 36px;
                font-weight: 600;
                color: #000;
              }
            }
            .__infos {
              display: flex;
              flex-direction: row;
              margin-bottom: 24px;
              color: #000;
              .__list-title {
                margin-right: 12px;
              }
              ul {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                padding: 0;
                margin: 0;
                li {
                  display: flex;
                  flex-direction: row;
                  flex-wrap: nowrap;
                  padding: 0;
                  margin: 0;
                  margin-right: 24px;
                  @extend %vertical-align-middle;
                  .icon {
                    margin-right: 6px;
                  }
                }
              }
            }
            .__rating {
              margin-bottom: 24px;
            }
          }
          .__actions {
            margin-bottom: 12px;
            display: flex;
            flex-direction: column;
            button {
              text-transform: uppercase;
              padding: 21px 30px;
              &:nth-child(2) {
                margin-left: 12px;
              }
            }
            .small {
              margin-top: 12px;
              a {
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                @extend %vertical-align-middle;
                color: #83848f;
                font-size: 14px;
                .icon .mdi:before {
                  font-size: 16px !important;
                }
                &:hover {
                  color: $primary;
                }
              }
            }
          }
        }
      }
    }
  }
  .__body {
    background-color: #fff;
    min-height: 480px;
    nav.__serie-nav {
      widows: 100%;
      max-width: 450px;
      margin-top: 24px;
      margin-bottom: 48px;
      ul {
        display: flex;
        flex-direction: row;
        position: relative;
        li {
          display: flex;
          flex-direction: column;
          text-align: center;
          @include col(6);
          margin: 0;

          span {
            display: inline-block;
            font-size: 30px;
            text-decoration: none;
            color: #333;
            cursor: pointer;
          }

          &:nth-child(1).active ~ hr {
            margin-right: 50%;
          }
          &:nth-child(2).active ~ hr {
            margin-left: 50%;
          }
          &:nth-child(1):hover ~ hr {
            margin-right: 50% !important;
            margin-left: 0;
          }
          &:nth-child(2):hover ~ hr {
            margin-left: 50% !important;
            margin-right: 0;
          }
        }

        hr {
          position: absolute;
          bottom: 0px;
          height: 0.25rem;
          width: 48%;
          margin: 0;
          height: 3px;
          background: #83848f;
          border: none;
          transition: 0.25s ease-in-out;
        }
      }
    }
    div.tab-releases {
    }
    div.tab-about {
      .topic-title {
        padding: 0px;
        h2 {
          font-weight: 700;
        }
      }
      p {
        line-height: 28px;
      }
      .__synopsis {
        margin-bottom: 48px;
      }
      .__reviews {
        display: flex;
        flex-direction: column;
        div.__title {
          margin-bottom: 22px;
          display: flex;
          flex-direction: row;
          padding: 0;
          @extend %vertical-align-middle;
          h2 {
            font-size: 32px;
            margin-right: 12px;
          }
        }
        div.__content {
          display: flex;
          flex-direction: column;
          .__review-header {
            display: flex;
            flex-direction: row;
            border-top: 2px solid #d7d8e0;
            border-bottom: 2px solid #d7d8e0;
            margin-bottom: 24px;
            .__review-header--left {
              display: flex;
              flex-direction: column;
              border-right: 2px solid #d7d8e0;
              @include col(5);
              line-height: 32px;
              padding: 24px 32px 24px 0;
              > ul {
                display: flex;
                flex-direction: column;
                li {
                  display: flex;
                  flex-direction: row;
                  flex-wrap: nowrap;
                  @extend %justify-between;
                  @extend %vertical-align-middle;
                }
              }
            }
            .__review-header--right {
              display: flex;
              flex-direction: column;
              @include col(7);
              @extend %justify-center;
              @extend %vertical-align-middle;
              text-align: center;
              > span {
                margin-bottom: 12px;
              }
            }
          }
        }
      }
    }
  }
}
</style>
