<template>
  <Navbar />

  <schedule-nav />

  <FooterArea />

</template>

<script>

import ScheduleNav from "@/components/scheduleNav.vue";
import Navbar from "@/components/Navbar.vue";
import FooterArea from '@/components/FooterArea.vue';

export default {
  name: 'ScheduleView',
  components: {

    Navbar,

    ScheduleNav,

    FooterArea,
  }
}
</script>