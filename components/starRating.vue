<template>
  <div class="star-rating">
    <div class="stars">
      <b-icon
        v-for="n in maxRating"
        :key="n"
        :size="size"
        :icon="(formattedRating >= n ? 'star' : (Math.ceil(formattedRating) == n ? 'star-half' : 'star-outline' ))"
      />
    </div>
    <div
      class="__texts"
      v-show="!onlyStar"
    >
      <span :class="size">{{ formattedRating }}</span>
      <span
        :class="size"
        v-if="currentVotes != null"
      >({{currentVotes}} Avaliações)</span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BTableColumn',
  props: {

    onlyStar: {
      type: Boolean,
      default: false
    },
    size: {
      type: String,
      default: "is-small"
    },
    currentVotes: {
      type: Number,
      default: null
    },
    currentRating: {
      type: Number,
      default: 0
    },
    maxRating: {
      type: Number,
      default: 5
    },
  },
  computed: {
    formattedRating () {
      return (parseFloat(this.currentRating * 100) / 100).toFixed(1);
    },
  },
}
</script>

<style lang="scss" scoped>
@import "@/assets/sass/layout/_grid.scss";
@import "@/assets/sass/helpers/_variables.scss";
.star-rating {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  .stars {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    @extend %justify-between;
    @extend %vertical-align-middle;
    color: #ff8d29;
  }
  .__texts {
    margin-left: 3px;
    .is-small {
      font-size: 16px;
    }
    .is-medium {
      font-size: 20px;
    }
  }
}
</style>
