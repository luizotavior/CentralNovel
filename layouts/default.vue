<template>
  <div id="layout-default">
    <default-header/>
    <nuxt/>
    <default-footer/>
  </div>
</template>

<script>
  import defaultHeader from '@/components/layouts/default/header'
  import defaultFooter from '@/components/layouts/default/footer'

  export default {
    name: "Layout",
    components: {
      defaultHeader,defaultFooter
    },
    head() {
      return {
        title: "Central Novel",
        meta: [
          {
            hid: "description",
            name: "description",
            content: "My custom description"
          }
        ]
      }
    },
    data() {
      return {
      }
    }
  }
</script>

<style lang="scss">
  @import "@/assets/sass/themes/_theme.scss";
  @import "@/assets/sass/main.scss";
  @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,700');
  #layout-default {
    display: flex;
    flex-direction: column;
    background-size: 100%; 
    font-family: 'Source Sans Pro', sans-serif;
    min-height: 100vh;
    @extend %justify-between;
    font-weight: 400;
  }
  html{
    background-color: #f5f6fc;
  }
</style>
