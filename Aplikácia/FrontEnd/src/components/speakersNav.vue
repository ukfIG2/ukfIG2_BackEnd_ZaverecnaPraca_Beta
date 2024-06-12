<template>
  <div class="page-heading">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Speakers</li>
            </ul>
            <h2>Speakers</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.page-heading -->
  <div>
    <div class="featured-speakers-area mb-30 mt-5">
      <div class="container">
        <div class="sub-heading">
          <div class="row">
            <div class="col-md-12">
              <h4>Headlineri</h4>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6" v-for="(speaker, index) in speakers" :key="index">
            <div class="single-featured-speaker primary-shadow white-bg">
              <div class="row no-margin">
                <div class="col-sm-6 no-padding">
                  <div class="speaker-cover">
                    <img :src="speaker.image" alt="speakers" />
                    <div class="speaker-over">
                      <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 no-padding">
                  <div class="about-speaker">
                    <h6>{{ speaker.title }}</h6>
                    <h4>{{ speaker.name }}</h4>
                    <p>{{ speaker.description }}</p>
                    <a href="" data-bs-toggle="modal" :data-bs-target="'#fSpeaker-' + (index + 1)">More About Me</a>
                  </div>
                </div>
                <div class="modal fade" :id="'fSpeaker-' + (index + 1)" tabindex="-1">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <div class="speaker-details white-bg primary-shadow">
                          <div class="row no-margin">
                            <div class="col-sm-5 no-padding">
                              <div class="speaker-images-slider">
                                <img :src="speaker.image" alt="speaker" />
                              </div>
                            </div>
                            <div class="col-sm-7 no-padding">
                              <div class="speaker-details-texts">
                                <div class="sdt-top">
                                  <h4>{{ speaker.name }}</h4>
                                  <h6>{{ speaker.title }}</h6>
                                  <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                  </ul>
                                </div>
                                <div class="sdt-bottom">
                                  <p>{{ speaker.details }}</p>
                                  <a href="" class="button alt small" data-bs-dismiss="modal">Close</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.speaker-details -->
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.container -->
                </div>
                <!-- /.modal -->
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.featured-speakers-area -->
  </div>

<speakers />
</template>

<script>
import Speakers from "@/components/Speakers.vue";


export default {
  name: 'speakersNav',
  components: {Speakers},
  data() {
    return {
      speakers: [
        {
          image: 'images/speakers/featured/1.jpg',
          title: 'Event Organizer',
          name: 'Ethan Taylor',
          description: 'The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream, also you need to be creative.',
          details: 'The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream, also you need to be creative. Now if you want to join this then good luck.'
        },
        {
          image: 'images/speakers/featured/2.jpg',
          title: 'Title Sponsor',
          name: 'Thomas Kelly',
          description: 'The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream, also you need to be creative.',
          details: 'The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream, also you need to be creative. Now if you want to join this then good luck.'
        }
      ]
    };
  }
};
</script>

<style scoped>
.page-heading{
  background: #198754;
  background-size:cover;
}
.page-heading .overlay{
  padding:250px 0 72px;
}
.page-heading h2{
  text-transform:uppercase;
  font-weight:900;
  padding-top:11px;
  color:#fff;
}
.page-heading .breadcrumb li {
  text-transform:uppercase;
  font-weight:900;
  color:#000;
}
.page-heading .breadcrumb li a{
  color:#fff;
}
.page-heading .breadcrumb li a:hover{
  color:#000;
}
.page-heading .breadcrumb {
  background-color: transparent;
  margin-bottom: 0;
  padding:0;
}

.single-featured-speaker {
  margin-bottom: 30px;
}
.speaker-cover {
  position: relative;
}
.speaker-over {
  position: absolute;
  top: 50px;
  left: 50px;
  width: 100%;
  height: 100%;
  background: #198754;
  opacity: 0;
  transform: scale(0);
  transition: all .5s ease;
}
.single-featured-speaker:hover .speaker-over {
  opacity: 1;
  transform: scale(1);
  top: 0;
  left: 0;
}
.speaker-over ul {
  position: relative;
  top: 50%;
  margin-top: -15px;
  width: 100%;
  text-align: center;
}
.speaker-over ul li {
  display: inline-block;
}
.speaker-over ul li a {
  display: inline-block;
  padding: 5px 10px;
  line-height: 20px;
  color: #fff;
}
.speaker-over ul li a:hover {
  color: #262626;
}
.about-speaker {
  padding: 23px 30px;
}
.about-speaker h4 {
  color: #262626;
  text-transform: uppercase;
  padding: 0 0 16px;
}
.about-speaker a {
  color: #198754;
  padding: 10px 0 5px;
  margin-bottom: 10px;
  display: inline-block;
  position: relative;
}
.about-speaker a:after {
  background:#198754;
  width: 100%;
  height: 1px;
  position: absolute;
  left: 0;
  bottom: 0;
  content: "";
}
</style>

