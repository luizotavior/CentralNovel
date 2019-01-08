<template>
  <nav
    id="menu-secundario"
    class="navbar"
    role="navigation"
    aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item is-hidden-desktop" href="#">
        <img src="/images/logo/logo-quadrada.png" alt="Logo Central Novel">
      </a>
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
        <a class="navbar-item is-hidden-touch " href="#" title="Central Novel">
          <img src="/images/logo/logo-quadrada.png" alt="Logo Central Novel">
        </a>
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-item" href="#" title="Gêneros">
            Gêneros
          </a>
          <div class="navbar-dropdown is-boxed">
            <a class="navbar-item" href="#" title="Romance">
              Romance
            </a>
          </div>
        </div>
        <a class="navbar-item" href="#">
          Novels
        </a>
        <a class="navbar-item" href="#">
          Grupos
        </a>
          <a class="navbar-item" href="#">
            Ranked
          </a>
      </div>
      <div class="navbar-end">
          <a class="navbar-item" href="#">
            Fórum
          </a>
          <a class="navbar-item" href="#">
            Login
          </a>
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
  @import "@/assets/sass/themes/_theme.scss";
  nav#menu-secundario {
    background-color: #fff;
    height: 65px;
    border-bottom: 1px solid #dcdce2;
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