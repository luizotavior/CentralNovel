<template>
  <div id="page-novels">
    <div class="section-filter">
      <div>
        <span>Gênero</span>
        <div>
          <ul>
            <li>
              <a href="#">All</a>
            </li>
            <li>
              <a href="#">Reino Magico</a>
            </li>
            <li>
              <a href="#">Fantasia</a>
            </li>
            <li>
              <a href="#">Romance</a>
            </li>
          </ul>
        </div>
      </div>
      <div>
        <div>
          <span>Tipo</span>
          <div>
            <ul>
              <li>
                <a href="#">All</a>
              </li>
              <li>
                <a href="#">Reino Magico</a>
              </li>
              <li>
                <a href="#">Fantasia</a>
              </li>
              <li>
                <a href="#">Romance</a>
              </li>
            </ul>
          </div>
        </div>
        <div>
          <span>Status</span>
          <div>
            <ul>
              <li>
                <a href="#">All</a>
              </li>
              <li>
                <a href="#">Reino Magico</a>
              </li>
              <li>
                <a href="#">Fantasia</a>
              </li>
              <li>
                <a href="#">Romance</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div>
        <span>Lingua Estrangeira</span>
        <div>
          <ul>
            <li>
              <a href="#">All</a>
            </li>
            <li>
              <a href="#">Inglês</a>
            </li>
            <li>
              <a href="#">Japonês</a>
            </li>
            <li>
              <a href="#">Chines</a>
            </li>
            <li>
              <a href="#">Coreano</a>
            </li>
          </ul>
        </div>
      </div>
      <div>
        <span>Ordenar por</span>
        <div>
          <ul>
            <li>
              <a href="#">All</a>
            </li>
            <li>
              <a href="#">Reino Magico</a>
            </li>
            <li>
              <a href="#">Fantasia</a>
            </li>
            <li>
              <a href="#">Romance</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Novels",
  components: {},
  data() {
    return {};
  }
};
</script>

<style lang="scss">
@import "@/assets/sass/main.scss";
#page-novels {
  min-height: 800px;
  .section-filter {
    min-height: 400px;
    background-color: #f5f6fc;
    border-bottom: 1px solid #dcdce2;
  }
}
</style>
