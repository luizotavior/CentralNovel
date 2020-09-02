<template>
  <main>
    <no-ssr>
      <agile
        :autoplay="true"
        :autoplaySpeed="6000"
        :arrows="false"
        :dots="false"
        :infinite="true"
      >
        <div class="slide">
          <img
            src="images/slides/slide_01.png"
            alt=""
          >
        </div>

        <div class="slide">

          <a href="/series/against-the-gods">
            <img
              src="images/slides/slide_02.png"
              alt=""
            >
          </a>
        </div>
        <div class="slide">
          <a
            href="https://www.amazon.com.br/s?k=novel+jbc+newpop&__mk_pt_BR=%C3%85M%C3%85%C5%BD%C3%95%C3%91&ref=nb_sb_noss"
            target="_blank"
            rel="noopener noreferrer"
          >
            <img
              src="images/slides/slide_03.png"
              alt=""
            >
          </a>
        </div>
        <div class="slide">
          <img
            src="images/slides/slide_04.png"
            alt=""
          >
        </div>
        <div class="slide">
          <a
            href="http://novels.com.br/dicas-de-leitura/as-10-novels-mais-indicadas-para-entrar-no-mundo-do-cultivo/"
            target="_blank"
            rel="noopener noreferrer"
          >
            <img
              src="images/slides/slide_05.png"
              alt=""
            >
          </a>
        </div>
      </agile>
    </no-ssr>
  </main>
</template>
