<template>
  <div id="quote-review">
    <a
      class="quote"
      href="/series/against-the-gods"
      title="Frase de Yun Che"
    >
      <blockquote cite="http://developer.mozilla.org">
        <p>Você esta cortejando a morte!</p>
      </blockquote>
      <span>-- Yun Che (Against the Gods)</span>
      <svg-filler
        class="quotation-left"
        path="images/quotation-left-mark.svg"
        fill="#e3e3e5"
        width="50px"
        height="50px"
      />
      <svg-filler
        class="quotation-right"
        path="images/quotation-right-mark.svg"
        fill="#e3e3e5"
        width="50px"
        height="50px"
      />
    </a>
    <div class="review-action">
      <a
        href="#"
        class="button is-primary"
        title="Sign In"
      >Entrar</a>
    </div>
  </div>
</template>

<script>
import SvgFiller from 'vue-svg-filler'
export default {
  components: {
    SvgFiller
  }
}
</script>


<style lang="scss" scoped>
@import "@/assets/sass/layout/_grid.scss";
@import "@/assets/sass/helpers/_variables.scss";
#quote-review {
  display: flex;
  flex-direction: column;
  @extend %row;
  @extend %justify-center;
  @extend %vertical-align-middle;
  width: 100%;
  padding: 0 12px;
  padding-top: 72px;
  margin-bottom: 56px;
  a.quote {
    display: flex;
    flex-direction: column;
    @extend %justify-center;
    text-align: center;
    color: #000;
    font-style: italic;
    font-weight: 400;
    margin-bottom: 20px;
    position: relative;
    max-width: 800px;
    width: 100%;
    padding: 0 24px;
    blockquote {
      p {
        text-align: center;
        color: #000;
      }
    }
    span {
      font-weight: 300;
      color: #83848f;
    }
    &:hover {
      text-decoration: underline;
    }
    .quotation-left,
    .quotation-right {
      position: absolute;
      top: 0px;
      height: 20px;
      width: 20px;
    }
    .quotation-left {
      left: 0;
    }
    .quotation-right {
      right: 0;
    }
  }
  .review-action {
    display: flex;
    flex-direction: row;
    @extend %justify-center;
    a {
      height: 48px;
      padding: 12px 42px;
      font-size: 14px;
      text-transform: uppercase;
      font-weight: 400;
    }
  }
}
</style>
