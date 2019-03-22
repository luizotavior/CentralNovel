<template>
    <main>
      <no-ssr placeholder="Loading...">
        <agile :autoplay="true" :autoplaySpeed="6000" :arrows="false" :dots="false" :infinite="true">
            <div class="slide">
                <img src="images/slides/slide_01.jpg" alt="">
            </div>

            <div class="slide">
                <img src="images/slides/slide_01.jpg" alt="">
            </div>
        </agile>
      </no-ssr>
    </main>
</template>

<style lang="scss">
    @import "@/assets/sass/themes/_theme.scss";
</style>
