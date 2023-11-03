<script setup>
import AppFooter from './components/AppFooter.vue'
import ContactUs  from './components/ContactUs.vue';
import NavBar from './components/NavBar.vue'

</script>

<template>
  <navbar>
    <NavBar/>
  </navbar>
  <div class="wrapper">
    <router-view></router-view>
  </div> 
  <div class="contact-us">
    <ContactUs/>
  </div>
  <!-- <footer>
    <AppFooter/>
  </footer> -->

</template>

<script>
export default {
  components:{
    NavBar,
    AppFooter,
    ContactUs
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
