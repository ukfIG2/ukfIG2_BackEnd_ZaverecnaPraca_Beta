<template>
  <div class="testimonials-area image-bg">
    <div class="overlay">
      <div class="container">
        <div class="sub-heading">
          <div class="row">
            <div class="col-md-12">
              <h4 class="mt-5 text-uppercase fw-bold">Testimonals</h4>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="client-pagination clearfix" id="testimonial-pager">
              <a
                  v-for="(client, index) in clients"
                  :key="index"
                  :data-bs-slide-to="index"
                  href=""
                  class="d-block"
                  @click.prevent="activeIndex = index"
                  :class="{ active: index === activeIndex }"
              >
                <img :src="client.thumb" :alt="'client ' + (index + 1)" />
              </a>
            </div>
          </div>
          <div class="col-md-8">
            <div id="testimonials">
              <div
                  v-for="(client, index) in clients"
                  :key="index"
                  v-show="index === activeIndex"
                  class="single-testimonial"
              >
                <div class="row">
                  <div class="col-sm-7 mb30">
                    <blockquote>{{ client.quote }}</blockquote>
                    <ul class="customer-rating">
                      <li v-for="n in 5" :key="n">
                        <i class="fa fa-star"></i>
                      </li>
                    </ul>
                    <h4>{{ client.name }}</h4>
                  </div>
                  <div class="col-sm-5">
                    <div class="client-image primary-shadow">
                      <img :src="client.image" :alt="'client ' + (index + 1)" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import thumb1 from '@/components/images/thumbs/1.jpg';
import thumb2 from '@/components/images/thumbs/2.jpg';
import thumb3 from '@/components/images/thumbs/3.jpg';
import thumb4 from '@/components/images/thumbs/4.jpg';
import image1 from '@/components/images/testi/1.jpg';
import image2 from '@/components/images/testi/2.jpg';
import image3 from '@/components/images/testi/3.jpg';
import image4 from '@/components/images/testi/4.jpg';

export default {
  data() {
    return {
      activeIndex: 0,
      clients: [
        {
          thumb: thumb1,
          image: image1,
          quote: 'This is the best event I had ever joined. Most exciting thing is speakers are so experienced & helpful. Also the decoration was also very good. In one word "Just Awesome"',
          name: 'Deazel Kameru',
        },
        {
          thumb: thumb2,
          image: image2,
          quote: 'This is the best event I had ever joined. Most exciting thing is speakers are so experienced & helpful. Also the decoration was also very good. In one word "Just Awesome"',
          name: 'Jožko Mrkvička',
        },
        {
          thumb: thumb3,
          image: image3,
          quote: 'This is the best event I had ever joined. Most exciting thing is speakers are so experienced & helpful. Also the decoration was also very good. In one word "Just Awesome"',
          name: 'Deazel Kameru',
        },
        {
          thumb: thumb4,
          image: image4,
          quote: 'This is the best event I had ever joined. Most exciting thing is speakers are so experienced & helpful. Also the decoration was also very good. In one word "Just Awesome"',
          name: 'Deazel Kameru',
        },
      ],
    };
  },
};
</script>

<style>
.testimonials-area {
  background: url(./images/testimonial.jpg);
  color: #fff;
}
.testimonials-area .overlay {
  padding-bottom: 70px;
}
.client-pagination {
  padding-bottom: 10px;
}
.client-pagination a.active {
  opacity: 0.7;
}
.client-pagination a {
  float: left;
  padding: 0 20px 20px 0;
  width: 25%;
}
.client-pagination a img {
  border: 5px solid #fff;
  box-shadow: 0 1px 2px rgba(43, 59, 93, 0.29);
}
.single-testimonial {
  padding-bottom: 30px;
}
.single-testimonial blockquote {
  margin-top: -8px;
}
.single-testimonial h4 {
  text-transform: uppercase;
}
.customer-rating {
  padding: 18px 0;
}
.customer-rating li {
  display: inline-block;
  font-size: 18px;
  margin-right: 5px;
}
.client-image {
  border: 5px solid #fff;
  transition: all 0.5s ease;
  width: 100%;
  margin-left: -2px;
}
.client-image img {
  width: 100%;
}
</style>
