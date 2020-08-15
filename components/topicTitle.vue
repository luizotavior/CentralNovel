<template>
  <div class="topic-title is-size-5">
    <h2 :class="size">{{ title }} </h2>
    <a
      class="see-more"
      v-if="seeMore != null"
      :href="seeMore"
      title="Veja Mais"
    >Veja Mais</a>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    size: {
      type: String,
      default: "is-size-3"
    },
    seeMore: {
      type: String,
      default: null
    },
  },
}
</script>

<style lang="scss" scoped>
@import "@/assets/sass/layout/_grid.scss";
@import "@/assets/sass/helpers/_variables.scss";
div.topic-title {
  margin-bottom: 22px;
  display: flex;
  flex-direction: row;
  padding: 0 12px;
  @extend %justify-between;
  @extend %vertical-align-middle;
  h2 {
    font-size: 32px;
  }
  a.see-more {
    min-width: 62px;
  }
}
</style>

