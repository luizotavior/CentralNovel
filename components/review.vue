<template>
  <div
    id="modal-review"
    class="card"
  >
    <header class="card-header">
      <p class="card-header-title">
        Escrever uma Avaliação
      </p>
      <span
        @click="$emit('close')"
        class="card-header-icon"
      >
        <b-icon icon="close"></b-icon>
      </span>
    </header>
    <div class="card-content">
      <div class="content">
        <div class="avaliations">
          <div class="__left">
            <ul>
              <li>
                <span>Qualidade de Tradução</span>
                <star-rating
                  v-model="rating_1"
                  :only-star="true"
                  :clickable="true"
                />
              </li>
              <li>
                <span>Estabilidade de atualizações</span>
                <star-rating
                  v-model="rating_2"
                  :only-star="true"
                  :clickable="true"
                />
              </li>
              <li>
                <span>Desenvolvimento de história</span>
                <star-rating
                  v-model="rating_3"
                  :only-star="true"
                  :clickable="true"
                />
              </li>
              <li>
                <span>Design de personagem</span>
                <star-rating
                  v-model="rating_4"
                  :clickable="true"
                  :only-star="true"
                />
              </li>
              <li>
                <span>Fundo Mundial</span>
                <star-rating
                  v-model="rating_5"
                  :clickable="true"
                  :only-star="true"
                />
              </li>
            </ul>
          </div>
          <div class="__right">
            <div class="rating">
              <span class="rating-label">Nota Média</span>
              <span class="rating-value">{{ avg }}</span>
              <star-rating
                :current-rating="avg"
                :only-star="true"
              />
            </div>
          </div>
        </div>
        <div class="comments">
          <b-input
            minlength="140"
            maxlength="500"
            type="textarea"
            placeholder="Digite seu comentário aqui. Por favor, escreva sua avaliação o mais detalhado possível. Seus comentários são muito importantes para a história (pelo menos 140 caracteres)."
          ></b-input>

          </b-textarea>
        </div>
      </div>
    </div>

    <footer class="card-footer">
      <a
        href="#"
        class="card-footer-item"
      >Postar</a>
    </footer>
  </div>
</template>

<script>
import starRating from "@/components/starRating.vue";
export default {
  components: {
    starRating,
  },
  data () {
    return {
      rating_1: 0,
      rating_2: 0,
      rating_3: 0,
      rating_4: 0,
      rating_5: 0
    };
  },
  computed: {
    avg: function () {
      return (
        (this.rating_1 +
          this.rating_2 +
          this.rating_3 +
          this.rating_4 +
          this.rating_5) /
        5
      );
    }
  },
  methods: {

  },
};
</script>

<style lang="scss">
@import "@/assets/sass/main.scss";
#modal-review {
  .card-header {
    box-shadow: none;
  }
  .card-header-title {
    font-weight: 600;
    font-size: 24px;
  }
  .content {
    .avaliations {
      display: flex;
      flex-direction: row;
      .__left {
        display: flex;
        flex-direction: column;
        @include col(7);
        line-height: 22px;
        > ul {
          display: flex;
          flex-direction: column;
          margin: 0;
          li {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            @extend %justify-between;
            @extend %vertical-align-middle;
          }
        }
      }
      .__right {
        display: flex;
        flex-direction: row;
        @include col(5);
        @extend %justify-center;
        @extend %vertical-align-middle;
        .rating {
          display: flex;
          flex-direction: column;
          box-sizing: border-box;
          width: 146px;
          padding: 18px 10px;
          border: 1px solid #d7d8e0;
          border-radius: 5px;
          text-align: center;
          @extend %justify-center;
          @extend %vertical-align-middle;
          .rating-label {
            color: #83848f;
          }
          .rating-value {
            font-size: 32px;
            font-weight: 700;
          }
        }
      }
    }
    .comments {
      padding: 1.5rem 0;
      textarea {
        border: none;
        box-shadow: none;
        padding: 0;
        resize: none;
      }
    }
  }

  @media (max-width: 768px) {
    max-width: 7rem;
  }
}
</style>
