<template>
  <div id="page-home">
    a
  </div>
</template>

<script>

export default {
  name: 'Home',
  components: {

  },
  data() {
    return {
    }
  }
}
</script>

<style lang="scss">
  @import "@/assets/sass/layout/_grid.scss";
  @import '@/assets/sass/helpers/_variables.scss';
  #page-home{
    position: relative;
    margin: 0 auto;
    margin-top: -102px;
    @extend %row;
    max-width: 1036px;
    width: 100%;
    &:before {
      position: absolute;
      z-index: -1;
      width: 1036px;
      height: 380px;
      content: '';
      border-radius: 8px 8px 0 0;
      background: linear-gradient(to bottom,#fff,#f5f6fc);
    }
  }
</style>
