<template>
  <b-navbar id="cn-navbar" :fixed-top="true">
    <template slot="brand">
      <b-navbar-item href="/">
        <img
          src="/images/logo/logo-quadrada.png"
          alt="Logo Central Novel"
          style="max-height: 48px;"
        />
      </b-navbar-item>
    </template>
    <template slot="start">
      <b-navbar-item href="#">
        Gêneros
      </b-navbar-item>
      <b-navbar-item href="#">
        Novels
      </b-navbar-item>
      <b-navbar-item href="#">
        Grupos
      </b-navbar-item>
      <b-navbar-item href="#">
        Fórum
      </b-navbar-item>
      <b-navbar-item href="#">
        Estatísticas
      </b-navbar-item>
    </template>

    <template slot="end">
      <b-navbar-item tag="div">
        <div class="buttons">
          <b-navbar-item href="#">
            Login
          </b-navbar-item>
          <b-navbar-item href="#">
            Register
          </b-navbar-item>
        </div>
      </b-navbar-item>
    </template>
  </b-navbar>
</template>

<script>
export default {
  data() {
    return {};
  },
  computed: {}
};
</script>

<style lang="scss">
@import "@/assets/sass/main.scss";
#cn-navbar {
  & > .container {
    width: 100%;
    max-width: 1200px;
  }
}
</style>
