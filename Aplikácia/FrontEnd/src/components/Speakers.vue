<template>
  <div class="speakers-area white-bg py-5">
    <div class="container">
      <div class="sub-heading mb-4">
        <h4>Speakers</h4>
      </div>
      <div class="row">
        <!-- Speaker 1 -->
        <div class="col-md-3 col-sm-6 mb-4" v-for="speaker in speakers" :key="speaker.id">
          <div class="card shadow-sm position-relative">
            <img :src="speaker.image" class="card-img-top" :alt="`Speaker ${speaker.id}`">
            <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center" style="background-color: rgba(0,0,0,0.5);">
              <p class="text-white text-center mb-3">{{ speaker.description }}</p>
              <button class="btn btn-light" data-bs-toggle="modal" :data-bs-target="`#Speaker-${speaker.id}`">More About Me</button>
            </div>
            <div class="card-body text-center">
              <h5 class="card-title mb-0">{{ speaker.name }}</h5>
              <p class="text-muted mb-2">{{ speaker.employment }} / <a href="">{{ speaker.company }}</a></p>
              <ul class="list-inline">
                <li class="list-inline-item" v-for="social in speaker.socials" :key="social.icon"><a :href="social.link"><i :class="social.icon"></i></a></li>
              </ul>
            </div>
          </div>
          <!-- Modal for Speaker -->
          <div class="modal fade" :id="`Speaker-${speaker.id}`" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <img :src="speaker.image" class="img-fluid" :alt="`Speaker ${speaker.id}`">
                    </div>
                    <div class="col-sm-6">
                      <h4>{{ speaker.name }}</h4>
                      <h6>{{ speaker.employment }} / {{ speaker.company }}</h6>
                      <ul class="list-inline mb-4">
                        <li class="list-inline-item" v-for="social in speaker.socials" :key="social.icon"><a :href="social.link"><i :class="social.icon"></i></a></li>
                      </ul>
                      <p>{{ speaker.description }}</p>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /.speakers-area -->
</template>

<script>
export default {
  name: 'Speakers',
  data() {
    return {
      speakers: [
        {
          id: 1,
          name: 'Speaker 1',
          employment: 'Employment',
          company: 'Company',
          image: '',
          description: 'The way of Learning Design is all about the way you look on anything you see, or how you do imagine about something in your dream. You need to be creative.',
          socials: [
            { icon: 'fa fa-facebook', link: '#' },
            { icon: 'fa fa-twitter', link: '#' },
            { icon: 'fa fa-dribbble', link: '#' }
          ]
        },
        {
          id: 2,
          name: 'Speaker 2',
          employment: 'Employment',
          company: 'Company',
          image: '',
          description: 'The way of Learning Design is all about the way you look on anything you see, or how you do imagine about something in your dream. You need to be creative.',
          socials: [
            { icon: 'fa fa-facebook', link: '#' },
            { icon: 'fa fa-twitter', link: '#' },
            { icon: 'fa fa-dribbble', link: '#' }
          ]
        },
        // Add more speakers here if needed
      ]
    };
  }
}
</script>

<style scoped>
.speakers-area .overlay {
  opacity: 0;
  transition: opacity 0.3s;
}
.speakers-area .position-relative:hover .overlay {
  opacity: 1;
}
</style>
