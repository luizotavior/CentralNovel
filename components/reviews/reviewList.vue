<template>
  <div class="__review-content" v-if="data">
    <nav class="__review-nav">
      <ul>
        <li :class="{ active: sortOrder == 'created_at' }">
          <span @click="changeSortOrder('created_at')">Novos</span>
        </li>
        <li :class="{ active: sortOrder == 'like_count' }">
          <span @click="changeSortOrder('like_count')">Melhores</span>
        </li>
        <hr />
      </ul>
    </nav>
    <div class="__reviews-itens" v-if="data.data">
      <review-item
        :reply="false"
        v-for="(item, index) in data.data"
        :key="index"
        :data="item"
      />
    </div>
    <div class="__reviews-empty alert_icon" v-if="data.data && data.data.length == 0 || data.length == 0">
        <b-icon
          icon="alert-circle"
          size="is-large"
        />
        <h1>Não há avaliações disponiveis!</h1>
      </div>
    </div>
  </div>
</template>

<script>
import starRating from "@/components/starRating.vue";
import reviewItem from "@/components/reviews/reviewItem.vue";
import avatar from "vue-avatar";
export default {
  name: "ReviewList",
  components: {
    starRating,
    avatar,
    reviewItem
  },
  props: {
    api: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      sortOrder: 'created_at',
      data: [],
      total: 0,
      loading: false,
      page: 1,
      perPage: 10
    };
  },
  mounted() {
    this.loadAsyncData()
  },
  methods: {
    changeSortOrder(sortOrder){
      this.sortOrder = sortOrder
      this.loadAsyncData()
    },
    async loadAsyncData () {
      const params = [
        `?paginate=1`,
        `reviewNotNull=1`,
        `sortProperty=${this.sortOrder}`,
        `page=${this.page}`,
        `per_page=${this.perPage}`
      ].join("&");

      this.loading = true;
      this.$axios
        .$get(this.api + params)
        .then(response => {
          this.data = [];
          this.data = response;
          this.loading = false;
        })
        .catch(error => {
          this.data = [];
          this.total = 0;
          this.loading = false;
          throw error;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";

.__review-content {
  nav.__review-nav {
    width: 100%;
    max-width: 250px;
    margin-top: 0px;
    margin-bottom: 24px;
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
          font-size: 16px;
          text-decoration: none;
          color: $primary;
          cursor: pointer;
          font-weight: 600;
          padding: 6px 0 ;
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
        width: 48%;
        margin: 0;
        height: 2px;
        background: #83848f;
        border: none;
        transition: 0.25s ease-in-out;
      }
    }
  }
  .__reviews-empty{
    display: flex;
    flex-direction: column;
    @extend %vertical-align-middle;
    @extend %justify-center;
    padding: 60px 0;
    span.icon{
      padding-bottom: 16px;
    }
  }
}
</style>
