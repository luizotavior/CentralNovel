<template>
  <div id="page-novels">
    <div class="section-filter">
      <div class="__container">
        <div class="filter">
          <span class="__title">Gênero</span>
          <ul class="__options">
            <li>
              <a href="#" class="active">Todos</a>
            </li>
            <li v-for="(genre, index) in genres" :key="index">
              <a href="#">{{ genre.name }}</a>
            </li>
          </ul>
        </div>
        <div class="filter-selects">
          <multiselect
            v-model="selected.languages"
            deselect-label="Can't remove this value"
            track-by="name"
            label="name"
            :options="languages"
            :preselect-first="true"
            :allow-empty="false"
          >
            <template slot="singleLabel" slot-scope="{ option }">
              {{ option.name }}</template
            >
          </multiselect>
          <multiselect
            v-model="selected.statuses"
            deselect-label="Can't remove this value"
            track-by="name"
            label="name"
            :options="statuses"
            :preselect-first="true"
            :allow-empty="false"
          >
            <template slot="singleLabel" slot-scope="{ option }">
              {{ option.name }}</template
            >
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
            <template slot="singleLabel" slot-scope="{ option }">
              {{ option.name }}</template
            >
          </multiselect>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";

export default {
  name: "Novels",
  components: { Multiselect },
  data() {
    return {
      genres: null,
      tags: null,
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
      selected: {
        genres: null,
        tags: null,
        statuses: null,
        languages: null,
        sortOrder: null
      },
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
      isFetching: true
    };
  },
  methods: {
    genresData() {
      this.isFetching = true;
      this.$axios
        .$get("/genres")
        .then(data => {
          this.genres = data.data;
          this.isFetching = false;
        })
        .catch(error => {
          this.isFetching = true;
        });
    },
    TagsData() {
      this.isFetching = true;
      this.$axios
        .$get("/tags")
        .then(data => {
          this.tags = data.data;
          this.isFetching = false;
        })
        .catch(error => {
          this.isFetching = true;
        });
    },
    StatusesData() {
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
    LanguagesData() {
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
    }
  },
  mounted() {
    this.genresData();
    this.TagsData();
    this.StatusesData();
    this.LanguagesData();
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
            a {
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
