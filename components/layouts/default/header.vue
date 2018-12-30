<template>
    <header>
        <default-nav/>
        <default-slider/>
    </header>
</template>

<script>
  import defaultNav from '@/components/layouts/default/nav'
  import defaultSlider from '@/components/layouts/default/slider'

  export default {
    name: "Layout",
    components: {defaultNav,defaultSlider},
}
</script>

<style lang="scss" scoped>

</style>
