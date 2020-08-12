<template>
  <div class="card-novel">
    <div class="header-card">
      <a :href="'/series/'+novel.slug">
        <i>
          <div class="imagem-container">
            <img
              class="__image"
              :src="
                'https://storage.googleapis.com/centralnovel.com.br/' + getCapa
              "
              alt=""
            />
            <span
              v-if="novel.language_id == 1"
              class="__original"
            >Original</span>
          </div>
        </i>
        <h3>{{ novel.title }}</h3>
      </a>
    </div>
    <div class="body-card">
      <div
        class="__authors"
        v-for="(author, index) in novel.authors"
        :key="index"
      >
        <a :href="'/authors/'+author.slug">
          {{author.name}}
        </a>
      </div>
    </div>
    <div class="footer-card">
      <star-rating
        v-if="rating"
        :current-rating="novel.averageRating"
      />
      <div v-if="sinopse">
        <p>
          With the rising tide of steam power and machinery, who can come close
          to being a Beyonder? Shrouded in the fog of history and darkness, who
          or what is the lurking evil that murmurs into our ears? Waking up to
          be faced with a string of mysteries, Zhou...
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import starRating from "@/components/starRating.vue";

export default {
  components: {
    starRating
  },
  props: {
    novel: {
      type: Object,
      default: () => { }
    },
    rating: {
      type: Boolean,
      default: false
    },
    sinopse: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    getCapa: function () {
      return this.novel.image == null ? "novels/default.jpg" : this.novel.image;
    },
  },
  methods: {
    isEmptyObject (obj) {
      var name;

      for (name in obj) return false;

      return true;
    }
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/layout/_grid.scss";
@import "@/assets/sass/helpers/_variables.scss";
.card-novel {
  display: flex;
  flex-direction: column;
  padding: 10px;
  .header-card {
    a {
      i {
        display: flex;
        overflow: hidden;
        margin-bottom: 8px;
        @extend %justify-center;
        @extend %vertical-align-middle;
        div.imagem-container {
          position: relative;
          overflow: hidden;
          .__image {
            max-width: 100%;
            transform: ease-out 0.3s;
            -moz-transition: all 0.3s;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            max-height: 260px;
            &:hover {
              -moz-transform: scale(1.1);
              -webkit-transform: scale(1.1);
              transform: scale(1.1);
            }
          }
        }
        .__original {
          top: 0;
          right: 0;
          position: absolute;
          padding: 2px 8px;
          text-transform: uppercase;
          color: #fff;
          border-radius: 0 0 0 8px;
          font-weight: 400;
          font-size: 12px;
          background-color: #3b66f5;
        }
      }
      h3 {
        font-weight: 400;
        color: #000;
        padding-left: 1px;
        font-size: 16px;
      }
      &:hover {
        h3 {
          text-decoration: underline;
        }
      }
    }
  }
  .body-card {
    .__authors {
      a {
        font-size: 14px;
        color: #83848f;
        font-weight: 300;
      }
    }
    &:hover {
      .__authors {
        text-decoration: underline;
      }
    }
  }
  .footer-card {
  }
}
</style>
