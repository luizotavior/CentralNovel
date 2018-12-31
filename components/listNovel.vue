<template>
    <div class="list-novel">
        <div class="list-novel-header">
            <h2>Novos na Central Novel</h2>
        </div>
        <div class="carousel-container">
            <slick
                ref="slick"
                :options="slickOptions">
                <card-novel/>
                <card-novel/>
                <card-novel/>
                <card-novel/>
                <card-novel/>
                <card-novel/>
                <card-novel/>
                <card-novel/>
                <card-novel/>
                <card-novel/>
            </slick>

        </div>
    </div>
</template>

<script>
import cardNovel from '@/components/cardNovel.vue';
import Slick from 'vue-slick';
export default {
    components: {
        cardNovel,Slick
    },
    props: {

    },
    data() {
        return {
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
        next() {
            this.$refs.slick.next();
        },

        prev() {
            this.$refs.slick.prev();
        },

        reInit() {
            // Helpful if you have to deal with v-for to update dynamic lists
            this.$nextTick(() => {
                this.$refs.slick.reSlick();
            });
        },

        // Events listeners
        handleAfterChange(event, slick, currentSlide) {
            console.log('handleAfterChange', event, slick, currentSlide);
        },
        handleBeforeChange(event, slick, currentSlide, nextSlide) {
            console.log('handleBeforeChange', event, slick, currentSlide, nextSlide);
        },
        handleBreakpoint(event, slick, breakpoint) {
            console.log('handleBreakpoint', event, slick, breakpoint);
        },
        handleDestroy(event, slick) {
            console.log('handleDestroy', event, slick);
        },
        handleEdge(event, slick, direction) {
            console.log('handleEdge', event, slick, direction);
        },
        handleInit(event, slick) {
            console.log('handleInit', event, slick);
        },
        handleReInit(event, slick) {
            console.log('handleReInit', event, slick);
        },
        handleSetPosition(event, slick) {
            console.log('handleSetPosition', event, slick);
        },
        handleSwipe(event, slick, direction) {
            console.log('handleSwipe', event, slick, direction);
        },
        handleLazyLoaded(event, slick, image, imageSource) {
            console.log('handleLazyLoaded', event, slick, image, imageSource);
        },
        handleLazeLoadError(event, slick, image, imageSource) {
            console.log('handleLazeLoadError', event, slick, image, imageSource);
        },
    },
}
</script>

<style lang="scss" >
  @import "@/assets/sass/layout/_grid.scss";
  @import '@/assets/sass/helpers/_variables.scss';
    @import 'slick-carousel/slick/slick.css';
  
    .list-novel{
        margin-bottom: 48px;
        @extend %row;
        padding: 12px;
        display:flex;
        flex-direction: column;
        width: 100%;
        div.list-novel-header{
            margin-bottom: 22px;
            h2{
                font-size: 32px; 
            }
            
        }
        .carousel-container{
            width: 100%;
        }
    }
    // Default Variables

    // Slick icon entity codes outputs the following
    // "\2190" outputs ascii character "←"
    // "\2192" outputs ascii character "→"
    // "\2022" outputs ascii character "•"

    $slick-font-path: "./fonts/" !default;
    $slick-font-family: "slick" !default;
    $slick-loader-path: "./" !default;
    $slick-arrow-color: #000 !default;
    $slick-prev-character: url('/images/left-arrow.svg') !default;
    $slick-next-character: url('/images/right-arrow.svg') !default;
    $slick-opacity-default: 0.75 !default;
    $slick-opacity-on-hover: 1 !default;
    $slick-opacity-not-active: 0.25 !default;

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
        &:hover, &:focus {
            outline: none;
            background: transparent;
            &:before {
                opacity: $slick-opacity-on-hover;
            }
        }
        &.slick-disabled{
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
