<template>
  <Navbar />

  <login />

  <FooterArea />

</template>

<script>

import {defineComponent} from "vue";
import Login from "@/components/Login.vue";
import Navbar from "@/components/Navbar.vue";
import FooterArea from '@/components/FooterArea.vue';

export default defineComponent({
  components: {
    Navbar,

    Login,

    FooterArea,
  }

})
</script>