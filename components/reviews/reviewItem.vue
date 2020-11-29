<template>
  <div class="__review-item">
    <div v-if="!skeleton">
      <div class="header">
        <div class="__left">
          <avatar
            :size="38"
            :username="data.user.username"
          />
        </div>
        <div class="__right">
          <span class="username">{{data.user.username}}</span>
          <star-rating
            v-if="showRating"
            :current-rating="Number(data.rating)"
            only-star
          />
        </div>
      </div>
      <div class="content-item">
        <p v-html="data.review">
        </p>
      </div>
      <div class="footer-item">
        <div class="__left">Há 2 Dias Atrás</div>
        <div class="__right">
          <span
            class="action --like"
            @click="likeReview"
          >
            <b-icon
            @click="likeReview"
            :class="{
              'animate__animated': animated,
              'animate__bounce' : true,
              'animate__repeat-3' : true
            }"
              icon="thumb-up-outline"
              size="is-small"
            />123</span>
          <span
            class="action --reply"
            @click="showReply = true"
            v-if="reply"
          >
            <b-icon
              icon="chat-outline"
              size="is-small"
            />
          </span>
          <span class="action --config">
            <b-icon
              icon="dots-horizontal"
              size="is-small"
            />
          </span>
        </div>
      </div>
      <div
        class="reply-action"
        v-if="reply"
      >
        <span
          class="action --reply"
          @click="showReply = true"
        >
          <b-icon
            icon="chat"
            size="is-small"
          />
          Visualizar 2 Respostas
        </span>
      </div>
    </div>
    <skeleton v-else />
    <b-modal
      v-if="reply"
      :active.sync="showReply"
      v-model="showReply"
      :can-cancel="['x']"
      :width="600"
      scroll="keep"
    >
      <template #default="props">
        <review-detail-modal @close="props.close" />
      </template>
    </b-modal>
  </div>
</template>

<script>
import skeleton from "@/components/reviews/reviewItemSkeleton.vue";
import reviewDetailModal from "@/components/reviews/reviewDetailModal.vue";
import starRating from "@/components/starRating.vue";
import avatar from "vue-avatar";
export default {
  name: "ReviewItem",
  components: {
    starRating,
    avatar,
    reviewDetailModal,
    skeleton
  },
  props: {
    data: {
      type: Object,
      default: {}
    },
    reply: {
      type: Boolean,
      default: true
    },
    showRating: {
      type: Boolean,
      default: true
    },
  },
  data () {
    return {
      showReply: false,
      skeleton: false,
      animation: true
    };
  },
  methods: {
    likeReview () {
      console.log('click')
      this.animation = true
       setTimeout(this.animation = false, 1000);
    }
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
.__review-item {
  display: flex;
  flex-direction: column;
  padding-top: 16px;
  padding-bottom: 16px;
  position: relative;
  .header {
    display: flex;
    flex-direction: row;
    margin-bottom: 12px;
    .__left {
      display: flex;
      flex-direction: row;
      padding-right: 12px;
      @extend %justify-center;
      @extend %vertical-align-middle;
    }
    .__right {
      display: flex;
      flex-direction: column;
      @extend %justify-center;
      span.username {
        color: #000;
        font-weight: 600;
      }
    }
  }
  .content-item {
    width: 100%;
    padding-left: 48px;
    color: rgba(18, 18, 23, 0.6);
  }
  .footer-item {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    @extend %justify-between;
    padding-left: 48px;
    padding-top: 12px;
    div.__left {
      font-size: 14px;
    }
    div.__right {
      .action {
        cursor: pointer;
        margin-left: 16px;
        &.active,
        &:hover {
          color: $primary;
        }
      }
    }
  }
  .reply-action {
    display: flex;
    flex-direction: row;
    padding-left: 48px;
    padding-top: 12px;
    .action {
      cursor: pointer;
      color: $primary;
      text-transform: uppercase;
      font-size: 14px;
      &.active,
      &:hover {
        text-decoration: underline;
      }
    }
  }
}
.bounce-enter-active {
  animation: bounce-in 0.5s;
}
.bounce-leave-active {
  animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}
</style>
