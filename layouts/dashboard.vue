<template>
  <div id="layout-dashboard">
    <d-navbar />
    <div class="container-nuxt">
      <div class="container">
        <nuxt />
      </div>
    </div>
  </div>
</template>

<script>

import dNavbar from "@/components/layouts/dashboard/nav";
export default {
  name: "LayoutDashboard",
  middleware: ['authenticated','dashboard'],
  components: {
    dNavbar
  },
  head () {
    return {
      title: "Dashboard - Central Novel",
    };
  },
  data () {
    return {
    };
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#layout-dashboard {
  display: flex;
  flex-direction: row;
  min-height: 100vh;
  padding-left: 260px;
  background-color: rgb(245, 248, 250);
  div.container-nuxt {
    margin: 0;
    display: flex;
    flex-direction: row;
    @extend %justify-center;
    width: 100%;
    padding: 0 10% 5% 5%;
  }
  @media (max-width: 768px) {
    padding-left: 0px;
  }
}
</style>
