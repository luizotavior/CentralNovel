<template>
  <div id="layout-auth">
    <nuxt />
  </div>
</template>


<script>
export default {
}
</script>
<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
#layout-auth {
  display: flex;
  flex-direction: column;
  width: 100%;
  width: 100%;
  background-color: #fff;
}
</style>

<style lang="scss">
@import "@/assets/sass/main.scss";
div#login {
  display: flex;
  flex-direction: row;
  @extend %justify-center;
  div.auth-box {
    display: flex;
    flex-direction: column;
    @extend %justify-between;
    min-height: 100vh;
    max-width: 425px;
    width: 100%;
    .title {
      display: flex;
      flex-direction: column;
      margin-top: 55px;
      .logo {
        display: flex;
        flex-direction: row;
        @extend %justify-center;
        margin-bottom: 12px;
        img {
          width: 185px;
        }
      }
      span {
        text-align: center;
        font-size: 14px;
        font-weight: 400;
      }
      h1 {
        text-align: center;
        font-size: 32px;
        font-weight: 600;
      }
    }
    form {
      padding: 12px;
    }
    .form-title {
      display: flex;
      flex-direction: column;
      margin-bottom: 32px;
      h1 {
        text-align: center;
        font-size: 32px;
        font-weight: 600;
      }
      span {
        text-align: center;
        font-size: 14px;
      }
    }
    .__sublink {
      span {
        font-size: 12px;
      }
    }
    .copyright {
      display: flex;
      flex-direction: column;
      padding: 50px 0 15px;
      span {
        font-size: 12px;
        text-align: center;
        font-weight: 400;
      }
    }
  }
}
</style>
