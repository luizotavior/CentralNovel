<template>
  <div id="login">
    <div class="auth-box">
      <div class="title">
        <div class="logo">
          <img src="/images/logos/logo.png" />
        </div>
        <span>Não possui uma conta?
          <nuxt-link :to="'/register'">Inscreva-se</nuxt-link></span>
      </div>

      <ValidationObserver
        ref="observer"
        v-slot="{ handleSubmit }"
        tag="form"
      >
        <b-message
          v-for="(error, index) in errors"
          :key="index"
          type="is-primary"
        >
          {{error}}
        </b-message>
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
              password-reveal
              type="password"
              @keyup.native.enter="handleSubmit(login)"
            />
          </b-field>
        </ValidationProvider>
        <b-field>
          <p class="control __sublink">
            <span>
              <nuxt-link :to="'/forgot_password'">Esqueci minha senha</nuxt-link>
            </span>
          </p>
        </b-field>
        <b-field grouped>
          <b-field expanded>
            <b-button
              class="is-fullwidth"
              type="is-primary"
              @click="handleSubmit(login)"
            >Entrar</b-button>
          </b-field>
        </b-field>
      </ValidationObserver>
      <footer class="copyright">
        <span>©2020 Central Novel. Todos os direitos reservados.</span>
        <span><a href="#">Política de Privacidade</a></span>
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
      title: "Login - Central Novel",
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
      errors: [],
      user: {
        email: "",
        password: ""
      }
    };
  },
  methods: {
    async login () {
      try {
        this.$buefy.toast.open({
          duration: 1000,
          message: "Logging in..."
        });
        var data = {
          client_id: this.$env.AUTH_CLIENT_ID,
          client_secret: this.$env.AUTH_CLIENT_SECRET,
          grant_type: this.$env.AUTH_GRANT_TYPE,
          scope: this.$env.AUTH_SCOPE,
          username: this.user.email,
          password: this.user.password
        };
        //Problema no meu Response, ele ta entrando mesmo qndo AJAX retorna 401 !
        await this.$auth
          .login({ data: data })
          .then(response => {
            this.$buefy.toast.open({
              message: "Successfully Logged In",
              type: "is-success"
            });
            this.$router.push("/");
          })
          .catch(e => {
            if (e.response.status === 400) {
              this.errors = ["Email e/ou Senha Incorretos"]
            } else {
              this.$buefy.toast.open({
                message: "[" + response.status + "] Ocorreu um Erro Inesperado."
              });
            }
          });
      } catch (e) {
        this.$buefy.toast.open({
          duration: 5000,
          message: "Erro ao Autenticar",
          type: "is-danger"
        });
      }
    }
  }
};
</script>
