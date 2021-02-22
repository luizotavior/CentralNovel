<template>
  <div id="register">
    <div class="__left">
      <span style="display: none;">Background By Koyorin (https://www.deviantart.com/koyorin)</span>
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
        <span>Ir para o <nuxt-link :to="'/login'">Login</nuxt-link></span>
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
        <b-field grouped>
          <b-field
            expanded
            label="Nova Senha"
          >
            <b-input
              v-model="user.password"
              type="password"
            />
          </b-field>
        </b-field>
        <ValidationProvider
          rules="required|min:6"
          name="Senha"
          v-slot="{ errors, valid }"
        >
          <b-field
            label="Nova Senha"
            :type="{ 'is-danger': errors[0], 'is-success': valid }"
            :message="errors"
          >
            <b-input
              v-model="user.password"
              type="password"
            />
          </b-field>
        </ValidationProvider>
        <ValidationProvider
          rules="required|min:6"
          name="Senha"
          v-slot="{ errors, valid }"
        >
          <b-field
            label="Nova Senha"
            :type="{ 'is-danger': errors[0], 'is-success': valid }"
            :message="errors"
          >
            <b-input
              v-model="user.password_confirmation"
              type="password"
              @keyup.native.enter="handleSubmit(resetPassword)"
            />
          </b-field>
        </ValidationProvider>
        <b-field grouped>
          <b-field expanded>
            <b-button
              class="is-fullwidth"
              type="is-primary"
              @click="handleSubmit(resetPassword)"
            >Alterar Senha</b-button>
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
  middleware: ["notAuthenticated"],
  head () {
    return {
      title: "Verified - Central Novel",
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
      activeStep: 4,
      errors: {},
      user: {
        email: "",
        password: null,
        password_confirmation: null
      },
      verify: {
        email: null,
        expires: null,
        signature: null,
        verified: false
      }
    };
  },
  mounted () {
    this.getQuery();
  },
  methods: {
    async resetPassword () {
      try {
        this.$buefy.toast.open({
          duration: 1000,
          message: "Validando ..."
        });
        this.$axios
          .post(
            "user/forgot?" +
            "email=" +
            this.verify.email +
            "&expires=" +
            this.verify.expires +
            "&signature=" +
            this.verify.signature,
            this.user
          )
          .then(response => {
            this.$buefy.toast.open({
              message: "Dados Alterados!",
              type: "is-success"
            });
            this.$router.push("/");
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
      } catch (e) {
        this.$buefy.toast.open({
          duration: 5000,
          message: "Ocorreu um Erro.",
          type: "is-danger"
        });
      }
    },

    async getQuery () {
      this.verify.email = this.$route.query.email
        ? this.$route.query.email
        : null;
      this.verify.expires = this.$route.query.expires
        ? this.$route.query.expires
        : null;
      this.verify.signature = this.$route.query.signature
        ? this.$route.query.signature
        : null;
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
    background-image: url("/images/reset-background.jpg");
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
