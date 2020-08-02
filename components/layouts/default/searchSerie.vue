<template>
  <div class="custom-serch">
    <b-autocomplete
      v-model="query"
      :data="data"
      :placeholder="label"
      :loading="isFetching"
      custom-class="navbar-search"
      icon="magnify"
      field="title"
      rounded
      @input="getAsyncData(query)"
      @select="toClient"
    >
      <template slot="empty">No results found</template>
    </b-autocomplete>
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: ""
    }
  },
  data () {
    return {
      query: "",
      selected: null,
      data: [],
      isFetching: false,
      digitedTypingTime: null,
    }
  },
  computed: {
  },
  methods: {
    getAsyncData (query) {
      clearTimeout(this.digitedTypingTime);
      this.digitedTypingTime = setTimeout(() => {
        if (query.length > 0) {
          this.data = []
          this.isFetching = true
          this.$axios.$get('/series/?paginate=false&q=' + this.query)
            .then(data => {
              //data.data.forEach((item) => this.data.push(item))
              this.data = data.data;
              this.isFetching = false
            })
            .catch(error => {
              this.isFetching = false
              throw error
            })
        }
      }, 500);
    },
    toClient (e) {
      this.selected = e
      if (e != null) {
        this.$router.push('/series/' + e.slug)
      }
    },
    toNew () {

    }
  },
};
</script>

<style lang="scss">
.custom-serch {
  width: 100%;
}
</style>
