<script>
import Info from "../../components/event/Info.vue";
import Code from "../../components/event/Code.vue";

export default {
  name: "Event",
  data() {
    return {
        info: false,
        msg: ''
    }
  },
  emits:['close'],
  methods: {
    changeInfo(event) {
      this.msg = event;
      this.info = true;
    },
    closePopup(){
      this.$emit('close');
    }
  },
  components: { Info, Code }
}

</script>

<template>
    <Code v-if="!info" @openInfo="changeInfo" @close="$emit('close')"/>
    <Info :msg="msg" v-if="info&&msg" @close="closePopup"/>
</template>