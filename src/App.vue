<script setup>
import NavBar from './components/NavBar.vue';
import AppFooter from './components/AppFooter.vue'

</script>

<template>
  <header>
    <NavBar/>
  </header>
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
    NavBar,
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
  }
</style>
