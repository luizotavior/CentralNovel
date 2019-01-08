<template>
  <div id="breadcrumb">
    <nuxt-link to="/about">
      <b-icon icon="home" size="is-small"/>
    </nuxt-link>
    <span class="__limit">/</span>
    <nuxt-link to="/about">
      Romance
    </nuxt-link>
    <span class="__limit">/</span>
    <nuxt-link to="/about">
      Velho Mestre
    </nuxt-link>
  </div>
</template>

<style lang="scss" scoped>
  @import "@/assets/sass/main.scss";
  #breadcrumb{
    padding: 24px 0;
    display: flex;
    flex-direction: row;
    .__limit{
      margin: 0 5px;
    }
    a{
      color: #000;
      &:hover{
        color: #000;
        text-decoration: underline;
      }
    }
  }

</style>
