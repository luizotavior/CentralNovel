<template>
  <div id="register">
    <div class="__left">
      <span style="display: none;">Background By Jjnaas (https://www.deviantart.com/jjnaas)</span>
      <div class="title">
        <div class="logo">
          <!-- <img src="/images/logos/logo.png" /> -->
        </div>
        <span> </span>
      </div>
    </div>
    <div class="__right">
      <div class="__header">
        <div class="logo">
          <img src="/images/logos/logo.png" />
        </div>
        <span>Tem uma conta? <nuxt-link :to="'/login'">Entrar</nuxt-link></span>
      </div>
      <div class="__steps">
        <b-steps
          v-model="activeStep"
          :has-navigation="false"
          :clickable="false"
          size="is-small"
        >
          <b-step-item
            step="1"
            :clickable="false"
          />
          <b-step-item
            step="2"
            :clickable="false"
          />
          <b-step-item
            step="3"
            :clickable="false"
          />
          <b-step-item
            step="4"
            :clickable="false"
          />
          <b-step-item
            step="5"
            :clickable="false"
          />
        </b-steps>
      </div>
      <ValidationObserver
        ref="observer"
        v-slot="{ handleSubmit }"
        tag="form"
      >
        <div class="form-title">
          <h1></h1>
          <span></span>
        </div>
        <b-message
          v-for="(error, index) in errors"
          :key="index"
          type="is-primary"
        >
          {{error[0]}}
        </b-message>
        <ValidationProvider
          rules="required|min:3"
          name="Nome"
          v-slot="{ errors, valid }"
        >
          <b-field
            label="Nome Completo"
            :type="{ 'is-danger': errors[0], 'is-success': valid }"
            :message="errors"
          >
            <b-input
              v-model="user.name"
              type="text"
            />
          </b-field>
        </ValidationProvider>
        <ValidationProvider
          rules="required|min:5"
          name="Usuário"
          v-slot="{ errors, valid }"
        >
          <b-field
            label="Username"
            :type="{ 'is-danger': errors[0], 'is-success': valid }"
            :message="errors"
          >
            <b-input
              v-model="user.username"
              type="text"
            />
          </b-field>
        </ValidationProvider>
        <ValidationProvider
          rules="required|email"
          name="Email"
          v-slot="{ errors, valid }"
        >
          <b-field
            label="Endereço de E-mail"
            :type="{ 'is-danger': errors[0], 'is-success': valid }"
            :message="errors"
          >
            <b-input
              v-model="user.email"
              type="email"
            />
          </b-field>
        </ValidationProvider>
        <ValidationProvider
          rules="required|min:6"
          name="Senha"
          v-slot="{ errors, valid }"
        >
          <b-field
            label="Senha"
            :type="{ 'is-danger': errors[0], 'is-success': valid }"
            :message="errors"
          >
            <b-input
              v-model="user.password"
              type="password"
              @keyup.native.enter="handleSubmit(register)"
            />
          </b-field>
        </ValidationProvider>
        <recaptcha
          @error="onError"
          @success="onSuccess"
          @expired="onExpired"
        />
        <b-field grouped>
          <b-field expanded>
            <b-button
              class="is-fullwidth"
              type="is-primary"
              @click="handleSubmit(register)"
            >Criar Conta</b-button>
          </b-field>
        </b-field>
      </ValidationObserver>
      <footer class="copyright">
        <span class="text">Ao criar uma conta na Central Novel, você concorda em aceitar os
          termos de serviço.</span>
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
  middleware: ['notAuthenticated'],
  head () {
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
  data () {
    return {
      gmail: "",
      activeStep: 0,
      user: {
        name: "",
        email: "",
        username: "",
        password: "",
        confirm_password: "",
        cellphone: "",
        application: "cloud",
        recaptcha: "",
        sex: "S"
      },
      errors: {},
    };
  },
  methods: {
    async register () {
      this.$buefy.toast.open({
        duration: 1000,
        message: "Registrando ..."
      });
      await this.getRecaptcha();
      await this.createUser();
    },
    async getRecaptcha () {
      try {
        this.user.recaptcha = await this.$recaptcha.getResponse();
        console.log("ReCaptcha token:", token);
        await this.$recaptcha.reset();
      } catch (e) {
      }
    },
    async createUser () {
      this.$axios
        .post("users", this.user)
        .then(response => {

          this.$buefy.toast.open({
            message: response.status
          });
          this.login();
        })
        .catch(e => {
          if (e.response.status === 400) {
            this.errors = e.response.data
          } else {
            this.$buefy.toast.open({
              message: "[" + response.status + "] Ocorreu um Erro Inesperado."
            });
          }
        });
    },
    async login () {
      var data = {
        client_id: this.$env.AUTH_CLIENT_ID,
        client_secret: this.$env.AUTH_CLIENT_SECRET,
        grant_type: this.$env.AUTH_GRANT_TYPE,
        scope: this.$env.AUTH_SCOPE,
        email: this.user.email,
        password: this.user.password
      };
      await this.$auth
        .login({ data: data })
        .then(response => {
          this.$router.push("/");
        })
        .catch(error => { });
    },

    onError (error) {
      console.log("Error happened:", error);
    },
    onSuccess (token) {
      console.log("Succeeded:", token);
      // here you submit the form
    },
    onExpired () {
      console.log("Expired");
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
    display: flex;
    flex-direction: column;
    @extend %vertical-align-middle;
    background-image: url("/images/register-background.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
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
          width: 150px;
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
    @extend %justify-center;
    div.__header {
      margin-top: 12px;
      margin-bottom: 12px;
      text-align: center;
      span {
        font-size: 14px;
        text-align: center;
        font-weight: 400;
      }
      img {
        width: 130px;
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
      max-width: 360px;
      width: 100%;
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
