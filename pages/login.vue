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
      <form @submit.prevent>
        <b-field grouped>
          <b-field
            expanded
            label="Endereço de email"
          >
            <b-input
              v-model="user.email"
              type="email"
              placeholder="E-mail"
              @keyup.native.enter="login()"
            />
          </b-field>
        </b-field>
        <b-field grouped>
          <b-field
            expanded
            label="Senha"
          >
            <b-input
              v-model="user.password"
              type="password"
              password-reveal
              placeholder="Password"
              @keyup.native.enter="login()"
            />
          </b-field>
        </b-field>
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
              @click="login()"
            >Entrar</b-button>
          </b-field>
        </b-field>
        <!-- <b-field grouped>
          <b-field expanded>
            <a
              class="button-default"
              href="#">
              <span>Log in with Google</span>
              <img
                class="google-svg"
                src="google.svg">
            </a>
          </b-field>
        </b-field> -->
      </form>
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
          .catch(error => {
            if (error.response.data.error == "invalid_credentials") {
              this.$buefy.toast.open({
                duration: 5000,
                message: "Email e/ou Senha incorretos",
                type: "is-danger"
              });
            } else {
              this.$buefy.toast.open({
                duration: 5000,
                message: "Erro ao Autenticar",
                type: "is-danger"
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
