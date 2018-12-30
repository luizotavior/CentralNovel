<template>
    <nav id="default-nav">
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Novels</a></li>
            <li><a href="">Grupos</a></li>
            <li><a href="https://discordapp.com/invite/qCjSsdX" class="" target="_blank">Discord</a></li>
            <li><a href="">Aliança</a></li>
            <li><a href="">Contato</a></li>
        </ul>
    </nav>
</template>

<style lang="scss" scoped>
    @import "@/assets/sass/layout/_grid.scss";
    @import "@/assets/sass/helpers/_variables.scss";
    nav#default-nav{
        border-top: 1px solid rgba(0,0,0,0.54);
        border-bottom: 1px solid rgba(0,0,0,0.54);
        display: flex;
        margin-top: 10px;
        margin-bottom: 20px;
        @extend %justify-center;
        ul{
            padding: 0px;
            margin: 10px;
            display: flex;
            flex-direction: row;
            list-style: none;
            flex-wrap: wrap;
            @extend %justify-center;
            li{
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 10px;
                padding-right: 10px;
                a{
                    text-decoration: none;
                    color: $gray-01;
                    &:hover,
                    &.active{
                        color: $primary;
                    }
                }
            }
        }
    }
</style>
