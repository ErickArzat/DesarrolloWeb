<script setup>
import AppFooter from './components/AppFooter.vue'

</script>

<template>
  <div class="wrapper">
    <router-view></router-view>
  </div>
  <footer>
    <AppFooter/>
  </footer>
</template>

<script>
export default {
  components:{
    AppFooter
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
    background-color: white;
    align-content: center;
    margin: auto;
  }

  footer{
    position: fixed;
    bottom: 0;
    width: 100%;
  }
</style>
