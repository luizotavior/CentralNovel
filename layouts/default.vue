<template>
  <div id="layout-default">
    <default-header/>
    <nuxt/>
    <default-legado/>
    <default-footer/>
  </div>
</template>

<script>
  import defaultHeader from '@/components/layouts/default/header'

  export default {
    name: "Layout Default",
    components: {
      defaultHeader
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
    background-image: url('/images/bg/nuvens.jpg');
    background-repeat: repeat-y;
    background-size: 100%; 
    font-family: 'Source Sans Pro', sans-serif;
	  font-weight: 400;
  }
</style>
