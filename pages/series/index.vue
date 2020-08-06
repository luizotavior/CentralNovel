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
                @click="selected.genre = genre.id"
                :class="{
              'active': genre.id == selected.genre ,
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
            deselect-label="Can't remove this value"
            track-by="name"
            label="name"
            :options="languages"
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
            deselect-label="Can't remove this value"
            track-by="name"
            label="name"
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
            deselect-label="Can't remove this value"
            track-by="name"
            label="name"
            :options="sortOrder"
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
        <ul>
          <li
            v-for="(novel, index) in novels"
            :key="index"
          >
            <card-novel
              :novel="novel"
              :rating="true"
              :sinopse="index == 0"
            />
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import cardNovel from '@/components/cardNovel.vue';
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
          name: "Popular"
        },
        {
          id: 1,
          name: "Popular"
        },
        {
          id: 1,
          name: "Popular"
        },
        {
          id: 1,
          name: "Popular"
        }
      ],
      isFetching: true,
      series: [],
      selected: {
        genre: 0,
        status: null,
        language: null,
        sortOrder: null
      }
    };
  },
  methods: {
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
    getNovelsData () {
      this.isFetching = true
      this.$axios.$get(
        'series?' +
        'genre=' + this.selected.genre +
        'language=' + this.selected.language +
        'status=' + this.selected.status
      )
        .then(data => {
          this.series = data.data
          this.isFetching = false
        })
        .catch(error => {
          this.isFetching = true
        })
    }
  },
  mounted () {
    this.genresData()
    this.StatusesData()
    this.LanguagesData()
    this.getNovelsData()
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
}
</style>
