<template>
  <div id="page-novels">
    <div class="section-filter">
      <div class="__container">
        <div class="filter">
          <span class="__title">Gênero</span>
          <ul class="__options">
            <li
              v-for="(genre, index) in genres"
              :key="index"
            >
              <span
                @click="genreClick(genre)"
                :class="{
                  active: genre.id == selected.genre.id
                }"
              >
                {{ genre.name }}
              </span>
            </li>
          </ul>
        </div>
        <div class="filter-selects">
          <multiselect
            v-model="selected.language"
            deselect-label="Não é possível remover este valor"
            track-by="name"
            label="name"
            :options="languages"
            @input="changeFilter()"
            :preselect-first="true"
            :allow-empty="false"
          >
            <template
              slot="singleLabel"
              slot-scope="{ option }"
            >
              {{ option.name }}</template>
          </multiselect>
          <multiselect
            v-model="selected.status"
            deselect-label="Não é possível remover este valor"
            track-by="name"
            label="name"
            @input="changeFilter"
            :options="statuses"
            :preselect-first="true"
            :allow-empty="false"
          >
            <template
              slot="singleLabel"
              slot-scope="{ option }"
            >
              {{ option.name }}</template>
          </multiselect>
          <multiselect
            v-model="selected.sortOrder"
            deselect-label="Não é possível remover este valor"
            track-by="name"
            label="name"
            :options="sortOrder"
            @input="changeFilter"
            :preselect-first="true"
            :allow-empty="false"
          >
            <template
              slot="singleLabel"
              slot-scope="{ option }"
            >
              {{ option.name }}</template>
          </multiselect>
        </div>
      </div>
    </div>
    <div class="section-series">
      <div class="__container">
        <ul
          class="list-series"
          v-infinite-scroll="loadMore"
          infinite-scroll-disabled="paginate.busy"
          infinite-scroll-distance="paginate.perPage"
        >
          <li
            v-for="(novel, index) in series"
            :key="index"
            class="--item"
            style="margin-bottom: 2rem;"
            data-aos="slide-up"
            data-aos-offset="100"
            data-aos-easing="ease-out-back"
            data-aos-once="true"
          >
            <card-novel
              :novel="novel"
              :rating="true"
            />
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import cardNovel from "@/components/cardNovel.vue";
import Multiselect from "vue-multiselect";

