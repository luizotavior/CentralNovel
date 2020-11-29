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
          placeholder="Pesquisar Releases"
          @input="getAsyncData(query)"
        />

      </div>
      <b-button
        class="md-button"
        type="is-primary"
        tag="router-link"
        :to="'/dashboard/releases/new'"
      >Adicionar Release</b-button>
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
            :to="'/dashboard/releases/' + props.row.id"
            class="__titulo"
          >
            {{ props.row.serie.title }}
            <b-tag type="is-warning">
              {{ props.row.arc ? "A" + props.row.arc + " " : "" }}
              {{ props.row.volume ? "V" + props.row.volume + "" : "" }}
              {{ props.row.chapter ? "C" + props.row.chapter + " " : "" }}
              {{ props.row.part ? "P" + props.row.part + " " : "" }}
            </b-tag>
          </nuxt-link>
        </b-table-column>
        <b-table-column
          field="pageviews"
          label="Feed"
          sortable
          v-slot="props"
        >
        <b-tooltip label="Group Link">
          <a
            :href="'/dashboard/groups/'+props.row.group.id"
            target="_blank"
            class="__titulo"
          >
              {{props.row.group.name}}
          </a>
        </b-tooltip>
        </b-table-column>
        <b-table-column
          field="pageviews"
          label="Feed"
          sortable
          v-slot="props"
        >
        <b-tooltip label="Feed External Link">
          <a
            :href="'/dashboard/feeds/'+props.row.feed_id"
            target="_blank"
            class="__titulo"
            v-if="props.row.feed_id"
          >
            <b-tag type="is-info">
              {{props.row.feed.title}}
            </b-tag>
          </a>
        </b-tooltip>
        <b-tag type="is-danger" v-if="!props.row.feed_id">Nenhum Feed Relacionado</b-tag>
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
        <b-tooltip label="Edit Release">
          <a
            :href="'/dashboard/releases/' + props.row.id"
            target="_blank"
            class="__titulo"
          >
            <b-icon
                icon="pencil"/>
          </a>
          </b-tooltip>
        <b-tooltip label="Release External Link">
          <a
            :href="props.row.url"
            target="_blank"
            class="__titulo"
          >
            <b-icon
                icon="link"/>
          </a>
          </b-tooltip>
        <b-tooltip label="Deletar Release!">
          <span
            @click="confirmDeleteRelease(props.row.id)"
            target="_blank"
            class="__titulo"
          >
            <b-icon
                icon="delete"/>
          </span>
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
      'releases.edit'
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

          this.$axios.$get('/releases?page=' + this.page + '&per_page=' + this.perPage + '&sortProperty=created_at&q=' + this.query)
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
    onPageChange (page) {
      this.page = page;
      this.getAsyncData(this.query);
    },
    confirmDeleteRelease (id) {
      this.$buefy.dialog.confirm({
        title: "Deleting account",
        message:
          "Are you sure you want to <b>delete</b> your account? This action cannot be undone.",
        confirmText: "Delete Account",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => this.deleteRelease(id)
      });
    },
    deleteRelease(id){
      this.$buefy.toast.open({
        message: 'Carregando...'
      })
      this.$axios
        .delete(
          "releases/"+id
        )
        .then(response => {
          var msg = ""
          if(response.status == 200){
            msg = "Ação Realizada!"
          }else{
            msg = "Ocorreu um Erro! ["+response.status+"]"
          }
          this.$buefy.toast.open({
            message: msg
          });
          this.getAsyncData(this.query);
        })
        .catch(e => {
          if (!e.response) {
            this.errors = {
              'error': ["Erro na Rede - Servidor Offline"]
            }
          } else {
            this.$buefy.toast.open({
              message: "[" + response.status + "] Ocorreu um Erro Inesperado."
            });
          }
        })
    },
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
