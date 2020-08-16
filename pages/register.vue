<template>
  <div id="register">
    <div class="__left">
      <div class="title">
        <div class="logo">
          <img src="/images/logos/logo-white.png" />
        </div>
        <span> </span>
      </div>
    </div>
    <div class="__right">
      <div class="__header">
        <span
          >Tem uma conta? <nuxt-link :to="'/login'">Entrar</nuxt-link>.</span
        >
      </div>
      <div class="__steps">
        <b-steps :has-navigation="false" :clickable="false" size="is-small">
          <b-step-item />
          <b-step-item />
          <b-step-item />
          <b-step-item />
          <b-step-item />
        </b-steps>
      </div>
      <form @submit.prevent>
        <div class="form-title">
          <h1></h1>
          <span></span>
        </div>
        <b-field grouped>
          <b-field expanded label="Nome Completo">
            <b-input v-model="user.name" type="text" />
          </b-field>
        </b-field>
        <b-field grouped>
          <b-field expanded label="Endereço de email">
            <b-input
              v-model="user.email"
              type="email"
              @keyup.native.enter="login()"
            />
          </b-field>
        </b-field>
        <b-field grouped>
          <b-field expanded>
            <b-button
              class="is-fullwidth"
              type="is-primary"
              disabled
              @click="login()"
              >Criar Conta</b-button
            >
          </b-field>
        </b-field>
      </form>
      <footer class="copyright">
        <span class="text"
          >Ao criar uma conta na Central Novel, você concorda em aceitar os
          termos de serviço.</span
        >
        <hr />
        <span class="text">
          Estamos comprometidos com sua privacidade. A Central Novel usa as
          informações que você nos fornece para contatá-lo com relação aos
          nossos conteúdos, produtos e serviços relevantes. Você pode cancelar a
          assinatura dessas comunicações quando quiser. Para mais informações,
          confira nossa <a href="#">Política de privacidade</a>.
        </span>
        <span>©2020 Central Novel. Todos os direitos reservados.</span>
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  layout: "auth",
  middleware: ["notAuthenticated"],
  head() {
    return {
      title: "Register - Central Novel",
      meta: [
        {
          hid: "description",
          name: "description",
          content: "My custom description"
        }
      ]
    };
  },
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        confirm_password: "",
        cellphone: "",
        application: "cloud"
      }
    };
  },
  methods: {
    async register() {
      try {
        this.$buefy.toast.open({
          duration: 1000,
          message: "Registrando ..."
        });
        var data = {
          client_id: this.$env.AUTH_CLIENT_ID,
          client_secret: this.$env.AUTH_CLIENT_SECRET,
          grant_type: this.$env.AUTH_GRANT_TYPE,
          scope: this.$env.AUTH_SCOPE,
          name: this.user.name,
          email: this.user.email,
          password: this.user.password,
          confirm_password: this.user.confirm_password
        };
        await this.$axios
          .post("users", this.user)
          .then(response => {
            this.$buefy.toast.open({
              message: "User Created !",
              type: "is-success"
            });
          })
          .catch(e => {
            alert(e);
          });
        await this.$auth
          .login({ data: data })
          .then(response => {
            this.$router.push("/");
          })
          .catch(error => {});
      } catch (e) {
        this.$buefy.toast.open({
          duration: 5000,
          message: "Erro ao Registrar2",
          type: "is-danger"
        });
      }
    }
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/sass/main.scss";
div#register {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  min-height: 100vh;
  div.__left {
    max-width: 41.66667%;
    width: 100%;
    background-color: $primary;
    display: flex;
    flex-direction: column;
    @extend %vertical-align-middle;
    div.title {
      display: flex;
      flex-direction: column;
      padding: 85px 50px 50px;
      height: 100%;
      .logo {
        display: flex;
        flex-direction: row;
        @extend %justify-center;
        img {
          width: 96px;
          margin: 0px 0px 24px;
        }
      }
      span {
        font-size: 22px;
        color: #ffffff;
        text-align: center;
      }
    }
  }
  div.__right {
    display: flex;
    flex-direction: column;
    @extend %vertical-align-middle;
    max-width: 58.33333%;
    width: 100%;
    padding-left: 16px;
    padding-right: 16px;
    div.__header {
      margin-top: 12px;
      margin-bottom: 12px;
      span {
        font-size: 14px;
        text-align: center;
        font-weight: 300;
      }
    }
    .__steps {
      display: flex;
      flex-direction: row;
      width: 100%;
      @extend %justify-center;
      .b-steps {
        max-width: 200px;
        width: 100%;
      }
    }
    form {
      padding-left: 12px;
      padding-right: 12px;
      margin-left: auto;
      margin-right: auto;
      max-width: 440px;
      div.form-title {
        display: flex;
        flex-direction: column;
        h1 {
          font-size: 20px;
          text-align: center;
          font-weight: 600;
        }
        span {
          font-size: 14px;
          text-align: center;
          font-weight: 400;
        }
      }
    }
    footer.copyright {
      display: flex;
      flex-direction: column;
      padding: 0 40px 12px;
      margin-left: auto;
      margin-right: auto;
      max-width: 440px;
      hr {
        margin: 6px 0;
      }
      span {
        font-size: 12px;
        text-align: center;
        font-weight: 400;
      }
      span.text {
        margin: 12px 0;
      }
    }
  }
  @media (max-width: 768px) {
    div.__left {
      display: none;
    }
    div.__right {
      max-width: 100%;
    }
  }
}
</style>
