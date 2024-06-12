<template>

  <Navbar />

  <Register />

  <FooterArea />

</template>

<script>

import {defineComponent} from "vue";
import Register from "@/components/Register.vue";
import Navbar from "@/components/Navbar.vue";
import FooterArea from '@/components/FooterArea.vue';

export default defineComponent({
  components: {
    Navbar,
    
    Register,
  
    FooterArea,
  
  }
})
</script>