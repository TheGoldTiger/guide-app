<script>
import { mapGetters } from 'vuex';

export default {
  name: "Money",
  props: ['first'],
  data() {
    return {
      
    }
  },
  methods: {

  },
  computed:{
    ...mapGetters(['getMoney'])
  }
}
</script>

<template>
    <div class="money">
        <div class="money__logo">
                <div class="money__logo__vse"></div>
                <div class="money__logo__noc"><h1>Noc Vědců</h1></div>
        </div>
        <div class="money__ucho"></div>
        <div class="money__tecky"></div>
        <span class="money__text">Tvůj {{first? 'počáteční' : 'aktuální'}} stav v&nbsp;peněžence</span>
        <div class="money__stav">{{getMoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")}},–</div>
        <button @click.prevent="$emit('close')">Pokračovat</button>
    </div>
</template>