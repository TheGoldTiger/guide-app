<script>
import { mapGetters } from 'vuex';

export default {
    data(){
        return {
            
        }
    },
    computed:{
    ...mapGetters(['getMoney'])
  }

}
</script>

<template>
<div class="story__money">
    <span>Tvůj aktuální stav peněz:</span>
    <span v-if="getMoney">{{getMoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")}},-</span>
</div>
</template>