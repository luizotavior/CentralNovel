<template>
  <div id="page-series">
    <div class="serie-filter">
      <div class="md-card no-padding">
        <b-input
          v-model="query"
          :loading="isFetching"
          expanded
          class="md-search"
          icon="magnify"
          placeholder="Pesquisar Series"
          @input="getAsyncData(query)"
        />

      </div>
      <b-button
        class="md-button"
        type="is-primary"
        tag="router-link"
        :to="'/dashboard/series/new'"
      >Adicionar serie</b-button>
    </div>
    <div class="series-table md-card no-padding">
      <b-table
        :data="data.data"
        :loading="isFetching"
        :total="data.total"
        :per-page="data.per_page"
        @page-change="onPageChange"
        :mobile-cards="false"
        paginated
        backend-pagination
      >
        <b-table-column
          field="title"
          label="Titulo"
          sortable
          v-slot="props"
        >
          <nuxt-link
            :to="'/dashboard/series/' + props.row.id"
            class="__titulo"
          >{{
            props.row.title
          }}</nuxt-link>
        </b-table-column>
        <b-table-column
          field="releases"
          label="Releases"
          sortable
          v-slot="props"
        >{{
            props.row.releases_count}}
        </b-table-column>
        <b-table-column
          field="averageRating"
          label="Nota (Votos)"
          sortable
          v-slot="props"
        >{{ props.row.averageRating}} ({{  props.row.numVotes}} )
        </b-table-column>
        <b-table-column
          field="pageviews"
          label="PageViews"
          sortable
          v-slot="props"
        >{{
            props.row.pageviews}}
        </b-table-column>
        <b-table-column
          field="pageviews"
          label="Ação"
          sortable
          v-slot="props"
        >
          <a
            :href="'/series/' + props.row.slug"
            target="_blank"
            class="__titulo"
          >
            <b-icon
                icon="link"/>
          </a>
        </b-table-column>

        <template slot="empty">
          <section class="section">
            <div class="content has-text-grey has-text-centered">
              <p>
                <b-icon
                  icon="emoticon-sad"
                  size="is-large"
                />
              </p>
              <p>Você não possui series ainda.</p>
            </div>
          </section>
        </template>
      </b-table>
    </div>
  </div>
</template>

<script>
import avatar from "vue-avatar";
// Import the styles too, globally
export default {
  layout: 'dashboard',
  components: {
    avatar,
  },
  middleware: ['permissions'],
  meta: {
    permissions: [
      'series.edit'
    ]
  },
  data () {
    return {
      query: "",
      isFetching: false,
      digitedTypingTime: null,
      data: [],
      empty: false,
      page: 1,
      perPage: 10
    };
  },
  mounted () {
    this.getAsyncData(this.query);
  },
  methods: {
    getAsyncData (query) {
      clearTimeout(this.digitedTypingTime);
      this.digitedTypingTime = setTimeout(() => {
        if (query.length >= 0) {
          this.data = []
          this.isFetching = true

          this.$axios.$get('/series?page=' + this.page + '&per_page=' + this.perPage + '&q=' + this.query)
            .then(data => {

              this.data = [];
              this.isFetching = false
              this.empty = (data.length == 0)
              let currentTotal = data.total;
              if (data.total / this.perPage > 1000) {
                currentTotal = this.perPage * 1000;
              }
              this.total = currentTotal;
              this.data = data.data;
            })
            .catch(error => {
              this.isFetching = false
              throw error
            })
        }
      }, 500);
    },
    confirmDeletelocation (id) {
      this.$buefy.dialog.confirm({
        title: "Deleting account",
        message:
          "Are you sure you want to <b>delete</b> your account? This action cannot be undone.",
        confirmText: "Delete Account",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => this.deletelocation(id)
      });
    },
    async deletelocation (id, notify = true) {
      await this.$axios
        .delete(
          "/series/" + id
        )
        .then(response => {
          if (notify) {
            this.$buefy.snackbar.open({
              duration: 5000,
              message: 'A Serie foi Removida com Sucesso.',
              position: 'is-bottom-left',
              queue: false,
            })
          }
          this.getAsyncData(this.query);
        })
        .catch(e => {
          console.log(e);
          if (notify) {
            this.$buefy.toast.open("Error, tente novamente mais tarde!");
          }
        });
    },

    onPageChange (page) {
      this.page = page;
      this.getAsyncData(this.query);
    }
  },

};
</script>
<style lang="scss">
@import "@/assets/sass/main.scss";
#page-series {
  .serie-filter {
    display: flex;
    flex-direction: row;
    .md-card {
      margin-top: 40px;
      width: 85%;
      padding: 10px 0;
      border: none;
      &:hover {
        border: none;
      }
      .md-search {
        width: 100%;
        input {
          border: none;
          box-shadow: none;
          &:focus {
            border: none;
            box-shadow: none;
          }
          &:hover {
            border: none;
          }
        }
      }
    }
    .md-button {
      margin: 40px 0px 0px 15px;
      width: 15%;
      height: 55px;
    }
  }
  .series-table {
    padding-bottom: 12px;
  }
  div.b-table {
    width: 100%;
    table {
      .column-avatar {
        display: flex;
        flex-direction: row;
        align-items: center;
        .series {
          padding-left: 15px;
          color: #323c47;
          font-weight: 500;
          font-size: 16px;
          line-height: 22px;
        }
      }
      th {
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 19px;
        padding: 20px;

        letter-spacing: 0.01em;
        color: #334d6e;
        opacity: 0.5;
      }
      td {
        padding: 21px;
        a {
          text-decoration: none;
          color: #000;
          &:hover {
            color: $primary;
          }
        }
      }
    }
    .pagination {
      padding-right: 32px;
    }
  }
}
</style>
