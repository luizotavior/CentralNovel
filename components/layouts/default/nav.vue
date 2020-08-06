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
            src="/images/logo/logo-quadrada.png"
            alt="Logo Central Novel"
            style="max-height: 48px;"
          />
        </b-navbar-item>
      </template>
      <template slot="start">
        <b-navbar-dropdown
          hoverable
          :arrowless="true"
          class="is-arrowless"
        >
          <template
            slot="label"
            class="is-arrowless"
          >
            <b-icon icon="compass"></b-icon> <span>Browse</span>
          </template>
          <b-navbar-item href="/series">
            <span>Novels</span>
          </b-navbar-item>
          <b-navbar-item @click="isComingSoon = true">
            <span>Comics (Coming Soon)</span>
          </b-navbar-item>
        </b-navbar-dropdown>

        <b-navbar-dropdown
          hoverable
          :arrowless="true"
          class="is-arrowless"
        >
          <template
            slot="label"
            class="is-arrowless"
          >
            <b-icon icon="fire"></b-icon>
            Rankings
          </template>
          <b-navbar-item href="#">
            <span>Novels Ranking</span>
          </b-navbar-item>
          <b-navbar-item @click="isComingSoon = true">
            <span>Comics Ranking (Coming Soon)</span>
          </b-navbar-item>
        </b-navbar-dropdown>
        <b-navbar-item href="#updates">
          <b-icon icon="flag"></b-icon>
          Updates
        </b-navbar-item>
        <b-navbar-item @click="isCreate = true">
          <b-icon icon="pencil-circle"></b-icon>
          Create
        </b-navbar-item>
      </template>
      <template slot="end">
        <b-navbar-item tag="div">
          <b-field>
            <search label="Search..." />
          </b-field>
        </b-navbar-item>
        <b-navbar-item @click="isComingSoon = true">
          <b-tooltip
            label="Get the App"
            position="is-bottom"
            type="is-dark"
          >
            <b-icon icon="cellphone-arrow-down"></b-icon>
          </b-tooltip>
        </b-navbar-item>
        <b-navbar-item @click="isComingSoon = true">
          <b-tooltip
            label="Library"
            position="is-bottom"
            type="is-dark"
          >
            <b-icon icon="book"></b-icon>
          </b-tooltip>
        </b-navbar-item>
        <b-navbar-item @click="isComingSoon = true">
          <b-tooltip
            label="Inbox"
            position="is-bottom"
            type="is-dark"
          >
            <b-icon icon="inbox"></b-icon>
          </b-tooltip>
        </b-navbar-item>
        <b-navbar-item @click="isComingSoon = true">
          <b-tooltip
            label="Forum"
            position="is-bottom"
            type="is-dark"
          >
            <b-icon icon="forum"></b-icon>
          </b-tooltip>
        </b-navbar-item>
        <b-navbar-item tag="div">
          <div class="buttons">
            <b-button
              type="is-primary"
              rounded
            >Sign In</b-button>
          </div>
        </b-navbar-item>
      </template>
    </b-navbar>
    <b-modal
      :width="640"
      :active.sync="isCreate"
    >
      <p>
        <a href="#">
          <img src="https://i1.wp.com/novelmania.com.br/wp-content/uploads/2017/01/Desafio-para-o-combo-de-ATG-Novel-Mania.png?w=1000">
        </a>
      </p>
    </b-modal>
    <b-modal
      :width="640"
      :active.sync="isComingSoon"
    >
      <p>
        <a href="#">
          <img src="https://i2.wp.com/novelmania.com.br/wp-content/uploads/2018/09/Social-Post-ATG-Novel-Mania.jpg?resize=900%2C471">
        </a>
      </p>
    </b-modal>
  </div>

</template>

<script>
import search from '@/components/layouts/default/searchSerie.vue'
export default {
  components: {
    search
  },
  data () {
    return {
      isCreate: false,
      isComingSoon: false,
    };
  },
  computed: {},
  methods: {
  },
};
</script>

<style lang="scss">
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
