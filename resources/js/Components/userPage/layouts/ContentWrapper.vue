<template>
    <Navbar/>
    <router-view/>
    <Footer/>

    

</template>

<script setup>

  import Navbar from './navbar.vue'
  import Footer from './footer.vue'
  import { useRoute } from "vue-router";
  import {themeInit} from '../../plugins/themeInit'
 

  const route = useRoute()
 
 


    function initAllScripts() {
        themeInit();
    }

</script>

