<template>
  <div id="layout-default">
    <default-header />
    <nuxt />
    <default-footer />
  </div>
</template>

<script>
import defaultHeader from "@/components/layouts/default/header";
import defaultFooter from "@/components/layouts/default/footer";

export default {
  name: "Layout",
  components: {
    defaultHeader,
    defaultFooter
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
    };
  },
  data() {
    return {};
  }
};
</script>

<style lang="scss">
@import "@/assets/sass/main.scss";
#layout-default {
  display: flex;
  flex-direction: column;
  background-size: 100%;
  font-family: "Source Sans Pro", sans-serif;
  min-height: 100vh;
  @extend %justify-between;
  font-weight: 400;
}
html {
  background-color: #fff;
}
</style>
