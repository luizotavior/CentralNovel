<template>
  <div id="page-feeds">
    <div class="release-filter">
      <div class="md-card no-padding">
        <b-input
          v-model="query"
          :loading="isFetching"
          expanded
          class="md-search"
          icon="magnify"
          placeholder="Pesquisar Feeds"
          @input="getAsyncData(query)"
        />

      </div>
    </div>
    <div class="releases-table md-card no-padding">
      <b-table
        :data="data.data"
        :loading="isFetching"
        :total="data.meta ? data.meta.total : 0"
        :per-page="perPage"
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
            :to="'/dashboard/feeds/' + props.row.id"
            class="__titulo"
          >{{
            props.row.title
          }}</nuxt-link>
        </b-table-column>
        <b-table-column
          field="group.name"
          label="Grupo"
          sortable
          v-slot="props"
        >
          <nuxt-link
            :to="'/dashboard/groups/' + props.row.group.id"
            class="__titulo"
          >{{
            props.row.group.name
          }}</nuxt-link>
        </b-table-column>
        <b-table-column
          field="releases.length"
          label="Assimilado"
          sortable
          v-slot="props"
        >
          <span
            v-for="(release, index) in props.row.releases"
            :key="index"
          >
            <a :href="'/dashboard/series/' + release.serie.id" target="_blank">
              <b-tag type="is-info">
                  {{ release.serie.title }}
              </b-tag>
            </a> -
            <a :href="'/dashboard/releases/' + release.id" target="_blank">
            <b-tag type="is-warning">
                {{ release.arc ? "A" + release.arc + " " : "" }}
                {{ release.volume ? "V" + release.volume + "" : "" }}
                {{ release.chapter ? "C" + release.chapter + " " : "" }}
                {{ release.part ? "P" + release.part + " " : "" }}
            </b-tag>
            </a>
          </span>
          <b-tag type="is-danger" v-if="props.row.releases.length == 0">Nenhuma Serie Encontrada</b-tag>

        </b-table-column>
        <b-table-column
          field="published_at"
          label="Publicado"
          sortable
          v-slot="props"
        >
          {{$moment(props.row.published_at).format('LLL')}}
        </b-table-column>
        <b-table-column
          field="pageviews"
          label="Ação"
          sortable
          v-slot="props"
        >
        <b-tooltip label="Feed External Link">
          <a
            :href="props.row.permalink"
            target="_blank"
            class="__titulo"
          >
            <b-icon
                icon="link"/>
          </a>
          </b-tooltip>
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
              <p>Você não possui releases ainda.</p>
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
      'feeds.edit'
    ]
  },
  data () {
    return {
      query: "",
      isFetching: true,
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

          this.$axios.$get('/feeds?page=' + this.page + '&per_page=' + this.perPage + '&q=' + this.query)
            .then(data => {

              this.data = [];
              this.isFetching = false
              this.data = data;
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
          "/releases/" + id
        )
        .then(response => {
          if (notify) {
            this.$buefy.snackbar.open({
              duration: 5000,
              message: 'A Release foi Removida com Sucesso.',
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
#page-feeds {
  .release-filter {
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
  .releases-table {
    padding-bottom: 12px;
  }
  div.b-table {
    width: 100%;
    table {
      .column-avatar {
        display: flex;
        flex-direction: row;
        align-items: center;
        .releases {
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
