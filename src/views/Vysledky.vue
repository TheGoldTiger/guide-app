<script>
import Loader from '../components/UI/Loader.vue';
export default {
    name: "Vysledky",
    data() {
        return {
            winners: null,
            timer: null,
        };
    },
    mounted() {
        this.getWinners();
    },
    beforeUnmount(){
        clearTimeout(this.timer);
    },
    methods: {
        async getWinners() {
            await this.$store.dispatch("getAllWinners").then((response) => {
                this.winners = response.sort((a, b) => {
                    let moneyA = parseInt(a.money, 10);
                    let moneyB = parseInt(b.money, 10);
                    if (moneyA > moneyB) {
                        return -1;
                    }
                    if (moneyA < moneyB) {
                        return 1;
                    }
                    if (moneyA == moneyB) {
                        if (a.created > b.created) {
                            return 1;
                        }
                        if (a.created < b.created) {
                            return -1;
                        }
                    }
                });
                this.timer = setTimeout(()=>{this.getWinners()}, 5000);
            });
        }
    },
    components: { Loader }
}

</script>

<template>
    <div v-if="winners" class="vysledky">
        <div class="vysledky__loga">
            <div class="vysledky__loga__noc"><h1>Noc vědců</h1></div>
            <div class="vysledky__loga__vse"></div>
        </div>
        <h2>Průběžné pořadí</h2>
        <div class="vysledky__half">
            <div class="vysledky__half__headline">Pořadí</div>
            <div class="vysledky__half__headline">Uživatel</div>
            <div class="vysledky__half__headline">Hodnota</div>

            <div class="vysledky__half__line-img"><img src="../assets/svg/zlato.svg" alt=""></div>
            <div class="vysledky__half__line-name" v-if="winners[0]">{{winners[0].name}}</div>
            <div class="vysledky__half__line-money" v-if="winners[0]">{{winners[0].money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")}},-</div>
            
            <div class="vysledky__half__line-img"><img src="../assets/svg/stribro.svg" alt=""></div>
            <div class="vysledky__half__line-name" v-if="winners[1]">{{winners[1].name}}</div>
            <div class="vysledky__half__line-money" v-if="winners[1]">{{winners[1].money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")}},-</div>

            <div class="vysledky__half__line-img"><img src="../assets/svg/bronz.svg" alt=""></div>
            <div class="vysledky__half__line-name" v-if="winners[2]">{{winners[2].name}}</div>
            <div class="vysledky__half__line-money" v-if="winners[2]">{{winners[2].money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")}},-</div>

        </div>
        <div class="vysledky__right">
            <div class="vysledky__right__headline">
                <div class="vysledky__right__headline__title">Pořadí</div>
                <div class="vysledky__right__headline__title">Uživatel</div>
                <div class="vysledky__right__headline__title hodnota">Hodnota</div>
            </div>

            <div class="vysledky__right__line" v-for="winner, index in winners.slice(3,10)">
                <div class="vysledky__right__line-num">{{index+4}}</div>
                <div class="vysledky__right__line-name vysledky__right__line-name-small">{{winner.name}}</div>
                <div class="vysledky__right__line-money vysledky__right__line-money-small">{{winner.money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")}},-</div>
            </div>
        </div>
    </div>
</template>