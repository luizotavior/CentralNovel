<template>
    <div id="suggested-tags">
        <div class="suggested-tags-header">
            <h2>Tags Sugeridas</h2>
        </div>
        <ul>
            <li class="column is-3">
                <a href="#">
                    <span>Ficção Cientifica</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Fantasia</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Romance</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Xuanhuan</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Artes Marciais</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Reencarnação</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Vingança</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Comédia</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Shoujo</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Lolicon</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Yaoi</span>
                </a>
            </li>
            <li class="column is-3">
                <a href="#">
                    <span>Yuri</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>
    @import "@/assets/sass/layout/_grid.scss";
    @import '@/assets/sass/helpers/_variables.scss';
    #suggested-tags{
        margin-bottom: 48px;
        div.suggested-tags-header{
            padding: 12px;
            margin-bottom: 22px;
            h2{
                font-size: 32px; 
            }
            
        }
        ul{
            @extend %row;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            li{
                margin: 0px;
                padding: 0px;
                a{
                    display: flex;
                    justify-content: center;
                    margin-bottom: 16px;
                    margin-right: 14px;
                    margin-left: 14px;
                    font-size: 18px;
                    color: #000;
                    border-radius: 4px;
                    background-color: #fff;
                    @media (max-width: 768px) {
                        margin-bottom: 8px;
                        margin-right: 7px;
                        margin-left: 7px;
                        min-width: 140px;
                        span{
                            padding:6px;
                        }
                    }
                    @media (max-width: 400px) {
                        margin-bottom: 6px;
                        margin-right: 4px;
                        margin-left: 4px;
                        span{
                            padding:2px;
                        }
                    }
                    span{
                        display: block;
                        padding: 12px;
                        text-align: center;
                    }
                    &:hover{
                        background-color: $primary;
                        color: #fff;

                    }
                }
            }
        }
    }
</style>