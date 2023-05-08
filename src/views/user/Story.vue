<script>
import Money from './Money.vue';
import Event from './Event.vue';
import MoneyIcon from '../../components/UI/MoneyIcon.vue';
import EventIcon from '../../components/UI/EventIcon.vue';
import gsap, { Bounce, Power3 } from 'gsap';
import { mapGetters } from 'vuex';
import { MotionPathPlugin, Power1 } from 'gsap/all';
import End from './End.vue';
import Loader from '../../components/UI/Loader.vue';
export default {
    name: "Story",
    el: '#app',
    data() {
        return {
            answer: null,
            CC: false,
            cnb: false,
            krok: 0,
            openEvent: false,
            audio: new Audio("https://nocvedcu.vse.cz/api/assets/02_uvod.mp3"),
            storyAudio: new Audio('https://nocvedcu.vse.cz/api/assets/02_uvod.mp3'),
            isPlaying: false,
            tl: null,
            tl2: null,
            question: null,
            message: '',
            answers: '',
            loading: false,
            beat: null,
            isBeating: false,
            first: true,
        }
    },
    computed: {
        ...mapGetters(['getMe', 'getMoney']),
    },
    async mounted(){
        this.loadQuestion();
        gsap.registerPlugin(MotionPathPlugin);
        /*this.tl = gsap.timeline({repeat:-1, paused: true, defaults:{ease:"none"}})
        .to("#marque",{left:"0", duration:0})
        .to("#marque2",{left:"-100%", duration:0})
        .to("#marque",{left:"100%", duration:10})
        .to("#marque2",{left:"0", duration:10},"<");
        this.tl2 = gsap.timeline({repeat:-1, paused: true, defaults:{ease:"none"}}).to("#listen_icon",{duration: 0.75, repeat:-1, scale: 1.3, yoyo: true, ease: Bounce.easeOut, yoyoEase:Power3.easeOut});
        */

        this.audio.addEventListener('ended', (event)=>{
            this.playAudio();
        })
        this.storyAudio.addEventListener('ended', (event)=>{
            this.playAudio();
        })
    },
    methods: {
        soundAnimation(){
            setTimeout(() => {
                this.tl = gsap.timeline({repeat:-1, paused: true, defaults:{ease:"none"}})
        .to("#marque",{left:"0", duration:0})
        .to("#marque2",{left:"-100%", duration:0})
        .to("#marque",{left:"100%", duration:10})
        .to("#marque2",{left:"0", duration:10},"<");
        this.tl2 = gsap.timeline({repeat:-1, paused: true, defaults:{ease:"none"}}).to("#listen_icon",{duration: 0.75, repeat:-1, scale: 1.3, yoyo: true, ease: Bounce.easeOut, yoyoEase:Power3.easeOut});
            }, 200);
        },
        stars(){
            gsap.killTweensOf(".starA");
            gsap.killTweensOf(".starB");
            gsap.killTweensOf("#question");
            setTimeout(() => {

                gsap.to("#question", {
                duration:1.3,
                y: "+=5px",
                yoyo: true,
                repeat: -1
            });
            
            gsap.to(".starA", {
                duration: 3,
                repeat: -1,
                yoyo: true,
                ease: Power1.easeInOut,
                motionPath: {
                    path: "#pathA",
                    align: "#pathA",
                    autoRotate: true,
                    alignOrigin: [0.5, 0.5]
                }
            });
            gsap.to(".starB", {
                duration: 3,
                repeat: -1,
                yoyo: true,
                ease: Power1.easeInOut,
                motionPath: {
                    path: "#pathB",
                    align: "#pathB",
                    autoRotate: true,
                    alignOrigin: [0.5, 0.5]
                }
            });

            }, 600);
            
        },
        async loadQuestion(){
            await this.$store.dispatch('getQuestionForUser', this.getMe.id).then((response)=>{
                if (response.question.game_complete) {
                    this.krok = 'end';
                } else {
                    this.answers = response.answers;
                    this.question = response.question;
                    this.audio = new Audio(response.question.sound);
                    this.audio.addEventListener('ended', (event)=>{
                        this.playAudio();
                    })
                    if (response.question.id > 1) {
                        this.first=false;
                        this.krok = 1;
                    } else {
                        this.krok = 0;
                        this.first=true;
                    }
                    this.stars();
                }
                window.scrollTo(0,0);
            })
        },
        playAudio(){ //true ukol false story
        if (this.isPlaying) {
            this.isPlaying = false;
            if (this.krok==0) {this.storyAudio.pause()} else {this.audio.pause()} 
            this.tl.pause();
            this.tl2.pause();
        } else {
            this.isPlaying = true;
            if (this.krok==0) {this.storyAudio.play()} else {this.audio.play()} 
            this.tl.play()
            this.tl2.play();
        }
        },
        closepopup(){
            this.openEvent = false;
            if(this.krok == 0 || this.krok == 2) {
                this.soundAnimation();
            }
            window.scrollTo(0,0);
        },
        Beat(id){
            if(this.isBeating) {
                gsap.killTweensOf(".answer__answers__answer-selected");
            }
            this.answer = id;
            setTimeout(function(){this.beat = gsap.to(".answer__answers__answer-selected", {
                        duration:.4,
                        width: "+=3px",
                        height: "+=3px",
                        yoyo: true,
                        repeat: -1,
            });},100);
            this.isBeating = true;  
        },
        Next(num){
            this.krok = num;
            window.scrollTo(0,0);
            this.stars();
        },
        loadSound(){
            if(this.krok == 1) {
            this.krok = 2;
            window.scrollTo(0,0);}
            else this.first = false;

            this.soundAnimation();
            this.stars();
        },
        async submitAnswer(){
            this.loading = true;
            await this.$store.dispatch('sendAnswerForUser', {player:this.getMe.id, answer: this.answer}).then((response)=>{
                this.message = response.message;
                this.answer = null;
                this.loading = false;
                this.krok = 4;
            })
            window.scrollTo(0,0);
        }
    },
    components: { Money, Event, MoneyIcon, EventIcon, End, Loader }
}

