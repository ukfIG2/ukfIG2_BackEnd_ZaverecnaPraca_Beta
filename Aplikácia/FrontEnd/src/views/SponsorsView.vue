<template>
  <Navbar />

  <sponsors-nav />

  <FooterArea />

</template>

<script>

import SponsorsNav from "@/components/sponsorsNav.vue";
import Navbar from "@/components/Navbar.vue";
import FooterArea from '@/components/FooterArea.vue';

export default {
  name: 'ScheduleView',
  components: {
    Navbar,

    SponsorsNav,

    FooterArea,

  }
}
</script>