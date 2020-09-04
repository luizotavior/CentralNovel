<template>
  <div class="__reviews">
    <div class="__title">
      <h2>Avaliações</h2>
      <star-rating
        :current-rating="data.averageRating"
        :current-votes="data.numVotes"
      />
    </div>
    <div class="__content">
      <div class="__review-header">
        <div class="__review-header--left">
          <ul>
            <li>
              <span>Qualidade de Tradução</span>
              <star-rating :current-rating="data.averageRating" />
            </li>
            <li>
              <span>Estabilidade de atualizações</span>
              <star-rating :current-rating="data.averageRating" />
            </li>
            <li>
              <span>Desenvolvimento de história</span>
              <star-rating :current-rating="data.averageRating" />
            </li>
            <li>
              <span>Design de personagem</span>
              <star-rating :current-rating="data.averageRating" />
            </li>
            <li>
              <span>Fundo Mundial</span>
              <star-rating :current-rating="data.averageRating" />
            </li>
          </ul>
        </div>
        <div class="__review-header--right">
          <span>Compartilhe suas idéias com outras pessoas</span>
          <b-button
            type="is-dark"
            size="is-medium"
            icon-left="chat"
            @click="$buefy.snackbar.open('Função Desabilitada')"
            rounded
          >Escreva uma crítica</b-button>
        </div>
      </div>
      <review-list v-if="false" />
    </div>

    <b-modal
      v-model="showReview"
      :can-cancel="['x']"
      :width="600"
      scroll="keep"
    >
      <template #default="props">
        <review-modal @close="props.close" />
      </template>
    </b-modal>
  </div>
</template>

<script>
import starRating from "@/components/starRating.vue";
import reviewModal from "@/components/reviews/reviewModal.vue";
import reviewList from "@/components/reviews/reviewList.vue";
export default {
  name: "Reviews",
  components: {
    starRating,
    reviewModal,
    reviewList
  },

  props: {
    data: {
      type: Object,
      default: {}
    }
  },
  data () {
    return {
      showReview: false
    };
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
.__reviews {
  display: flex;
  flex-direction: column;
  div.__title {
    margin-bottom: 22px;
    display: flex;
    flex-direction: row;
    padding: 0;
    @extend %vertical-align-middle;
    h2 {
      font-size: 32px;
      margin-right: 12px;
    }
  }
  div.__content {
    display: flex;
    flex-direction: column;
    .__review-header {
      display: flex;
      flex-direction: row;
      border-top: 2px solid #d7d8e0;
      border-bottom: 2px solid #d7d8e0;
      margin-bottom: 24px;
      .__review-header--left {
        display: flex;
        flex-direction: column;
        border-right: 2px solid #d7d8e0;
        @include col(5);
        line-height: 32px;
        padding: 24px 32px 24px 0;
        > ul {
          display: flex;
          flex-direction: column;
          li {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            @extend %justify-between;
            @extend %vertical-align-middle;
          }
        }
      }
      .__review-header--right {
        display: flex;
        flex-direction: column;
        @include col(7);
        @extend %justify-center;
        @extend %vertical-align-middle;
        text-align: center;
        > span {
          margin-bottom: 12px;
        }
      }
    }
  }
}
</style>
<style lang="scss">
.modal-background {
  background-color: rgba(255, 255, 255, 0.5);
}
.modal-content {
  border: 1px solid rgba(0, 0, 0, 0.1);
  background: #fff;
  box-shadow: 0 8px 30px 0 rgba(0, 0, 0, 0.2);
}
.__review-item + .__review-item:before {
  position: absolute;
  top: 0px;
  left: 0px;
  right: 0px;
  content: "";
  border-top: 1px solid rgba(18, 18, 23, 0.1);
}
</style>
