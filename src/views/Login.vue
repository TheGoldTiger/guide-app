<script>
import gsap from 'gsap';
import Loader from '../components/UI/Loader.vue';

export default {
    name: "Login",
    data() {
        return {
            name: "",
            err: false,
            loading: false
        };
    },
    methods: {
        async sendName() {
            if (this.name.match(/[A-Za-z0-9]+/ig)) {
              this.loading = true;
                await this.$store.dispatch("getUserByName", this.name).then(async (response) => {
                    if (!response) {
                        this.err = true;
                    }
                    else {
                        await this.$router.push("/story").then(()=>{this.loading = false});
                    }
                    
                });
            }
        }
    },
    mounted() {
        gsap.from(".login__tecky", {
            y: -100,
            opacity: 0,
        });
        gsap.to(".login__tecky", {
            duration: 3,
            y: 0,
            opacity: 1
        });
        gsap.from(".animation_right", {
            x: 200,
            opacity: 0,
        });
        gsap.to(".animation_right", {
            duration: 3,
            x: 0,
            opacity: 1
        });
    },
    components: { Loader }
}
</script>

<template>
  <form class="login" @submit.prevent="sendName">
    <div class="login__logo">
            <div class="login__logo__vse"></div>
            <div class="login__logo__noc"><h1>Noc Vědců</h1></div>
    </div>
    <div class="login__citron">
      <div class="login__ruka animation_right"></div>
      <div class="login__kapka animation_right"></div>
    </div>
    <div class="login__tecky"></div>
    <h2>Přihlásit se</h2>
    <input type="text" placeholder="Zadej svůj účet" v-model="name" @input="err=false">
    <button v-if="!loading" type="submit">Pokračovat</button>
    <button v-else type="submit"><Loader/></button>

    <span class="login__story" @click="$router.push('/register')">Založit nový účet</span>
  </form>
  <div v-if="err" class="popup">
    <div class="popup__close" @click="err=false"></div>
    <p><span>Ups,</span>přihlášení se nezdařilo.</p>
  </div>
</template>