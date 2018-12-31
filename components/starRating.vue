<template>
    <div class="star-rating">
        <div class="stars">
            <b-icon v-for="n in maxRating" :key="n" size="is-small" :icon="(formattedRating >= n ? 'star' : (Math.ceil(formattedRating) == n ? 'star-half' : 'star-outline' ))"/>
        </div>
        <span class="rating">{{ formattedRating }}</span>
    </div>
</template>

<script>
export default {
    name: 'BTableColumn',
    props: {
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
        formattedRating() {
            return (parseFloat(this.currentRating * 100) / 100).toFixed(1);
        },
    },
}
</script>

<style lang="scss" scoped>
    @import "@/assets/sass/layout/_grid.scss";
    @import '@/assets/sass/helpers/_variables.scss';
    .star-rating{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        .stars{
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            @extend %justify-between;
            @extend %vertical-align-middle;
            color: #ff8d29;
        }
        .rating{
            margin-left: 4px;
        }
    }
</style>
