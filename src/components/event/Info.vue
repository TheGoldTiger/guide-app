<template>
    <div class="event event-yellow">
        <div class="event__logo">
                <div class="event__logo__vse"></div>
                <div class="event__logo__noc"><h1>Noc Vědců</h1></div>
        </div>
        <MoneyIcon />
        <h2>{{msg.nazev}}</h2>
        <span class="event__event">{{msg.text}}</span>
        <span v-if="change!=0" class="event__amount">{{change}},-</span>
        <span class="event__info">V peněžence máš</span>
        <div class="event__stav">{{getMoney}},–</div>
        <span v-for="t in test">Kliknuto</span>
        <button @click.prevent="$emit('close')">Beru na vědomí</button>
        <div class="event__kvetina"></div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import MoneyIcon from '../../components/UI/MoneyIcon.vue';


export default {
    props:['msg'],
    emits:['close'],
    computed:{
        ...mapGetters(['getMoney']),
        change(){
            if (this.msg.money_change){
                if (Math.sign(this.msg.money_change)==1){
                    return '+'+this.msg.money_change
                } else if (Math.sign(this.msg.money_change)==0) {
                    return 0
                } else {
                    return this.msg.money_change
                }
            } else {
                return 0
            }
        }
    },
    components: { MoneyIcon }
}
</script>