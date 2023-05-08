<template>
  <div class="app">
    <router-view />
  </div>
</template>

<script>
/*Inicializace vue aplikace*/

export default {
  name: "App",
  mounted(){
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
  },
}
</script>

<style>
@import "./style/scss/main.scss";

</style>