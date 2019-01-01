<template>
  <div id="page-home">
    <quote-review/>
    <list-novel title="Power Ranking" seeMore="#"/>
    <list-novel title="Popular" seeMore="#"/>
    <list-novel title="Tendências de Histórias Originais" seeMore="#"/>
    <list-novel title="Novos na Central Novel" seeMore="#"/>
    <suggested-tags/>
    <feed-table/>
  </div>
</template>

<script>
import suggestedTags from '@/components/suggestedTags.vue';
import feedTable from '@/components/feedTable.vue';
import listNovel from '@/components/listNovel.vue';
import quoteReview from '@/components/quoteReview.vue';

export default {
  name: 'Home',
  components: {
    suggestedTags,
    feedTable,
    listNovel,
    quoteReview
  },
  data() {
    return {
    }
  }
}
</script>

<style lang="scss">
  @import "@/assets/sass/layout/_grid.scss";
  @import '@/assets/sass/helpers/_variables.scss';
  #page-home{
    position: relative;
    margin: 0 auto;
    margin-top: -5.3%;
    @extend %row;
    width: 100%;
    z-index: 1;
    min-height: 600px;
    display: flex;
    flex-direction: column;
    padding-top: 24px;
    &:before {
      position: absolute;
      z-index: -1;
      width: 1200px;
      height: 380px;
      top: 0px;
      content: '';
      border-radius: 8px 8px 0 0;
      background: linear-gradient(to bottom,#fff,#f5f6fc);
    }
  }
</style>
