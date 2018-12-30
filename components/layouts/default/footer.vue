<template>
    <footer>
        <div class="columns">
            <div class="column is-4 column-first">
                <a href="#"><img src="images/logo/logo-quadrada.png" alt=""></a>
                <div>
                    <p class="social">
                        <a href="#"><b-icon icon="facebook"/></a>
                        <a href="#"><b-icon icon="instagram"/></a>
                        <a href="#"><b-icon icon="discord"/></a>
                    </p>
                    <p class="cn-marca">© 2015-2019 Central Novel</p>
                </div>
            </div>
            <div class="column is-3  is-hidden-mobile">
                <h4>Contatos</h4>
                <p>
                    <a href="#">Tradutores e Editores</a>
                    <a href="#">Link Teste</a>
                    <a href="#">Ajuda e Serviço</a>
                    <a href="#">Link Teste</a>
                </p>
            </div>
            <div class="column is-3 is-hidden-mobile">
                <h4>Recursos</h4>
                <p>
                    <a href="#">Baixar aplicativo</a>
                    <a href="#">Seja um autor</a>
                    <a href="#">Central de Ajuda</a>
                    <a href="#">Política de Privacidade</a>
                    <a href="#">Termos de Serviço</a>
                </p>
            </div>
            <div class="column is-2 is-hidden-mobile">
                <h4>Referências</h4>
                <p>
                    <a href="#">WebNovel</a>
                    <a href="#">NovelUpdates</a>
                    <a href="#">Luiz Otávio Rodrigues</a>
                </p>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>
  @import "@/assets/sass/layout/_grid.scss";
  @import '@/assets/sass/helpers/_variables.scss';
    footer{
        padding: 64px 0 56px;
        background-color: #25253d;
        width: 100%;
        .columns{
            max-width: 1008px;
            margin: 0 auto;
            min-height: 192px;
            .column{
                display: flex;
                flex-direction: column;
                height: auto;
                &.column-first{
                    justify-content: space-between;
                    img{
                        height: 50px;
                    }
                    @media (max-width: 768px) {
                        align-content: center;
                        text-align: center;
                        .social{
                            justify-content: center; 
                        }
                        img{
                            height: 80px;
                        }
                    }
                }
                h4{
                    color: white;
                    margin-bottom: 24px;
                    font-size: 16px;
                    text-transform: uppercase;
                }
                p{
                    display: flex;
                    flex-direction: column;
                    color: rgba(255,255,255,.5);
                    font-size: 14px;
                    a{
                        color: rgba(255,255,255,.5);
                        &:hover{
                            color: $primary;
                        }
                        &+a {
                            margin-top: 12px;
                        }
                    }
                    &.social{
                        flex-direction: row;
                        margin: 0;
                        margin-bottom: 12px;
                        a{
                            margin-right: 16px;
                            &+a {
                                margin-top: 0px;
                            }
                        }
                    }
                }

                @media (min-width: 769px) and (max-width: 1215px) {
                    margin: 0 auto;
                }
            }
        }
    }
</style>