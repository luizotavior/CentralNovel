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
                    <b-icon icon="pencil-circle"></b-icon> {{serie.releases_count}} Capítulos
                  </li>
                  <li>
                    <b-icon icon="pencil-circle"></b-icon> {{ serie.releases_mounth/4 }} Caps / Semana
                  </li>
                  <li>
                    <b-icon icon="heart"></b-icon> Em {{serie.favorites_count}} Bibliotecas
                  </li>
                  <li v-if="analytics && analytics >= 1">
                    <b-icon icon="eye"></b-icon> {{analytics}} Visualizações
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
                  icon-left="plus"
                  rounded
                >Adicionar à Biblioteca</b-button>
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

        <pre>{{serie}}</pre>
      </div>
    </div>
  </div>
</template>

<script>
import starRating from "@/components/starRating.vue";
import breadcrumb from '@/components/breadcrumb.vue';
export default {
  components: {
    breadcrumb,
    starRating
  },
  data () {
    return {
      serie: {},
      analytics: 0
    }
  },
  mounted () {
    this.serieData()
    this.analyticsData()
  },

  computed: {
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
    analyticsData () {
      this.$axios.$get('/analytics/?path=/series/' + this.$route.params.name).then(response => {
        this.analytics += parseInt(response.data[0][0])
      }).catch(e => {
      })
      this.$axios.$get('/analytics/?path=/novel/' + this.$route.params.name).then(response => {
        this.analytics += parseInt(response.data[0][0])
      }).catch(e => {
      })
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
              }
            }
            .__infos {
              display: flex;
              flex-direction: row;
              margin-bottom: 24px;
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
  }
}
</style>
