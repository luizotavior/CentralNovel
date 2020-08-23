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
            src="images/slides/slide_01.jpg"
            alt=""
          >
        </div>

        <div class="slide">
          <img
            src="images/slides/slide_02.png"
            alt=""
          >
        </div>
      </agile>
    </no-ssr>
  </main>
</template>
