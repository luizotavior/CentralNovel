<template>
  <div
    id="modal-reply"
    class="card"
  >
    <header class="card-header">
      <p class="card-header-title">
        Detalhes da Avaliação
      </p>
      <span
        @click="$emit('close')"
        class="card-header-icon"
      >
        <b-icon icon="close"></b-icon>
      </span>
    </header>
    <div class="__review-container">

      <div class="__review">
        <review-itemr
          :reply="false"
          v-for="(item, index) in 1"
          :key="index"
        />
      </div>
      <div class="__reviews">
        <h2 class="--total">41 Comentarios</h2>
        <review-itemr
          :reply="false"
          :showRating="false"
          v-for="(item, index) in 10"
          :key="index"
        />
      </div>
    </div>
    <footer class="card-footer">

      <b-field grouped>
        <p class="control">
          <avatar
            :size="38"
            username="Luiz Rodrigues"
          />
        </p>
        <b-input
          v-model="comment"
          placeholder="Escreva um Comentario..."
          expanded
          rounded
          v-on:keyup.enter.native="sendReply"
        />
        <p class="control --send">
          <span
            class="reply--send"
            @click="sendReply"
          >
            <b-icon icon="send" />
          </span>
        </p>
      </b-field>
    </footer>
  </div>
</template>

<script>
import reviewItemr from "@/components/reviews/reviewItemR.vue";
import avatar from "vue-avatar";
export default {
  name: "ReviewDetailModal",
  components: {
    reviewItemr, avatar

  },
  data () {
    return {
      comment: 0,
    };
  },
  computed: {
  },
  methods: {
    sendReply () {
      this.comment = null
      this.$buefy.snackbar.open('Reply Send')
    }
  }
};
</script>

<style lang="scss">
@import "@/assets/sass/main.scss";
#modal-reply {
  height: 90%;
  .card-header {
    box-shadow: none;
    min-height: 60px;
  }
  .card-footer {
    display: flex;
    flex-direction: column;
    min-height: 60px;
    padding: 0 12px;
    width: 100%;
    @extend %justify-center;
    .--send {
      display: flex;
      flex-direction: row;
      @extend %vertical-align-middle;
      .reply--send {
        cursor: pointer;
      }
    }
  }
  .card-header-title {
    font-weight: 600;
    font-size: 24px;
  }
  .__review-container {
    display: flex;
    flex-direction: column;
    min-height: 300px;
    height: 96%;
    overflow: auto;
    background-color: #f5f6fc;
    .__review {
      display: flex;
      flex-direction: column;
      padding: 0px 32px;
      height: 100%;
      background-color: #fff;
    }
    .__reviews {
      display: flex;
      flex-direction: column;
      height: 100%;
      padding: 0px 32px;
      border-top: 1px solid #e5e5e5;
      .--total {
        font-size: 18px;
        font-weight: 600;
        color: #000;
        line-height: 24px;
        margin-top: 18px;
      }
    }
  }
}
</style>
