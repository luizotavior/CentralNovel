<template>
  <div class="__review-item">
    <div class="header">
      <div class="__left">
        <figure class="">
          <p class="image">
            <b-skeleton
              circle
              width="38px"
              height="38px"
            />
          </p>
        </figure>
      </div>
      <div class="__right">
        <b-skeleton width="80px" />
        <b-skeleton width="100px" />
      </div>
    </div>
    <div class="content-item">
      <p>
        <b-skeleton height="80px"></b-skeleton>
      </p>
    </div>
    <div class="footer-item">
      <div class="__left">
        <b-skeleton width="70px" />
      </div>
      <div class="__right">
        <span class="icon is-small">
          <b-skeleton></b-skeleton>
        </span>
        <span class="icon is-small">
          <b-skeleton></b-skeleton>
        </span>
        <span class="icon is-small">
          <b-skeleton></b-skeleton>
        </span>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: "ReviewItemSkeleton",
  components: {
  },
  data () {
    return {
      skeleton: true,
    }
  },
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
.__review-item {
  display: flex;
  flex-direction: column;
  padding-top: 16px;
  padding-bottom: 16px;
  position: relative;
  .header {
    display: flex;
    flex-direction: row;
    margin-bottom: 12px;
    .__left {
      display: flex;
      flex-direction: row;
      padding-right: 12px;
      @extend %justify-center;
      @extend %vertical-align-middle;
    }
    .__right {
      display: flex;
      flex-direction: column;
      @extend %justify-center;
      span.username {
        color: #000;
        font-weight: 600;
      }
    }
  }
  .content-item {
    width: 100%;
    padding-left: 48px;
    color: rgba(18, 18, 23, 0.6);
  }
  .footer-item {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    @extend %justify-between;
    padding-left: 48px;
    padding-top: 12px;
    padding-bottom: 12px;
    div.__left {
      font-size: 14px;
    }
    div.__right {
      .action {
        cursor: pointer;
        margin-left: 16px;
        &.active,
        &:hover {
          color: $primary;
        }
      }
    }
  }
  .reply-action {
    display: flex;
    flex-direction: row;
    padding-left: 48px;
    .action {
      cursor: pointer;
      color: $primary;
      text-transform: uppercase;
      font-size: 14px;
      &.active,
      &:hover {
        text-decoration: underline;
      }
    }
  }
}
</style>
