<script setup>
import NavBar from './components/NavBar.vue';
import AppFooter from './components/AppFooter.vue'
import ContactUs  from './components/ContactUs.vue';

</script>

<template>
  <header>
    <NavBar/>
  </header>
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
  }
</style>
