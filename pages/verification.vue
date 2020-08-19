<template>
  <div id="register">
    <div class="__left">
      <span style="display: none;">Background By Rodmendez (https://www.deviantart.com/rodmendez/)</span>
      <div class="title">
        <div class="logo">
          <!-- <img src="/images/logos/logo.png" /> -->
        </div>
        <span> </span>
      </div>
    </div>
    <div class="__right">
      <b-loading
        :is-full-page="false"
        :active="verify.signature != null && isLoading"
        :can-cancel="false"
      />
      <div class="__header">
        <div class="logo">
          <img src="/images/logos/logo.png" />
        </div>
        <span>Deseja sair? <a
            href="#"
            @click="$auth.logout()"
          >Logout</a></span>
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
      <form @submit.prevent>
        <div class="form-title">
          <h1></h1>
          <span></span>

        </div>
        <b-message
          v-if="verify.error"
          type="is-primary"
        >
          O Link utilizado não é valido.
        </b-message>
        <b-field grouped>
          <b-field expanded>
            <b-button
              class="is-fullwidth"
              type="is-primary"
              :disabled="disableResend"
              v-if="!verify.verified"
              @click="resend()"
            >Reenviar e-mail de Validação</b-button>
            <a
              class="button is-fullwidth is-primary"
              v-if="verify.verified"
              href="/"
            >Voltar para o Inicio</a>
          </b-field>
        </b-field>
      </form>
      <footer class="copyright">
        <span
          class="text"
          v-if="disableResend && !verify.verified"
        >Você pode solicitar novamente em: {{ timeResend.minutes }}:{{timeResend.seconds}}</span>
        <span
          class="text"
          v-if="!disableResend && !verify.verified"
        >Você já pode solicitar um novo e-mail de validação.</span>
        <span
          class="text"
          v-if="verify.verified"
        >Você já foi verificado.</span>
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
      timeResend: {
        minutes: 1,
        seconds: 0,
      },
      disableResend: false,
      isLoading: true,
      activeStep: 4,
      intervalo: null,
      verify: {
        email: null,
        expires: null,
        signature: null,
        verified: false
      }
    };
  },
  mounted () {
    this.getQuery()
    this.verification()
  },
  methods: {
    timeoutResend () {
      const self = this
      this.intervalo = setInterval(function () {
        if (self.timeResend.seconds == 0) {
          self.timeResend.seconds = 59
          if (self.timeResend.minutes == 0) {
            self.timeResend.miute = 0
            self.timeResend.seconds = 0
            self.disableResend = false;
            clearInterval(intervalo);
          } else {
            self.timeResend.minutes--
          }
        } else {
          self.timeResend.seconds--
        }
      }, 1000);
    },
    resend () {
      this.$axios
        .get("user/verify/resend")
        .then(response => {
          if (response.status === 200) {
            this.$buefy.toast.open({
              message: "E-mail Enviado!!",
              type: "is-success"
            });
          }
        })
        .catch(e => {
          this.$buefy.toast.open({
            message: "Ocorreu um erro no envio, tente novamente.",
            type: "is-danger"
          });
        });

      this.disableResend = true;
      this.timeoutResend()
    },
    async getQuery () {
      this.verify.email = this.$route.query.email ? this.$route.query.email : null
      this.verify.expires = this.$route.query.expires ? this.$route.query.expires : null
      this.verify.signature = this.$route.query.signature ? this.$route.query.signature : null
    },
    async verification () {
      if (this.verify.email &&
        this.verify.expires &&
        this.verify.signature) {
        try {
          await this.$axios
            .get("user/verify?" +
              "email=" + this.verify.email +
              "&expires=" + this.verify.expires +
              "&signature=" + this.verify.signature)
            .then(response => {
              if (response.status === 200) {
                this.$buefy.toast.open({
                  message: "Usuário Validado!!",
                  type: "is-success"
                })
                this.isLoading = false;
                this.verify.verified = true;
                this.$router.push("/");
              }
            })
            .catch(e => {
              this.isLoading = false;
              this.verify.error = true;
              console.log(e);
            });
        } catch (e) {
          console.log(e);
          this.$buefy.toast.open({
            duration: 5000,
            message: "Erro ao Validar",
            type: "is-danger"
          });
        }
      }
    },
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
    background-image: url("/images/verified-background.jpg");
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
    position: relative;
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
