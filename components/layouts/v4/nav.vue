<template>
  <nav
    id="menu-secundario"
    class="navbar"
    role="navigation"
    aria-label="main navigation">
    <div class="navbar-brand">
      <a
        :class="['navbar-burger','burger', navbar.responsive ? 'is-active' : '']"
        role="button"
        aria-label="menu"
        aria-expanded="false"
        data-target="navbarBasicExample"
        @click="navbar.responsive = !navbar.responsive">
        <span aria-hidden="true"/>
        <span aria-hidden="true"/>
        <span aria-hidden="true"/>
      </a>
    </div>

    <div
      id="navbarBasicExample"
      :class="['navbar-menu', navbar.responsive ? 'is-active' : '']">
      <div class="navbar-start">
        <a class="navbar-item" href="#">
          <img src="images/logo/logo-quadrada.png" alt="">
        </a>
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link" href="https://bulma.io/documentation/overview/start/">
            Gêneros
          </a>
          <div class="navbar-dropdown is-boxed">
            <a class="navbar-item" href="https://bulma.io/documentation/overview/start/">
              Overview
            </a>
            <a class="navbar-item" href="https://bulma.io/documentation/modifiers/syntax/">
              Modifiers
            </a>
            <a class="navbar-item" href="https://bulma.io/documentation/columns/basics/">
              Columns
            </a>
            <a class="navbar-item" href="https://bulma.io/documentation/layout/container/">
              Layout
            </a>
            <a class="navbar-item" href="https://bulma.io/documentation/form/general/">
              Form
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item" href="https://bulma.io/documentation/elements/box/">
              Elements
            </a>
            <a class="navbar-item is-active" href="https://bulma.io/documentation/components/breadcrumb/">
              Components
            </a>
          </div>
        </div>
        <b-tooltip label="Tooltip bottom"
          position="is-bottom">
        <a class="navbar-item" href="https://bulma.io/">
          Novels
        </a>
        </b-tooltip>
        <b-tooltip label="Tooltip bottom"
          position="is-bottom">
        <a class="navbar-item" href="https://bulma.io/">
          Grupos
        </a>
        </b-tooltip>
        <b-tooltip label="Tooltip bottom"
          position="is-bottom">
          <a class="navbar-item" href="https://bulma.io/">
            Ranked
          </a>
        </b-tooltip>
      </div>
      <div class="navbar-end">
        <b-tooltip label="Tooltip bottom"
          position="is-bottom">
          <a class="navbar-item" href="https://bulma.io/">
            Fórum
          </a>
        </b-tooltip>
        <b-tooltip label="Tooltip bottom"
          position="is-bottom">
          <a class="navbar-item" href="https://bulma.io/">
            Login
          </a>
        </b-tooltip>
        <div class="navbar-item has-dropdown is-hoverable">
          
          <a class="navbar-link">
            <div class="avatar-circle">
              <img
                src="/images/avatar/default.jpg"
                alt="">
            </div>
          </a>
          <div class="navbar-dropdown is-right">
            <a class="navbar-item">
              Perfil
            </a>
            <a
              class="navbar-item"
              @click="$auth.logout();">
              Logout
            </a>
            <hr class="navbar-divider">
            <div class="navbar-item">
              Version 4.0
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      navbar: {
        responsive: false,
        search: null,
      }
    };
  },
  computed:{
  },
};
</script>

<style lang="scss" scoped>
  nav#menu-secundario {
    background-color: #fff;
    height: 65px;
    box-shadow: 3px 0px 6px #888888;
    width: 100%;
    div.avatar-circle {
      height: 38px;
      width: 38px;
      img {
        border-radius: 50%;
        height: 100%;
        width: 100%;
        max-height: 100%;
      }
    }
  }
  #navbarBasicExample{
    max-width: 1200px;
    margin: 0 auto;
  }
</style>