<template>
  <div id="layout-default">
    <default-nav/>
    <slider/>
    <nuxt/>
  </div>
</template>

<script>
  import defaultNav from '@/components/layouts/default/nav'
  import slider from '@/components/layouts/default/slider'

  export default {
    name: "Layout",
    components: {
      defaultNav,slider
    },
    data() {
      return {
      }
    }
  }
</script>

<style lang="scss">
  @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700');
  #layout-default {
    display: flex;
    flex-direction: column;
    background-size: 100%; 
    font-family: 'Source Sans Pro', sans-serif;
    font-weight: 400;
  }
  html{
    background-color: #f5f6fc;
  }
</style>
