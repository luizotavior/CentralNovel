<template>
  <div id="page-novel">
    <div class="__header">
      <div class="__container">
        <breadcrumb/>
      </div>
    </div>
    <div class="__body">
      <div class="__container">
        
      </div>
    </div>
  </div>
</template>

<script>
  import breadcrumb from '@/components/breadcrumb.vue';
  export default {
    components:{
      breadcrumb
    }
  }
</script>

<style lang="scss">
  @import "@/assets/sass/main.scss";
  #page-novel{
    .__header,
    .__body{
      display: flex;
      flex-direction: row;
      @extend %justify-center;
      .__container{
        display: flex;
        flex-direction: column;
        @extend %row;
        width: 100%;
      }
    }
    .__header{
      min-height: 480px;
      border-bottom: 1px solid #dcdce2;

    }
    .__body{
      background-color: #fff;
      min-height: 480px;
    }
  }
</style>
