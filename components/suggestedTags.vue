<template>
  <div id="suggested-tags">
    <ul>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=21'"
          class="__titulo"
        >
          <span>Ficção Cientifica</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=7'"
          class="__titulo"
        >
          <span>Fantasia</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=19'"
          class="__titulo"
        >
          <span>Romance</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=35'"
          class="__titulo"
        >
          <span>Xuanhuan</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=20'"
          class="__titulo"
        >
          <span>Vida Escolar</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=9'"
          class="__titulo"
        >
          <span>Hárem</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=26'"
          class="__titulo"
        >
          <span>Shounen</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=4'"
          class="__titulo"
        >
          <span>Comédia</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=31'"
          class="__titulo"
        >
          <span>Sobrenatural</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=13'"
          class="__titulo"
        >
          <span>Lolicon</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=36'"
          class="__titulo"
        >
          <span>Yaoi</span>
        </nuxt-link>
      </li>
      <li class="column is-3">
        <nuxt-link
          :to="'/series?genre=37'"
          class="__titulo"
        >
          <span>Yuri</span>
        </nuxt-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
@import "@/assets/sass/layout/_grid.scss";
@import "@/assets/sass/helpers/_variables.scss";
#suggested-tags {
  margin-bottom: 48px;
  ul {
    @extend %row;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: stretch;
    li {
      flex: 1;
      margin: 0px;
      padding: 0px;
      a {
        display: flex;
        justify-content: center;
        margin-bottom: 16px;
        margin-right: 14px;
        margin-left: 14px;
        font-size: 18px;
        color: #000;
        border-radius: 4px;
        background-color: #fff;
        min-width: 145px;
        @media (max-width: 768px) {
          margin-bottom: 8px;
          margin-right: 7px;
          margin-left: 7px;
          span {
            padding: 6px;
          }
        }
        @media (max-width: 400px) {
          margin-bottom: 6px;
          margin-right: 4px;
          margin-left: 4px;
          span {
            padding: 2px;
          }
        }
        span {
          display: block;
          padding: 12px;
          text-align: center;
        }
        &:hover {
          background-color: $primary;
          color: #fff;
        }
      }
    }
  }
}
</style>
