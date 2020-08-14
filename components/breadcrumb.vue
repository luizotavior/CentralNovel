<template>
  <div id="breadcrumb">
    <nuxt-link to="/">
      Home
    </nuxt-link>
    <span class="__limit">/</span>
    <nuxt-link to="/series">
      Series
    </nuxt-link>
    <span class="__limit">/</span>
    <nuxt-link :to="'/series/'+serie.slug">
      {{ serie.title }}
    </nuxt-link>
  </div>
</template>

<script>
export default {

  props: {
    serie: {
      type: Object,
      default: () => { }
    },
  },
}
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#breadcrumb {
  padding: 24px 0;
  display: flex;
  flex-direction: row;
  .__limit {
    margin: 0 5px;
  }
  a {
    color: #090909;
    &:hover {
      color: $primary;
      text-decoration: underline;
    }
  }
}
</style>
