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
    data() {
        return {
            slickOptions: {
                slidesToShow: 7,
                slidesToScroll: 1,
                infinite: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 6,
                            slidesToScroll: 6,
                            infinite: false,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 1100,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5
                        }
                    },
                    {
                        breakpoint: 750,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 620,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 460,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 310,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
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
        @extend %row;
        padding: 12px;
        display:flex;
        flex-direction: column;
        width: 100%;
        .carousel-container{
            width: 100%;
        }
    }
</style>
