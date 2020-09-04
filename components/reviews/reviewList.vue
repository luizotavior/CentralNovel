<template>
  <div class="__review-content">
    <nav class="__review-nav">
      <ul>
        <li :class="{ active: reviewFilter == 1 }">
          <span @click="reviewFilter = 1">Curtido</span>
        </li>
        <li :class="{ active: reviewFilter == 2 }">
          <span @click="reviewFilter = 2">Novo</span>
        </li>
        <hr />
      </ul>
    </nav>
    <div class="__reviews-itens">
      <review-item
        :reply="false"
        v-for="(item, index) in 10"
        :key="index"
      />
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
  data () {
    return {
      reviewFilter: 1
    };
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";

.__review-content {
  nav.__review-nav {
    width: 100%;
    max-width: 150px;
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
}
</style>
