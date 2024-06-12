<template>
  <Navbar />

  <speakers-nav />

  <FooterArea />

</template>

<script>
import SpeakersNav from "@/components/speakersNav.vue";
import Navbar from "@/components/Navbar.vue";
import FooterArea from '@/components/FooterArea.vue';

export default {
  name: 'SpeakersView',
  components: {
    Navbar,

    SpeakersNav,

    FooterArea,

  }
}
</script>