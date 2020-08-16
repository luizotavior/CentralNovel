<template>
  <div id="page-library">
    <div class="section-header">
      <div class="__container">
        <h2>Biblioteca</h2>
      </div>
    </div>
    <div class="section-series">
      <div class="__container">
        <ul class="list-series">
          <li
            v-for="(novel, index) in library"
            :key="index"
            style="margin-bottom: 2rem;"
            data-aos="slide-up"
            data-aos-offset="100"
            data-aos-easing="ease-out-back"
            data-aos-once="true"
          >
            <card-novel :novel="novel" :rating="true" />
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import cardNovel from "@/components/cardNovel.vue";

export default {
  name: "Novels",
  components: { cardNovel },
  data() {
    return {
      isFetching: true,
      library: []
    };
  },
  methods: {
    getLibrary() {
      this.busy = true;
      this.$axios
        .$get("user/library")
        .then(data => {
          this.library = data.data;
          this.busy = false;
        })
        .catch(error => {
          this.busy = false;
        });
    }
  },
  mounted() {
    this.getLibrary();
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#page-library {
  min-height: 800px;
  .section-header {
    background-color: #f5f6fc;
    border-bottom: 1px solid #dcdce2;
    display: flex;
    flex-direction: row;
    @extend %justify-center;
    .__container {
      display: flex;
      flex-direction: column;
      @extend %row;
      width: 100%;
      padding: 40px 0 60px;
      h2 {
        font-size: 40px;
        font-weight: 700;
        line-height: 1.5;
      }
    }
  }
  .section-series {
    display: flex;
    flex-direction: row;
    @extend %justify-center;
    .__container {
      display: flex;
      flex-direction: column;
      @extend %row;
      width: 100%;
      padding-top: 12px;
      padding-bottom: 32px;
      ul.list-series {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        margin-top: 38px;
        li {
          display: flex;
          flex-direction: column;
          @include col(2);
        }
      }
    }
  }
}
</style>
