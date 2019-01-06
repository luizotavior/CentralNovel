<template>
  <div class="container">
    <b-notification 
      type="is-danger"
      has-icon>
      <h1 v-if="error.statusCode === 404">{{ error.statusCode }} - Page not found</h1>
      <h1 v-else>An error occured - Code {{ error.statusCode }}</h1>
      <h2>{{ error.message }}</h2>
    </b-notification>
    <nuxt-link
      to="/"
      class="button is-danger">
      Inicio
    </nuxt-link>
  </div>
</template>

<script>
export default {
  props: {
    error: {
      type: Object,
      default: null
    }
  },
  layout: 'empty'
}
</script>

<style scoped>
.container {
  font-family: sans-serif;
  padding-top: 10%;
  text-align: center;
}
h1 {
  font-size: 20px;
}
</style>
