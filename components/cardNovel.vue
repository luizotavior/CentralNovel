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
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>
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
                    img{
                        max-width: 100%;
                        transform: ease-out .3s;
                        -moz-transition: all 0.3s;
                        -webkit-transition: all 0.3s;
                        transition: all 0.3s;
                        &:hover{
                            -moz-transform: scale(1.1);
                            -webkit-transform: scale(1.1);
                            transform: scale(1.1);
                        }
                    }
                }
                h3{
                    font-weight: 700;
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
