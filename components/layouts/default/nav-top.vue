
<template>
    <div id="default-nav-top">
        <ul class="column-right column ">
            <li class="discord">
                <a href="https://discord.gg/qCjSsdX" target="_blank">
                    <b-icon icon="discord"/>
                </a>
            </li>
            <li class="facebook">
                <a href="https://www.facebook.com/centralnovel" target="_blank">
                    <b-icon icon="facebook"/>
                </a>
            </li>
        </ul>
        <ul class="column-left column is-6">
            <li><a href="/novels"><i class="fa fa-search" aria-hidden="true"></i></a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
        </ul>
    </div>
</template>

<style lang="scss" scoped>
    @import "@/assets/sass/layout/_grid.scss";
    
    #default-nav-top{
        @extend %row;
        margin: 0 auto;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        ul{
            display: flex;
            flex-direction: row;
            &.column-right{
                width: auto;
                display: flex;
                a{
                    &:hover{
                        color: #b07418;
                    }
                }
            }
            &.column-left{
                display: flex;
                justify-content: flex-end;
                li{
                    a{
                        color:rgba(0,0,0,.54);
                        &:hover{
                            color: #b07418;
                        }
                    }
                }
            }
            li{
                padding: 0 10px;
            }

        }
    }

</style>
