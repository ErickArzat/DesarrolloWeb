<script setup>



</script>

<template>
 
  <div class="wrapper">
    <router-view></router-view>
  </div> 
 ->

</template>

<script>
export default {
  components:{
    
  },
  data() {
    return {
      langConfig: null,
    }
  },
  methods: {
  },
  created() {
  },
  computed: {
  } 
}

</script>
<style scoped>
  .wrapper{
    background-color: #fff;
    margin: auto;
  }

</style>