<script>
import gsap, { Bounce, Power3 } from 'gsap';

export default {
  name: "About",
  data() {
    return {
        CC: false,
        audio: new Audio("https://nocvedcu.vse.cz/api/assets/01_predstaveni_hry.mp3"),
        isPlaying: false,
        tl: null,
        tl2: null,
    }
  },
  mounted(){
    this.tl = gsap.timeline({repeat:-1, paused: true, defaults:{ease:"none"}})
        .to("#marque",{left:"0", duration:0})
        .to("#marque2",{left:"-100%", duration:0})
        .to("#marque",{left:"100%", duration:10})
        .to("#marque2",{left:"0", duration:10},"<");
        this.tl2 = gsap.timeline({repeat:-1, paused: true, defaults:{ease:"none"}}).to("#listen_icon",{duration: 0.75, repeat:-1, scale: 1.3, yoyo: true, ease: Bounce.easeOut, yoyoEase:Power3.easeOut});
        
        this.audio.addEventListener('ended', (event)=>{
            this.playAudio();
        })
  },
  methods: {
    playAudio(){
        if (this.isPlaying) {
            this.isPlaying = false;
            this.audio.pause();
            this.tl.pause();
            this.tl2.pause();
        } else {
            this.isPlaying = true;
            this.audio.play();
            this.tl.play();
            this.tl2.play();
        }
    },
  },
}
</script>

<template>
    <div class="about">
        <div class="about__logo">
            <div class="about__logo__vse"></div>
            <div class="about__logo__noc"><h1>Noc Vědců</h1></div>
        </div>
        <div class="about__stupnice"></div>
        <div class="about__zena"></div>
        <h2>Zažij finance na vlastní kůži</h2>
        <span class="about__about">O čem je hra?</span>
        <div class="about__listen">
            <div id="wrapper">
                <img id="marque" class="marque" src="../assets/svg/zvukova_stopa.svg" width="100%" alt="">
                <img id="marque2" class="marque" src="../assets/svg/zvukova_stopa.svg" width="100%" alt="">
            </div>
            <div id="listen_icon" class="about__listen__icon" @click="playAudio"></div>
        </div>
        <span class="about__text">
            <span>Nechceš poslouchat?<br>
            Klikni pro zobrazení textu.</span>
            <div class="about__text__arrow" @click="CC=!CC"></div>
            <div class="about__text__CC" @click="CC=!CC"></div>
        </span>
        <button @click="$router.push('/register')" :class="{'down' : CC}">Spustit hru</button>
        <div class="popup-cc" v-if=CC>
            <div class="popup-cc__cc"></div>
            <div class="popup-cc__close" @click="CC=!CC">
                <div class="popup-cc__close__icon"></div>
                <span>Zavřít text</span>
            </div>
            <p>Připravili jsme si pro tebe hru MONEY&nbsp;ADVENTURE, která tě v&nbsp;průběhu večera přiučí něco o&nbsp;finanční gramotnosti. Na úvod dostaneš peníze a&nbsp;bude na tobě, jak s&nbsp;nimi naložíš. Tak nažhav smysly a&nbsp;přejeme ti hodně štěstí.</p>
        </div>
    </div>
</template>