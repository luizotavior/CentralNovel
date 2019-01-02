<template>
    <div class="card-novel">
        <div class="header-card">
            <a href="#">
                <i>
                    <img class="__image" src="https://centralnovel.com.br/storage/novels/velho-mestre.jpg" alt="">
                </i>
                <h3>Velho Mestre</h3>
            </a>
        </div>
        <div class="body-card">
            <a class="__genero" href="#">Cenário Futurista</a>
        </div>
        <div class="footer-card">
            <star-rating v-if="rating" :current-rating="Math.random()*5"/>
            <div v-if="sinopse">
                <p>With the rising tide of steam power and machinery, who can come close to being a Beyonder? Shrouded in the fog of history and darkness, who or what is the lurking evil that murmurs into our ears? Waking up to be faced with a string of mysteries, Zhou... </p>
            </div>
        </div>
    </div>
</template>

<script>
import starRating from '@/components/starRating.vue';

export default {
    components:{
        starRating,
    },
    props: {
        data: {
            type: Array,
            default: () => []
        },
        rating: {
            type: Boolean,
            default: false
        },
        sinopse: {
            type: Boolean,
            default: false
        },
    },
}
</script>

<style lang="scss" scoped>
    @import "@/assets/sass/layout/_grid.scss";
    @import '@/assets/sass/helpers/_variables.scss';
    .card-novel{
        display: flex;
        flex-direction: column;
        padding: 10px;
        .header-card{
            a{
                i{
                    display: flex;
                    overflow: hidden;
                    margin-bottom: 8px;
                    .__image{
                        max-width: 100%;
                        transform: ease-out .3s;
                        -moz-transition: all 0.3s;
                        -webkit-transition: all 0.3s;
                        transition: all 0.3s;
                        max-height: 260px;
                        &:hover{
                            -moz-transform: scale(1.1);
                            -webkit-transform: scale(1.1);
                            transform: scale(1.1);
                        }
                    }
                }
                h3{
                    font-weight: 400;
                    color: #000;
                    padding-left: 1px;
                    font-size: 16px;
                }
                &:hover{
                    h3{
                        text-decoration: underline;
                    }
                }
            }
        }
        .body-card{
            .__genero{
                font-size: 14px;
                color: #83848f;
                font-weight: 300;
            }
            &:hover{
                .__genero{
                    text-decoration: underline;
                }
            }
        }
        .footer-card{}
    }
</style>
