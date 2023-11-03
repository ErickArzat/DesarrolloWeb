<script setup>
import AppFooter from './components/AppFooter.vue'
import NavBar from './components/NavBAr.vue'

</script>

<template>
  <navbar>
    <NavBar/>
  </navbar>
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
    AppFooter,
    NavBar
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
    margin: auto;
  }

</style>