</script>

<template>
<div v-if="(!openEvent&&(krok==0||krok==2)&&!first)" class="story">
    <div class="story__logo">
        <div class="story__logo__vse"></div>
        <div class="story__logo__noc"><h1>Noc Vědců</h1></div>
    </div>
    <EventIcon v-if="krok==2" @click="openEvent=true" />
    <div class="story__tecky" :class="krok==2 ? 'story__tecky-task' : ''"></div>
    <div v-if="krok==2" class="story__stupnice"></div>
    <span v-if="krok==0" class="story__about">POSLECHNI SI STORY</span>
    <span v-else class="story__about story__about-task">{{question.id}}. ÚKOL<span>{{question.question}}</span></span>
    <div class="story__listen" :class="krok==2 ? 'story__listen-task' : ''">
            <div id="wrapper">
                <img id="marque" class="marque" src="../../assets/svg/zvukova_stopa.svg" width="100%" alt="">
                <img id="marque2" class="marque" src="../../assets/svg/zvukova_stopa.svg" width="100%" alt="">
            </div>
            <img id="listen_icon" class="story__listen__icon" src="../../assets/svg/icon_zvuk.svg" @click="playAudio">
    </div>
    <span class="story__text">
        <span>
            Nechceš poslouchat?<br>
            Klikni pro zobrazení textu.
        </span>
        <div class="story__text__arrow" @click="CC=!CC"></div>
        <div class="story__text__CC" @click="CC=!CC"></div>
    </span>
    <button v-if="krok==0" @click="Next(1)" :class="{'down' : CC}">Pokračovat</button>
    <button v-else @click="Next(3)" class="story__button" :class="{'down' : CC}">Chci odpovědět</button>
    <span @click.prevent="krok=0" v-if="krok==2" class="story__listen-story">Znovu poslechnout celý příběh.</span>
    <div class="popup-cc" v-if=CC>
            <div class="popup-cc__cc"></div>
            <div class="popup-cc__close" @click="CC=!CC">
                <div class="popup-cc__close__icon"></div>
                <span>Zavřít text</span>
            </div>
            <p v-if="krok==0">Ahoj, <br>
                já jsem Vědkyně a&nbsp;pracuji tady na VŠE. Celé léto jsem makala na svém výzkumu, do kterého jsem narvala veškeré úspory. Úplně jsem zapomněla, že bych v létě měla jet na nějakou dovolenou. Práce na VŠE mě velice baví, ale ráda bych si i&nbsp;oddychla. Chtěla bych někam vyjet.<br>
                Problém je, že teď nemám příliš mnoho peněz. Na účtě mám pouze&nbsp;10&nbsp;000 Kč, které ti teď posílám. Pojďme spolu vymyslet způsob, jak si vydělat peníze… anebo o&nbsp;ně&nbsp;alespoň nepřijít. Čím víc peněz budeme mít, tím zajímavější místo pak spolu můžeme navštívit.<br>
                V&nbsp;průběhu hry se setkáš s&nbsp;náhodnými událostmi. Ty se objevují kdekoliv v&nbsp;atriu a&nbsp;mohou zamíchat s&nbsp;naším rozpočtem, ať už pozitivně, tak i&nbsp;negativně. Stejně jako v&nbsp;životě. Pojďme se spolu přesunout na první stanoviště.
            </p>
            <p v-else>{{question.CC}}</p>
        </div>
