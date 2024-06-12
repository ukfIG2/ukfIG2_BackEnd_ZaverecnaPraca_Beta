<template>
  <Carousel />
  <AboutSection />
  <Speakers />
  <ScheduleArea />
  <Testimonial />
  <Sponsors />
  <ContactArea />
</template>

<script>

import Carousel from '@/components/Carousel.vue';
import AboutSection from "@/components/AboutSection.vue";
import Speakers from "@/components/Speakers.vue";
import ScheduleArea from "@/components/ScheduleArea.vue";
import Testimonial from "@/components/Testimonial.vue";
import Sponsors from "@/components/Sponsors.vue";
import ContactArea from "@/components/ContactArea.vue";


export default {
  name: 'HomeView',
  components: {
    ContactArea,
    Testimonial,
    ScheduleArea,
    Speakers,
    AboutSection,
    Carousel,
    Sponsors,
  }
}
</script>
