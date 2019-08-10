<template>
    <header>
        <default-nav/>
    </header>
</template>

<script>
  import defaultNav from '@/components/layouts/default/nav'

  export default {
    name: "Layout",
    components: {defaultNav},
}
</script>

<style lang="scss" scoped>
  @import "@/assets/sass/main.scss";
  header{
    padding-top: 80px;
  }
</style>
