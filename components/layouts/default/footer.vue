<template>
  <footer>
    <div class="columns">
      <div class="column is-4 column-first">
        <a
          href="#"
          title="Central Novel"
        ><img
            src="/images/logo/logo-quadrada.png"
            alt="Logo Central Novel"
          ></a>
        <div>
          <p class="social">
            <a
              href="https://www.facebook.com/centralnovel"
              title="Facebook"
            >
              <b-icon icon="facebook" /></a>
            <a
              href="#"
              title="Instagram"
            >
              <b-icon icon="instagram" /></a>
            <a
              href="https://discord.gg/qCjSsdX"
              title="Discord"
            >
              <b-icon icon="discord" /></a>
          </p>
          <p class="cn-marca">© 2015-2019 Central Novel</p>
        </div>
      </div>
      <div class="column is-3  is-hidden-mobile">
        <h4>Contatos</h4>
        <p>
          <a
            href="#"
            title="Tradutores e Editores"
          >Tradutores e Editores</a>
          <a
            href="#"
            title="Link Teste"
          >Link Teste</a>
          <a
            href="#"
            title="Ajuda e Serviço"
          >Ajuda e Serviço</a>
        </p>
      </div>
      <div class="column is-3 is-hidden-mobile">
        <h4>Recursos</h4>
        <p>
          <a
            href="#"
            title="Baixar aplicativo"
          >Baixar aplicativo</a>
          <a
            href="#"
            title="Seja um autor"
          >Seja um autor</a>
          <a
            href="#"
            title="Central de Ajuda"
          >Central de Ajuda</a>
          <a
            href="#"
            title="Política de Privacidade"
          >Política de Privacidade</a>
          <a
            href="#"
            title="Termos de Serviço"
          >Termos de Serviço</a>
        </p>
      </div>
      <div class="column is-2 is-hidden-mobile">
        <h4>Referências</h4>
        <p>
          <a
            href="https://www.webnovel.com/"
            target="_blank"
            title="WebNovel"
          >WebNovel</a>
          <a
            href="https://www.novelupdates.com/"
            target="_blank"
            title="NovelUpdates"
          >NovelUpdates</a>
          <a
            href="http://novels.com.br/"
            target="_blank"
            title="Palácio do Dao"
          >Palácio do Dao</a>
          <a
            href="https://luizotavior.com.br/"
            target="_blank"
            title="Luiz Otávio Rodrigues"
          >Luiz Otávio Rodrigues</a>
        </p>
      </div>
    </div>
  </footer>
</template>

<style lang="scss" scoped>
@import "@/assets/sass/layout/_grid.scss";
@import "@/assets/sass/helpers/_variables.scss";
footer {
  padding: 64px 0 36px;
  background-color: #25253d;
  width: 100%;
  .columns {
    max-width: 1008px;
    margin: 0 auto;
    min-height: 192px;
    .column {
      display: flex;
      flex-direction: column;
      height: auto;
      &.column-first {
        justify-content: space-between;
        img {
          height: 100px;
        }
        @media (max-width: 768px) {
          align-content: center;
          text-align: center;
          .social {
            justify-content: center;
          }
          img {
            height: 80px;
          }
        }
      }
      h4 {
        color: white;
        margin-bottom: 24px;
        font-size: 16px;
        text-transform: uppercase;
      }
      p {
        display: flex;
        flex-direction: column;
        color: rgba(255, 255, 255, 0.5);
        font-size: 14px;
        a {
          color: rgba(255, 255, 255, 0.5);
          &:hover {
            color: $primary;
          }
          & + a {
            margin-top: 12px;
          }
        }
        &.social {
          flex-direction: row;
          margin: 0;
          margin-bottom: 12px;
          a {
            margin-right: 16px;
            & + a {
              margin-top: 0px;
            }
          }
        }
      }

      @media (min-width: 769px) and (max-width: 1215px) {
        margin: 0 auto;
      }
    }
  }
}
</style>
