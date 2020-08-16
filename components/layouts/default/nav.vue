<template>
  <div>
    <b-navbar
      id="cn-navbar"
      :fixed-top="true"
      :transparent="true"
      wrapperClass="container"
    >
      <template slot="brand">
        <b-navbar-item href="/">
          <img
            src="/images/logos/logo-quadrada.png"
            alt="Logo Central Novel"
            style="max-height: 48px;"
          />
        </b-navbar-item>
      </template>
      <template slot="start">
        <b-navbar-item href="/series">
          <b-icon icon="compass"></b-icon> <span>Navegar</span>
        </b-navbar-item>
        <b-navbar-item href="/ranking">
          <b-icon icon="fire"></b-icon>
          Rankings
        </b-navbar-item>
        <b-navbar-item href="#updates">
          <b-icon icon="flag"></b-icon>
          Atualizações
        </b-navbar-item>
        <b-navbar-item @click="isCreate = true">
          <b-icon icon="pencil-circle"></b-icon>
          Criar
        </b-navbar-item>
      </template>
      <template slot="end">
        <b-navbar-item tag="div">
          <b-field>
            <search label="Pesquisar..." />
          </b-field>
        </b-navbar-item>
        <b-navbar-item @click="isComingSoon = true">
          <b-tooltip label="Get the App" position="is-bottom" type="is-dark">
            <b-icon icon="cellphone-arrow-down"></b-icon>
          </b-tooltip>
        </b-navbar-item>
        <b-navbar-item href="/library">
          <b-tooltip label="Biblioteca" position="is-bottom" type="is-dark">
            <b-icon icon="book"></b-icon>
          </b-tooltip>
        </b-navbar-item>
        <b-navbar-item @click="isComingSoon = true">
          <b-tooltip label="Inbox" position="is-bottom" type="is-dark">
            <b-icon icon="inbox"></b-icon>
          </b-tooltip>
        </b-navbar-item>
        <b-navbar-item @click="isComingSoon = true">
          <b-tooltip label="Forum" position="is-bottom" type="is-dark">
            <b-icon icon="forum"></b-icon>
          </b-tooltip>
        </b-navbar-item>
        <b-navbar-item tag="div" v-if="!$store.state.auth.loggedIn">
          <div class="buttons">
            <b-button type="is-primary" tag="router-link" to="/login" rounded
              >Entrar</b-button
            >
          </div>
        </b-navbar-item>

        <b-navbar-dropdown
          v-if="$store.state.auth.loggedIn"
          hoverable
          right
          class="is-arrowless"
        >
          <template slot="label" class="is-arrowless">
            <avatar :size="38" :username="this.$auth.$state.user.username" />
          </template>
          <!-- <hr class="dropdown-divider" /> -->
          <b-navbar-item
            value="logout"
            aria-role="menuitem"
            @click="$auth.logout()"
          >
            Logout
          </b-navbar-item>
        </b-navbar-dropdown>
      </template>
    </b-navbar>
    <b-modal :width="640" :active.sync="isCreate">
      <p>
        <a href="#">
          <img
            src="https://i1.wp.com/novelmania.com.br/wp-content/uploads/2017/01/Desafio-para-o-combo-de-ATG-Novel-Mania.png?w=1000"
          />
        </a>
      </p>
    </b-modal>
    <b-modal :width="640" :active.sync="isComingSoon">
      <p>
        <a href="#">
          <img
            src="https://i2.wp.com/novelmania.com.br/wp-content/uploads/2018/09/Social-Post-ATG-Novel-Mania.jpg?resize=900%2C471"
          />
        </a>
      </p>
    </b-modal>
  </div>
</template>

<script>
import search from "@/components/layouts/default/searchSerie.vue";
import avatar from "vue-avatar";

export default {
  components: {
    search,
    avatar
  },
  data() {
    return {
      isCreate: false,
      isComingSoon: false
    };
  },
  computed: {},
  methods: {}
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#cn-navbar {
  & > .container {
    width: 100%;
    max-width: 1200px;
    .navbar-menu {
      .navbar-start {
        font-weight: 500;
        .icon {
          margin-right: 3px;
        }
      }
    }
  }
}
</style>