</div>


<div class="popup2" v-if="!openEvent&&krok==1">
<div class="popup2__logo">
    <div class="popup2__logo__vse"></div>
    <div class="popup2__logo__noc"><h1>Noc Vědců</h1></div>
</div>
<EventIcon @click="openEvent=true" />
<div class="popup2__pismo"></div>
<div class="popup2__ruka"></div>
<span class="popup2__headline">Přejdi na stanoviště</span>
<div class="popup2__num">č. {{question.id}}</div>
<span class="popup2__info">Čeká tě stanoviště:<span>{{question.question}}</span></span>
<button @click.prevent="loadSound()">Jdu tam</button>
<span @click.prevent="krok=0" class="popup2__story">Znovu poslechnout celý příběh.</span>
</div>


<div class="answer" v-if="!openEvent&&krok==3">
    <div class="story__logo">
        <div class="story__logo__vse"></div>
        <div class="story__logo__noc"><h1>Noc Vědců</h1></div>
    </div>
    <EventIcon @click="openEvent=true" />
    <div class="answer__tecky"></div>
    <div class="answer__stupnice"></div>
    <span class="answer__headline">{{question.id}}. Odpověď<span>{{question.question}}</span></span>
    <span class="answer__text">Kterou možnost zvolíš?</span>
    <div class="answer__answers">
        <div v-for="answr in answers" @click="Beat(answr.id)" class="answer__answers__answer" :class="answer==answr.id ? 'answer__answers__answer-selected' : ''">{{answr.answer}}</div>
    </div>
    <Transition name="slide-fade">
        <button v-if="answer" @click="submitAnswer()"><span v-if="!loading">Pokračovat</span><Loader v-else /></button>
    </Transition>
</div>

    
<div class="result" v-if="!openEvent&&krok==4">
    <div class="story__logo">
        <div class="story__logo__vse"></div>
        <div class="story__logo__noc"><h1>Noc Vědců</h1></div>
    </div>
    <div class="result__ucho"></div>
    <div class="result__tecky"></div>
    <span class="result__headline">{{question.id}}. Vysvětlení<span>{{question.question}}</span></span>
    <span class="result__info">{{message}}</span>
    <span class="result__vysvetleni" v-if="question.id==2" @click="cnb=!cnb"></span>
    <div class="result__stav">{{getMoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")}},–</div>
    <span class="result__text">Aktuální stav tvé peněženky.</span>
    
    <div class="popup-cc" v-if="cnb">
        <div class="popup-cc__close" @click="cnb=!cnb">
            <div class="popup-cc__close__icon"></div>
            <span>Zavřít text</span>
        </div>
        <p>
            <i>**Pokuty nereflektují reálné postihy a&nbsp;jsou použity pouze pro účely online hry v&nbsp;rámci Noci vědců. </i><br>
            Pokud máte důvodné podezření, že bankovka nebo mince není pravá, máte právo ji odmítnout. Pokud jste zjistili, že bankovka nebo mince ve vašem vlastnictví je zřejmě padělaná, nesmíte ji dále použít k&nbsp;placení, protože takové jednání je trestné. Podezřelou bankovku nebo minci odneste na Policii České republiky, do České národní banky, popř. do některé z&nbsp;obchodních bank, a&nbsp;informujte je o&nbsp;vašem podezření. Tak vyloučíte možnost, že byste spáchali trestný čin udávání padělaných nebo pozměněných peněz. Bankovka nebo mince bude předána Zkušebně platidel České národní banky, která ji prozkoumá a&nbsp;určí její pravost. Pokud se ukáže, že bankovka nebo mince je pravá, bude vám vrácena. Pokud se bude jednat o&nbsp;padělek, na náhradu nemáte nárok. (Zákon č.&nbsp;136/2011&nbsp;Sb., o&nbsp;oběhu bankovek a&nbsp;mincí, Trestní zákoník č.40/2009&nbsp;Sb.) 
        </p>
    </div>
    <button @click.prevent="loadQuestion">Pokračovat</button>
</div>
<End v-if="!openEvent&&krok=='end'" />

<Event v-if="openEvent" @close="closepopup"/>
<Money v-if="first&&(this.krok!='end')" :first="first" @close='loadSound'/>
  
</template>