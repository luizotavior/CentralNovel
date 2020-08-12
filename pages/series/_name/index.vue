<template>
  <div id="page-novel">
    <div class="__header">
      <div class="__container">
        <breadcrumb />
        <pre>{{serie}}</pre>
      </div>
    </div>
    <div class="__body">
      <div class="__container">

      </div>
    </div>
  </div>
</template>

<script>
import breadcrumb from '@/components/breadcrumb.vue';
export default {
  components: {
    breadcrumb
  },
  data () {
    return {
      serie: {}
    }
  },
  mounted () {
    this.serieData()
  },
  methods: {
    serieData () {
      this.$axios.$get('/sersies?paginate=0&slug=' + this.$route.params.name).then(response => {
        console.log(response.data.length)
        if (response.data.length === 0) throw ({ statusCode: 404, message: 'Serie not found' })
        this.serie = response.data[0]
      }).catch(e => {
        return this.$nuxt.error(e)
      })
    }
  }
}
</script>

<style lang="scss">
@import "@/assets/sass/main.scss";
#page-novel {
  .__header,
  .__body {
    display: flex;
    flex-direction: row;
    @extend %justify-center;
    .__container {
      display: flex;
      flex-direction: column;
      @extend %row;
      width: 100%;
    }
  }
  .__header {
    min-height: 480px;
    border-bottom: 1px solid #dcdce2;
  }
  .__body {
    background-color: #fff;
    min-height: 480px;
  }
}
</style>
