<template>
  <section id="feed-table">
    <b-table
      :data="data"
      :loading="loading"
      paginated
      backend-pagination
      :total="total"
      :per-page="perPage"
      @page-change="onPageChange"
      :mobile-cards="false"
    >
      <template
        slot-scope="props"
        slot="header"
      >
        <div class="table-title">
          {{ props.column.label }}
        </div>
      </template>

      <b-table-column
        field="original_title"
        label="Grupo"
        sortable
        v-slot="props"
      >
        <nuxt-link
          :to="'/groups/' + props.row.group.slug"
          class="__titulo"
        >{{
            props.row.group == null ? "" : props.row.group.name
          }}</nuxt-link>
      </b-table-column>
      <b-table-column
        field="original_title"
        label="Release"
        sortable
        v-slot="props"
      >
        <a
          :href="props.row.url"
          target="_blank"
          class="__release"
        >
          {{ props.row.arc ? "a" + props.row.arc + " " : "" }}
          {{ props.row.volume ? "v" + props.row.volume + "" : "" }}
          {{ props.row.chapter ? "c" + props.row.chapter + " " : "" }}
          {{ props.row.part ? "p" + props.row.part + " " : "" }}
        </a>
      </b-table-column>
      <b-table-column
        field="release_date"
        label="Data"
        class="not-overflow"
        sortable
        v-slot="props"
      >
        <b-tooltip :label="$moment(props.row.published_at).format('LLL')">
          <span class="__time">
            {{ dateFromNow(props.row.published_at) }}<br>
          </span>
        </b-tooltip>
      </b-table-column>
    </b-table>
  </section>
</template>

<script>
export default {

  props: {
    serie: {
      type: Object,
      default: () => { }
    },
  },
  data () {
    return {
      data: [],
      total: 0,
      loading: false,
      page: 1,
      perPage: 20
    };
  },
  methods: {
    /*
     * Load async data
     */
    dateFromNow (newDate) {
      return newDate ? this.$moment(Date.parse(newDate)).fromNow() : ""
    },
    loadAsyncData () {
      const params = [
        "paginate=1",
        `page=${this.page}`,
        `per_page=${this.perPage}`,
        `serie_id=${this.serie.id}`
      ].join("&");

      this.loading = true;
      this.$axios
        .$get("/releases?" + params)
        .then(({ data }) => {
          this.data = [];
          let currentTotal = data.total;
          if (data.total / this.perPage > 1000) {
            currentTotal = this.perPage * 1000;
          }
          this.total = currentTotal;
          this.data = data.data;
          this.loading = false;
        })
        .catch(error => {
          this.data = [];
          this.total = 0;
          this.loading = false;
          throw error;
        });
    },
    /*
     * Handle page-change event
     */
    onPageChange (page) {
      this.page = page;
      this.loadAsyncData();
    }
  },
  mounted () {
    this.loadAsyncData();
  }
};
</script>

<style lang="scss">
section#feed-table {
  padding: 12px;
  padding-top: 0px;
  .table {
    background-color: transparent;
    line-height: normal;
    width: 100%;
    overflow-x: auto;
    .table-title {
      color: #83848f;
      font-weight: 400;
      font-size: 14px;
    }
    th,
    td {
      padding-left: 0px;
      border-width: 0 0 1px;
      border-color: #e3e4ea;
    }
    tbody {
      td {
        font-weight: 300;
        color: #83848f;
        a {
          color: #000;
        }
        a,
        span {
          display: block;
          overflow: hidden;
          white-space: nowrap;
          text-overflow: ellipsis;
        }
        &:hover {
          text-decoration: underline;
        }
        .__genero {
          max-width: 7rem;
          color: #83848f;
        }
        .__titulo {
          max-width: 17rem;
          @media (max-width: 768px) {
            max-width: 7rem;
          }
        }
        .__release {
          max-width: 13rem;
          @media (max-width: 768px) {
            max-width: 7rem;
          }
        }
        .__autor {
          max-width: 7rem;
        }
        .__tradutor {
          max-width: 7rem;
        }
        .__time {
          max-width: 7rem;
          color: #83848f;
        }
        &.not-overflow span {
          overflow: visible !important;
        }
      }
    }
  }
}
</style>
