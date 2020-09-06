<template>
  <div id="page-group">
    <div class="__header">
      <div class="__container">
        <div class="__top">
        </div>
        <div class="__bottom">
          <div class="__left">
            <div class="__capa">
              <img
                :src="getCapa"
                alt=""
              />
            </div>
          </div>
          <div class="__right">
            <div class="__content">
              <div class="__title">
                <h1>{{ group.name }}</h1>
              </div>
              <div class="__infos">
                <ul>
                  <li>
                    <b-icon icon="book-open-page-variant"></b-icon>
                    {{ group.releases_count }} Lançamentos
                  </li>
                  <li>
                    <b-icon icon="calendar"></b-icon>
                    {{ group.releases_mounth / 4 }} Caps / Semana
                  </li>
                  <li v-if="group.pageviews && group.pageviews >= 1">
                    <b-icon icon="eye"></b-icon>
                    {{ group.pageviews }} Visualizações
                  </li>
                </ul>
              </div>

              <div class="__rating">
                <star-rating
                  size="is-medium"
                  :current-rating="group.averageRating"
                  :current-votes="group.numVotes"
                />
              </div>
            </div>
            <div class="__actions">
              <div>
                <b-button
                  tag="a"
                  target="_blank"
                  type="is-primary"
                  rounded
                  :href="group.site"
                >Acessar o Site</b-button>
                <b-button
                  v-if="group.donation"
                  tag="a"
                  target="_blank"
                  type="is-dark"
                  icon-left="currency-usd-circle-outline"
                  :href="group.donation"
                  rounded
                >Realizar Doação</b-button>
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
        <nav class="__group-nav">
          <ul>
            <li :class="{ active: bodyTab == 1 }">
              <span @click="bodyTab = 1">Sobre</span>
            </li>
            <li :class="{ active: bodyTab == 2 }">
              <span @click="bodyTab = 2">Lançamentos</span>
            </li>
            <hr />
          </ul>
        </nav>
        <div
          class="tab-about"
          v-if="bodyTab == 1"
        >
          <topic-title
            title="Sobre"
            size="is-size-4"
          />
          <div
            class="__about"
            v-html="group.about"
          />
          <reviews :data="group" />
        </div>
        <div
          class="tab-releases"
          v-if="bodyTab == 2"
        >
          <group-release-table
            v-if="group.id"
            :group="group"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import groupReleaseTable from "@/components/groupReleaseTable.vue";
import starRating from "@/components/starRating.vue";
import topicTitle from "@/components/topicTitle.vue";
import reviews from "@/components/reviews/index.vue";
import avatar from "vue-avatar";
export default {
  components: {
    groupReleaseTable,
    starRating,
    topicTitle,
    reviews,

    avatar
  },
  data () {
    return {
      group: {},
      bodyTab: 1
    };
  },
  mounted () {
    this.groupData();
  },

  computed: {
    getCapa: function () {
      return this.group.image == null
        ? "https://storage.googleapis.com/centralnovel.com.br/grupos/default.jpg"
        : "https://storage.googleapis.com/centralnovel.com.br/" +
        this.group.image;
    }
  },
  methods: {
    groupData () {
      this.$axios
        .$get(
          "/groups?pageview=true&paginate=0&first=true&releases_mounth=1&slug=" +
          this.$route.params.name
        )
        .then(response => {
          console.log(response.data.length);
          if (response.data.length === 0)
            throw { statusCode: 404, message: "group not found" };
          this.group = response.data;
        })
        .catch(e => {
          return this.$nuxt.error(e);
        });
    },
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#page-group {
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
    nav.__group-nav {
      width: 100%;
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
      .__about {
        margin-bottom: 48px;
      }
    }
  }
}
</style>
