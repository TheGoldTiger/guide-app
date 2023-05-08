<script>
import gsap from 'gsap';
import Loader from '../components/UI/Loader.vue';

export default {
    name: "Register",
    data() {
        return {
            returning: false,
            name: "",
            err: false,
            success: false,
            username: "",
            loading: false,
        };
    },
    methods: {
        async sendName() {
            if (this.name.match(/^[A-Za-z]+$/)) {
                this.loading = true;
                await this.$store.dispatch("addUser", { name: this.name }).then((response) => {
                    this.username = response;
                    this.err = false;
                    this.success = true;
                    this.loading = false;
                });
            }
            else {
                this.err = true;
            }
        },
        scroll() {
            window.scrollTo(0,0);
        }
    },
    mounted() {
        gsap.from(".register__tecky", {
            x: -100,
            opacity: 0,
        });
        gsap.to(".register__tecky", {
            duration: 3,
            x: 0,
            opacity: 1
        });
        gsap.from(".register__kobylka", {
            y: -400,
            opacity: 0,
        });
        gsap.to(".register__kobylka", {
            duration: 3,
            y: 0,
            opacity: 1
        });
    },
    components: { Loader }
}
</script>

<template>
  <form v-if="!success" class="register" @submit.prevent="sendName">
    <div class="register__logo">
            <div class="register__logo__vse"></div>
            <div class="register__logo__noc"><h1>Noc Vědců</h1></div>
    </div>
    <div class="register__tecky"></div>
    <h2>Registrace</h2>
    <span class="register__about">Zadej své křestní jméno</span>
    <span class="register__info">(zadej jméno bez mezer a diakritiky)</span>
    <input type="text" @blur="scroll" placeholder="Tvé jméno" v-model="name" @input="err=false">
    <button v-if="!loading" type="submit">Pokračovat</button>
    <button v-else><Loader /></button>
    <div class="register__kobylka"></div>
    <span class="register__login" @click="$router.push('/login')">Chci se opětovně přihlásit</span>
    <span class="register__ps">*P.S. Tvoje jméno potřebujeme pouze pro účely této hry, nikde jinde ho nepoužijeme.</span>
  </form>
  <div v-if="err" class="popup">
    <div @click="err=false" class="popup__close"></div>
    <p><span>Ups,</span>prosím zkus zadat jméno dle instrukcí.</p>
  </div>
  <div v-if="success" class="account">
    <div class="account__logo">
            <div class="account__logo__vse"></div>
            <div class="account__logo__noc"><h1>Noc Vědců</h1></div>
    </div>
    <div class="account__name">
      Tvůj účet je:
      <span>{{username}}</span>
    </div>
    <div class="account__info">
      Pro opětovné přihlášení zadejte znova výše uvedené přihlašovací jméno.
    </div>
    <button @click="$router.push('/story')">Beru na vědomí</button>
  </div>
</template>