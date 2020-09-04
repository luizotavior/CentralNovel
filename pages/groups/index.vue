<template>
  <div id="page-groups">
    <div class="section-filter">
      <div class="__container">
        <div class="filter">
          <span class="__title">Filtros</span>
        </div>
        <div class="filter-selects">
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
    <div class="section-groups">
      <div class="__container">
        <ul
          class="list-groups"
          v-infinite-scroll="loadMore"
          infinite-scroll-disabled="paginate.busy"
          infinite-scroll-distance="paginate.perPage"
        >
          <li
            v-for="(group, index) in groups"
            :key="index"
            style="margin-bottom: 2rem;"
            data-aos="slide-up"
            data-aos-offset="100"
            data-aos-easing="ease-out-back"
            data-aos-once="true"
          >
            <card-group
              :group="group"
              :rating="true"
            />
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import cardGroup from "@/components/cardGroup.vue";
import Multiselect from "vue-multiselect";

export default {
  name: "Groups",
  components: { cardGroup, Multiselect },
  data () {
    return {
      statuses: [
        {
          id: 0,
          name: "Todos"
        }
      ],
      sortOrder: [
        {
          id: 1,
          name: "Alfabética"
        }
      ],
      groups: [],
      groupsInfo: [],
      selected: {
        status: {
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
    changeFilter () {
      this.paginate.page = 0
      this.groups = []
      this.loadMore()
    },
    loadMore () {
      if (this.paginate.page >= this.groupsInfo.last_page) {
        console.log("Last Page!!!");
        return;
      }
      this.busy = true;
      this.paginate.page++;
      this.$axios
        .$get(
          "groups?" +
          "status=" +
          this.selected.status.id +
          "&page=" +
          this.paginate.page +
          "&per_page=" +
          this.paginate.perPage
        )
        .then(data => {
          console.log("Adding 20 more data results");
          this.groups = this.groups.concat(data.data.data);
          this.groupsInfo = data.data;
          this.busy = false;
        })
        .catch(error => {
          this.busy = false;
        });
    }
  },
  mounted () {
    this.recoveryQueryUrl()
    this.loadMore();
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#page-groups {
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
  .section-groups {
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
      ul.list-groups {
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
  #page-groups {
    .section-filter {
      padding: 0 18px;
    }
  }
}
@media (max-width: 768px) {
  #page-groups {
    .section-groups {
      .__container {
        ul.list-groups {
          li {
            @include col(3);
          }
        }
      }
    }
  }
}
@media (max-width: 425px) {
  #page-groups {
    .section-groups {
      .__container {
        ul.list-groups {
          li {
            @include col(4);
          }
        }
      }
    }
  }
}
@media (max-width: 375px) {
  #page-groups {
    .section-groups {
      .__container {
        ul.list-groups {
          li {
            @include col(6);
          }
        }
      }
    }
  }
}
</style>
