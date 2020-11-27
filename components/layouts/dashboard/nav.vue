<template>
  <div id="component-dashboard-navbar">
    <b-sidebar
      :fullheight="true"
      :fullwidth="false"
      :overlay="false"
      mobile="reduce"
      v-model="open"
    >
      <div class="sidebar-container">
        <div class="sidebar-logo">
          <img
            src="/images/logos/logo.png"
            alt=""
          />
        </div>
        <div class="sidebar-user">
          <avatar
            :size="38"
            :username="'Luiz'"
          />
          <span class="username is-hidden-touch">{{
            this.$auth.$state.user.username
          }}</span>
        </div>
        <b-menu>
          <b-menu-list label="Menu">
            <b-menu-item
              icon="account-circle"
              v-if="$auth.$state.user.permissions.some(e => e.name === 'dashboard.show')"
              label="Dashboard"
              disabled
            ></b-menu-item>
            <b-menu-item
              icon="account-circle"
              v-if="$auth.$state.user.permissions.some(e => e.name === 'releases.edit')"
              label="Releases"
              disabled
            ></b-menu-item>
            <b-menu-item
              icon="book"
              label="Series"
              v-if="$auth.$state.user.permissions.some(e => e.name === 'series.edit')"
              tag="router-link"
              :to="'/dashboard/series'"
            ></b-menu-item>
            <b-menu-item
              icon="account-circle"
              v-if="$auth.$state.user.permissions.some(e => e.name === 'groups.edit')"
              label="Grupos"
              tag="router-link"
              :to="'/dashboard/groups'"
            ></b-menu-item>
            <b-menu-item
              icon="account-circle"
              label="Usuários"
              v-if="$auth.$state.user.permissions.some(e => e.name === 'users.edit')"
              tag="router-link"
              :to="'/dashboard/users'"
            ></b-menu-item>
            <b-menu-item
              icon="account-circle"
              v-if="$auth.$state.user.permissions.some(e => e.name === 'adsense.show')"
              label="Adsense Interno"
              disabled
            ></b-menu-item>
          </b-menu-list>
          <b-menu-list label="Ações">
            <b-menu-item
              label="Retornar"
              tag="router-link"
              :to="'/'"></b-menu-item>
            <b-menu-item
            label="Sair"
            @click="$auth.logout()"></b-menu-item>
          </b-menu-list>
        </b-menu>
      </div>
    </b-sidebar>
  </div>
</template>

<script>
import avatar from "vue-avatar";
export default {
  name: "dashbordNav",
  components: {
    avatar
  },
  head () {
    return {
      title: "Dashboard - Central Novel"
    };
  },
  data () {
    return {
      open: true
    };
  }
};
</script>

<style lang="scss">
@import "@/assets/sass/main.scss";
#component-dashboard-navbar {
  display: flex;
  flex-direction: column;
  background-size: 100%;
  font-family: "Source Sans Pro", sans-serif;
  min-height: 100vh;
  @extend %justify-between;
  font-weight: 400;
  background-color: #e5e5e5;
}
div.b-sidebar {
  .sidebar-content {
    background-color: #fff;
    box-shadow: 6px 0 18px rgba(0, 0, 0, 0.06);
    .sidebar-container {
      padding: 12px;
      .sidebar-logo {
        display: flex;
        min-height: 80px;
        height: 100%;
        max-height: 120px;
        @extend %justify-center;
        @extend %vertical-align-middle;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        img {
          width: auto;
          max-height: 100%;
        }
      }
      .sidebar-user {
        display: flex;
        flex-direction: row;
        @extend %vertical-align-middle;
        flex-wrap: nowrap;
        padding: 12px 0;
        margin-bottom: 18px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        span.username {
          margin-left: 12px;
        }
      }
    }
  }
}
</style>