export default {
  name: "Novels",
  components: { cardNovel, Multiselect },
  data () {
    return {
      genres: [
        {
          id: 0,
          name: "Todos"
        }
      ],
      statuses: [
        {
          id: 0,
          name: "Todos"
        }
      ],
      languages: [
        {
          id: 0,
          name: "Todos"
        }
      ],
      sortOrder: [
        {
          id: 1,
          name: "Alfabética"
        },
        {
          id: 1,
          name: "Mais Capítulos"
        },
        {
          id: 1,
          name: "Mais Acessadas"
        },
        {
          id: 1,
          name: "Melhores Avaliadas"
        },
        {
          id: 1,
          name: "Recém Adicionadas"
        }
      ],
      isFetching: true,
      series: [],
      seriesInfo: [],
      selected: {
        genre: {
          id: 0,
          name: "Todos"
        },
        status: {
          id: 0,
          name: "Todos"
        },
        language: {
          id: 0,
          name: "Todos"
        },
        sortOrder: null
      },
      paginate: {
        busy: false,
        limit: 20,
        perPage: 12,
        page: 0
      }
    };
  },
  methods: {
    recoveryQueryUrl () {
      if (this.$route.query.genre) {
        this.selected.genre.id = this.$route.query.genre
      }
    },
    genresData () {
      this.isFetching = true;
      this.$axios
        .$get("/genres")
        .then(data => {
          this.genres = this.statuses.concat(data.data);
          this.isFetching = false;
        })
        .catch(error => {
          this.isFetching = true;
        });
    },
    StatusesData () {
      this.isFetching = true;
      this.$axios
        .$get("/statuses")
        .then(data => {
          this.statuses = this.statuses.concat(data.data);
          this.isFetching = false;
        })
        .catch(error => {
          this.isFetching = true;
        });
    },
    LanguagesData () {
      this.isFetching = true;
      this.$axios
        .$get("/languages")
        .then(data => {
          this.languages = this.languages.concat(data.data);
          this.isFetching = false;
        })
        .catch(error => {
          this.isFetching = true;
        });
    },
    genreClick (genre) {
      this.selected.genre = genre
      this.changeFilter()
    },
    changeFilter () {
      this.paginate.page = 0
      this.series = []
      this.loadMore()
    },
    loadMore () {
      if (this.paginate.page >= this.seriesInfo.last_page) {
        //Last Page
        return;
      }
      this.busy = true;
      this.paginate.page++;
      this.$axios
        .$get(
          "series?" +
          "genre=" +
          this.selected.genre.id +
          "&language=" +
          this.selected.language.id +
          "&status=" +
          this.selected.status.id +
          "&page=" +
          this.paginate.page +
          "&per_page=" +
          this.paginate.perPage
        )
        .then(data => {
          console.log("Adding 20 more data results");
          this.series = this.series.concat(data.data);
          this.seriesInfo = data.meta;
          this.busy = false;
        })
        .catch(error => {
          this.busy = false;
        });
    }
  },
  mounted () {
    this.genresData();
    this.StatusesData();
    this.LanguagesData();
    this.recoveryQueryUrl()
    this.loadMore();
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#page-novels {
  min-height: 800px;
  .section-filter {
    background-color: #f5f6fc;
    border-bottom: 1px solid #dcdce2;
    display: flex;
    flex-direction: row;
    @extend %justify-center;
    .__container {
      display: flex;
      flex-direction: column;
      @extend %row;
      width: 100%;
      padding-top: 12px;
      padding-bottom: 32px;
      .filter {
        display: flex;
        flex-direction: column;
        margin-top: 32px;
        .__title {
          font-weight: 700;
          font-size: 22px;
          color: #1f2129;
        }
        .__options {
          display: flex;
          flex-direction: row;
          flex-wrap: wrap;
          padding: 0px;
          margin: 0px;
          li {
            display: flex;
            margin: 0px;
            padding: 0px;
            span {
              cursor: pointer;
              color: #6c6e7a;
              transition: 0.3s;
              text-transform: capitalize;
              border-bottom: 2px solid transparent;
              margin-top: 16px;
              margin-right: 32px;
              font-size: 14px;
              &:hover,
              &.active {
                text-decoration: none;
                color: #4c5fe2;
                border-bottom-color: #4c5fe2;
              }
            }
          }
        }
      }
      .filter-selects {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        margin-top: 32px;
        .multiselect {
          @include col(4);
        }
      }
    }
  }
  .section-series {
    display: flex;
    flex-direction: row;
    @extend %justify-center;
    .__container {
      display: flex;
      flex-direction: column;
      @extend %row;
      width: 100%;
      padding-top: 12px;
      padding-bottom: 32px;
      ul.list-series {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        margin-top: 38px;
        li {
          display: flex;
          flex-direction: column;
          @include col(2);
        }
      }
    }
  }
}

@media (max-width: 1024px) {
  #page-novels {
    .section-filter {
      padding: 0 18px;
    }
  }
}
@media (max-width: 768px) {
  #page-novels {
    .section-series {
      .__container {
        ul.list-series {
          li {
            @include col(3);
          }
        }
      }
    }
  }
}
@media (max-width: 425px) {
  #page-novels {
    .section-series {
      .__container {
        ul.list-series {
          li {
            @include col(4);
          }
        }
      }
    }
  }
}
@media (max-width: 375px) {
  #page-novels {
    .section-series {
      .__container {
        ul.list-series {
          li {
            @include col(6);
          }
        }
      }
    }
  }
}
</style>
