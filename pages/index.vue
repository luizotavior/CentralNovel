<template>
  <div id="page-home">
    <default-slider />
    <div class="container-page-home">
      <quote-review />
      <!-- <topic-title title="Novos Lançamentos em Andamento"/>
      <list-novel :mode="2"/> -->
      <!-- <topic-title title="Recommended"/>
      <list-novel :mode="2"/> -->
      <!-- <topic-title title="Power Ranking" seeMore="#"/>
      <list-novel/> -->
      <topic-title title="Recomendado" />
      <list-novel
        :mode="2"
        :api="
          '/series?paginate=false&limit=9&sortProperty=created_at&sortDirection=desc'
        "
      />
      <topic-title title="Popular" seeMore="#" />
      <list-novel
        :api="
          '/series?paginate=false&limit=9&sortProperty=numVotes&sortDirection=desc'
        "
      />
      <topic-title title="Tendências de Histórias Originais" seeMore="#" />
      <list-novel
        :api="
          '/series?paginate=false&limit=9&language=1&sortProperty=averageRating&sortDirection=desc'
        "
      />
      <topic-title title="Novos na Central Novel" />
      <list-novel
        :api="
          '/series?paginate=false&limit=9&sortProperty=created_at&sortDirection=desc'
        "
      />
      <topic-title title="Gêneros Sugeridas" />
      <suggested-tags />
      <topic-title id="updates" title="Ultimas Atualizações" />
      <feed-table />
    </div>
  </div>
</template>

<script>
import defaultSlider from "@/components/layouts/default/slider";
import topicTitle from "@/components/topicTitle.vue";
import suggestedTags from "@/components/suggestedTags.vue";
import feedTable from "@/components/feedTable.vue";
import listNovel from "@/components/listNovel.vue";
import quoteReview from "@/components/quoteReview.vue";

export default {
  name: "Home",
  components: {
    defaultSlider,
    topicTitle,
    suggestedTags,
    feedTable,
    listNovel,
    quoteReview
  },
  data() {
    return {};
  }
};
</script>

<style lang="scss">
.slick-track {
  display: flex;
  align-items: stretch;
  justify-content: center;
  .slick-slide {
    height: auto;
  }
}
@import "@/assets/sass/main.scss";
#page-home {
  display: flex;
  flex-direction: column;
  background-color: #f5f6fc;
  .container-page-home {
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
      width: 100%;
      max-width: 1200px;
      height: 380px;
      top: 0px;
      content: "";
      border-radius: 8px 8px 0 0;
      background: linear-gradient(to bottom, #fff, #f5f6fc);
    }
  }
}
</style>
