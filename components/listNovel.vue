<template>
  <div
    class="list-novel"
    v-if="!isFetching"
  >
    <div
      v-if="mode == 1"
      class="mode-one-container"
    >
      <slick
        ref="slick"
        :options="slickOptions"
      >
        <card-novel
          :novel="novel"
          :rating="true"
          v-for="(novel, index) in novels"
          :key="index"
        />
      </slick>

    </div>
    <ul
      v-if="mode == 2"
      class="mode-two-container"
    >
      <li
        v-for="(novel, index) in novels"
        :key="index"
        :class="{
            'the-fives': index > 1 && index <= 5 ,
            'is-hidden-touch ': index > (novels-2),
            'is-hidden-mobile  ': index > (novels-4),
            }"
      >
        <card-novel
          :novel="novel"
          :rating="true"
          :sinopse="index == 0"
        />
      </li>
    </ul>
  </div>
</template>

<script>
import cardNovel from '@/components/cardNovel.vue';
let Slick = null;
if (process.browser) {
  /* eslint-disable global-require */
  Slick = require('vue-slick').default;
  /* eslint-enable global-require */
}
export default {
  components: {
    cardNovel, Slick
  },
  props: {
    data: {
      type: Array,
      default: () => []
    },
    title: String,
    api: String,
    seeMore: {
      type: String,
      default: null
    },
    mode: {
      type: Number,
      default: 1
    },
  },
  data () {
    return {
      perMode: 9,
      isFetching: true,
      slickOptions: {
        slidesToShow: 7,
        slidesToScroll: 7,
        infinite: false,
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 6,
              slidesToScroll: 6,
              infinite: false,
              dots: false,
              arrows: false,
            }
          },
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
              dots: false,
              arrows: false,
            }
          },
          {
            breakpoint: 750,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              dots: false,
              arrows: false,
            }
          },
          {
            breakpoint: 620,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              dots: false,
              arrows: false,
            }
          },
          {
            breakpoint: 460,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              dots: false,
              arrows: false,
            }
          },
          {
            breakpoint: 310,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: false,
              arrows: false,
            }
          }
        ]
        // Any other options that can be got from plugin documentation
      },
    }
  },
  methods: {
    listNovelData () {
      this.isFetching = true
      this.$axios.$get(this.api)
        .then(data => {
          this.novels = data.data
          this.isFetching = false
        })
        .catch(error => {
          this.isFetching = true
        })
    }
  },
  mounted () {
    this.listNovelData()
  },
}
</script>

<style lang="scss" scoped>
@import "@/assets/sass/layout/_grid.scss";
@import "@/assets/sass/helpers/_variables.scss";

.list-novel {
  margin-bottom: 48px;
  @extend %row;
  display: flex;
  flex-direction: column;
  width: 100%;
  .mode-one-container {
    width: 100%;
  }
  .mode-two-container {
    margin-right: auto;
    margin-left: auto;
    padding-left: 10px;
    li {
      float: left;
      padding: 0 14px;
      @extend %col-2;
      &:first-child {
        @extend %col-4;
        background-color: #fff;
        height: 100%;
        padding: 20px;
        .card-novel {
          .header-card {
            h3 {
              font-size: 20px;
            }
            i {
              margin: 10px auto 15px auto;
              .__image {
              }
            }
          }
          .body-card {
            margin-bottom: 4px;
            .__genero {
              font-size: 16px;
            }
          }
          .footer-card {
            .star-rating {
              margin-bottom: 8px;
            }
          }
        }
      }
      .card-novel {
        padding: 0px;
      }
      &.the-fives {
        margin-bottom: 24px;
      }
      @media (min-width: 769px) and (max-width: 1087px) {
        width: 20%;
        &:first-child {
        }
      }
      @media (min-width: 501px) and (max-width: 768px) {
        @include col(3);
        &:first-child {
          @include col(6);
        }
      }
      @media (max-width: 500px) {
        display: none;
        &:first-child {
          display: flex;
          width: 100%;
          margin: 0;
        }
      }
    }
  }
}
</style>
<style lang="scss" >
// Default Variables

// Slick icon entity codes outputs the following
// "\2190" outputs ascii character "←"
// "\2192" outputs ascii character "→"
// "\2022" outputs ascii character "•"
@import "slick-carousel/slick/slick.css";

$slick-font-path: "./fonts/" !default;
$slick-font-family: "slick" !default;
$slick-loader-path: "./" !default;
$slick-arrow-color: #000 !default;
$slick-prev-character: url("/images/left-arrow.svg") !default;
$slick-next-character: url("/images/right-arrow.svg") !default;
$slick-opacity-default: 0.75 !default;
$slick-opacity-on-hover: 1 !default;
$slick-opacity-not-active: 0.25 !default;
.slick-slider .slick-track {
  margin: 0px;
}

.slick-prev,
.slick-next {
  position: absolute;
  display: block;
  height: 40px;
  width: 40px;
  line-height: 0px;
  font-size: 0px;
  cursor: pointer;
  background: transparent;
  color: transparent;
  top: 50%;
  -webkit-transform: translate(0, -50%);
  -ms-transform: translate(0, -50%);
  transform: translate(0, -50%);
  padding: 0;
  border: none;
  outline: none;
  &:hover,
  &:focus {
    outline: none;
    background: transparent;
    &:before {
      opacity: $slick-opacity-on-hover;
    }
  }
  &.slick-disabled {
    display: none !important;
    opacity: 0;
    &:before {
      opacity: 0;
      &:before {
        opacity: 0;
      }
    }
  }
  &:before {
    font-family: $slick-font-family;
    font-size: 20px;
    line-height: 1;
    color: $slick-arrow-color;
    opacity: $slick-opacity-default;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
}

.slick-prev {
  left: -45px;
  [dir="rtl"] & {
    left: auto;
    right: -45px;
  }
  &:before {
    content: $slick-prev-character;

    [dir="rtl"] & {
      content: $slick-next-character;
    }
  }
}

.slick-next {
  right: -45px;
  [dir="rtl"] & {
    left: -45px;
    right: auto;
  }
  &:before {
    content: $slick-next-character;
    [dir="rtl"] & {
      content: $slick-prev-character;
    }
  }
}
</style>
