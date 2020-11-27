<template>
  <div id="page-perfil">
    <div class="md-card is-flex-column">
      <div class="__header is-borded">
        <div class="__title">

          <h1 class="is-size-6 has-text-weight-medium">
            Perfil do Usuário
          </h1>
        </div>
        <p class="is-size-7">Bla bla bla bla</p>
      </div>
      <div class="__body margin-md-t">
        <div id="change-avatar">
          <avatar
            :size="118"
            src="https://i.pravatar.cc/118"
          />
        </div>
        <div id="change">
          <div id="change-profile">
            <h1 class="is-size-6 has-text-weight-medium">
              Informação básica
            </h1>
            <form>
              <b-field
                expanded
                label="Nome"
              >
                <b-input
                  type="text"
                  placeholder="Nome"
                />
              </b-field>
              <b-field
                expanded
                label="Data de Nasc."
              >
                <b-input
                  type="text"
                  placeholder="Data"
                />
              </b-field>
              <b-field
                expanded
                label="CPF"
              >
                <b-input
                  type="text"
                  placeholder="CPF"
                />
              </b-field>
              <b-field
                expanded
                label="RG"
              >
                <b-input
                  type="text"
                  placeholder="RG"
                />
              </b-field>

              <b-field
                expanded
                label="Telefone"
              >
                <b-input
                  type="text"
                  placeholder="Telefone"
                />
              </b-field>

              <div class="is-flex-left">
                <b-button
                  type="is-info"
                  expanded
                >Salvar</b-button>
              </div>
            </form>
          </div>
          <div id="change-password">
            <h1 class="is-size-6 has-text-weight-medium">
              Mudar senha
            </h1>
            <form>
              <b-field expanded>
                <b-input
                  type="password"
                  placeholder="Senha Antiga"
                  password-reveal
                />
              </b-field>
              <b-field expanded>
                <b-input
                  type="password"
                  placeholder="Confirmar Nova Senha"
                  password-reveal
                />
              </b-field>
              <b-field expanded>
                <b-input
                  type="password"
                  placeholder="Senha Antiga"
                  password-reveal
                />
              </b-field>
              <div
                class="is-flex-left "
                expanded
              >
                <b-button
                  type="is-info"
                  expanded
                >Salvar</b-button>
              </div>
            </form>
          </div>
        </div>

      </div>

    </div>
    <div
      id="signature"
      class="md-card is-flex-column"
    >
      <div class="__header is-borded">
        <div class="__title">

          <h1 class="is-size-6 has-text-grey-darker has-text-weight-medium">
            Notificações
          </h1>

        </div>

      </div>
      <div class="__body margin-md-t">
        <h1 class="is-size-6 has-text-weight-medium ">
          Assinaturas
        </h1>
        <p class="is-size-7">Ao assinar nossa newsletter por e-mail, você optará por receber atualizações sobre lançamentos de novos recursos, descontos e códigos promocionais, atualizações de segurança e muito mais.</p>
        <p class="is-size-7">Se você não estiver interessado em receber este conteúdo, desmarque a caixa abaixo para cancelar a inscrição.</p>
        <div class="field margin-md-t">
          <b-checkbox
            :value="true"
            type="is-info"
          >
            Inscrever-se para newsletters
          </b-checkbox>
        </div>
      </div>

    </div>
  </div>

</template>

<script>
import avatar from 'vue-avatar';
export default {
  layout: "dashboard",
  middleware: ["authenticated"],
  components: { avatar }
};
</script>
<style lang="scss" scoped>
@import "@/assets/sass/main.scss";

div.md-container {
  @extend %justify-between;
  div.__left {
    @include col(3);
    max-width: 280px;
  }
  div.__right {
    @include col(9);
  }
}
#page-perfil {
  margin-top: 40px;
  .__header {
    p {
      color: #707683;
    }
    .__title {
      h1 {
        color: #334d6e;
      }
    }
  }
  #change-avatar {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  #change {
    display: flex;
    flex-direction: row;
    width: 100%;
    padding-top: 50px;
    h1 {
      color: #192a3e;
      font-weight: 500;
      line-height: 22px;
      letter-spacing: 0.01em;
      padding-bottom: 30px;
    }

    #change-profile {
      width: 50%;
      padding-right: 30px;
    }
    #change-password {
      padding-left: 30px;
      border-left: 1px solid #ebeff2;
      width: 50%;
    }
  }
}
</style>

<style lang="scss" >
#page-perfil {
  #change {
    #change-profile,
    #change-password {
      form {
        .field {
          label {
            font-weight: 500;
            font-size: 11px;
            line-height: 16px;
            letter-spacing: 0.01em;
            color: #818e9b;
          }

          input {
            border: none;
            border-bottom: 1px solid #ebeff2;
            font-weight: normal;
            font-size: 13px;
            line-height: 19px;
            letter-spacing: 0.01em;
            color: #323c47;

            &:focus {
              border: none;
              box-shadow: none;
              border-bottom: 1px solid #818e9b;
            }
            &:hover {
              border: none;
              border-bottom: 1px solid #818e9b;
            }
          }
        }
      }
    }
  }
  #signature {
    .__body {
      h1 {
        padding-bottom: 20px;
      }
    }
  }
}
</style>
