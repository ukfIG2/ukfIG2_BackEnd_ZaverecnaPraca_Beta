<template>
  <navbar />

  <contact-nav />

  <footer-area />

</template>

<script>


import ContactNav from "@/components/contactNav.vue";
import Navbar from "@/components/Navbar.vue";
import FooterArea from '@/components/FooterArea.vue';

export default {

  name: 'ContactView',
  components: {
    Navbar,

    ContactNav,

    FooterArea,

  }
}
</script>