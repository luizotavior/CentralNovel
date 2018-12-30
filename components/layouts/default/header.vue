<template>
    <header>
        <default-nav-top/>
        <div class="logo">
            <a href="/home"><img class="logo" src="images/logo/main-logo.png" alt=""></a>
        </div>
        <default-nav/>
    </header>
</template>

<script>
    import defaultNavTop from '@/components/layouts/default/nav-top'
    import defaultNav from '@/components/layouts/default/nav'
    export default {
        name: "Default Header",
        components:{
            defaultNavTop,
            defaultNav
        }
    }
</script>

<style lang="scss" scoped>
    @import "@/assets/sass/layout/_grid.scss";
    header{
        @extend %row;
        width: 100%;
        display: flex;
        flex-direction: column;
        margin: 0 auto;
        div.logo{
            text-align: center;
            img{
                height: 300px;
            }
        }
    }
</style>
