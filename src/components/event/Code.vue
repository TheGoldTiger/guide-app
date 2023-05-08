<script>
import MoneyIcon from '../../components/UI/MoneyIcon.vue';
import { gsap, Power1 } from 'gsap';
import { MotionPathPlugin } from 'gsap/all';
import { mapGetters } from 'vuex';
import Money from '../../views/user/Money.vue';

export default {
    data(){
        return{
            err: false,
            openMoney: false,
            code: ''
        }
    },
    emits:['openInfo', 'close'],
    computed: {
        ...mapGetters(['getMe'])
    },
    mounted(){
       gsap.to("#question", 1.3, {
        y: "+=5px",
        yoyo: true,
        repeat: -1
        //ease: Power2.easeIn
        });

        gsap.to(".starC", {
        duration: 3,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut",
        motionPath: {
            path: "#pathC",
            align: "#pathC",
            autoRotate: true,
            alignOrigin: [0.5, 0.5]
        }
        });

        gsap.to(".starD", {
        duration: 3,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut",
        motionPath: {
            path: "#pathD",
            align: "#pathD",
            autoRotate: true,
            alignOrigin: [0.5, 0.5]
        }
        });

    },
    methods: {
        async next() { 
            // JNDGU9
            if (this.code.match(/^[A-Za-z0-9]{6}$/)){
                await this.$store.dispatch('getEventByCode', {code: this.code, id: this.getMe.id}).then((result)=>{
                    if (!result) {
                        this.err = true;
                        this.code = '';
                        setTimeout(function(){this.err = false;}, 2000);
                    } else {
                        this.code = '';
                        this.err = false;
                        this.$emit('openInfo', result);
                    }
                })
            } else {
                this.err = true;
                this.code = '';
            }
        },
        scroll() {
            window.scrollTo(0,0);
        },
    },
    components: { MoneyIcon, Money }
}
</script>

<template>
    <form v-if="!openMoney" class="event" @submit.prevent="next">
        <div class="event__logo">
                <div class="event__logo__vse"></div>
                <div class="event__logo__noc"><h1>Noc Vědců</h1></div>
        </div>
        <MoneyIcon @click="openMoney=true" />
        <div class="event__udalost">
            <div class="circle">
                <div class="stars">
                <div class="starC" >
                    <img src="../../assets/svg/hvezda_mala.svg" role="img" alt="Simply Accessible" id="starC">
                    <path id="pathC" d="M 0 100 c 0 0 -5 -10 -4 -13 s 1 -4 8 -8" />
                </div>
                <div class="starD">
                    <img src="../../assets/svg/hvezda_mala.svg" role="img" alt="Simply Accessible" id="starD">
                    
                    <path id="pathD" d="M 0 0 c 0 0 18 20 15 32 " />
                </div>
                </div>
                <img id="question" src="../../assets/svg/otaznik.svg" role="img" alt="Simply Accessible" class="q">
                <span>Náhodná <br>událost</span>
            </div>
        </div>
        <span class="event__event event__event-code">Pokud jsi potkal v&nbsp;průběhu hry náhodnou událost, zadej sem kód</span>
        <input type="text" @blur="scroll" placeholder="Zadejte kód náhodné události" class="event__code" v-model="code" @input="err=false">
        <button type="submit">Pokračovat</button>
        <button class="small" @click.prevent="$emit('close')">Zpět</button>
        <div class="event__tecky"></div>
    </form>
    <div v-if="err&&!openMoney" class="popup">
        <div @click="err = false" class="popup__close"></div>
        <p><span>Ups,</span>Zadaný kód není platný, prosím zkuste ho zadat znovu.</p>
    </div>
    <Money v-if="openMoney" @close="openMoney=false" />
</template>