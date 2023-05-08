<script>
import { gsap, Bounce } from "gsap";

export default {
  name: "Home",
  mounted(){
    gsap.from('.home__logo', {
      y: -150,
      opacity: 0,
    });
    gsap.to('.home__logo', {
      duration: 2,
      y: 0,
      opacity: 1,
      ease:Bounce.easeOut
    });
    gsap.from('.home__ruka', {
      y: -150,
      opacity: 0,
    });
    gsap.to('.home__ruka', {
      duration: 3,
      y: 0,
      opacity: 1
    });
    gsap.from('.home__logo-vse', {
      y: 150,
      opacity: 0,
    });
    gsap.to('.home__logo-vse', {
      duration: 2,
      y: 0,
      opacity: 1,
      ease:Bounce.easeOut
    });
    gsap.from('.home__vlny', {
      x: 150,
      opacity: 0,
    });
    gsap.to('.home__vlny', {
      duration: 3,
      x: 0,
      opacity: 1
    });
    gsap.from('.home__stupnice', {
      x: -50,
      opacity: 0,
    });
    gsap.to('.home__stupnice', {
      duration: 3,
      x: 0,
      opacity: 1
    });
  },
}
</script>

<template>
  <div class="home">
      <div class="home__logo"><h1>Noc Vědců</h1></div>
    <div class="home__ruka"></div>
    <div class="home__stupnice"></div>
    <h2>Vítej v naší únikovce</h2>
    <span>Než se pustíš do jejího řešení, máme pro tebe pár tipů.</span>
    <div class="home__tecky"></div>
    <div class="home__tips">
      <div class="home__tips__tip">
        <span class="home__tips__tip__num">01</span>
        <p>Pro nejlepší zážitek ze hry si zapni zvuk na telefonu.</p>
      </div>
      <div class="home__tips__tip">
        <span class="home__tips__tip__num">02</span>
        <p>Pokud se během hry budeš muset znovu přihlásit, zadej název účtu, který se ti automaticky objeví po registraci.</p>
      </div>
      <div class="home__tips__tip">
        <span class="home__tips__tip__num">03</span>
        <p>Nezapomeň si hru užít.</p>
      </div>
    </div>
    <button @click="$router.push('/about')">Pokračovat</button>
    <div class="home__end">
      Držíme ti palce.
      <span>Fakulta informatiky a statistiky VŠE</span>
    </div>
    <div class="home__vlny"></div>
    <div class="home__logo-vse"></div>
  </div>
</template>