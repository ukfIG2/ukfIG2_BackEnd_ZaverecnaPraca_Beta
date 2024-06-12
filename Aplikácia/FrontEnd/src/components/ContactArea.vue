<template>
  <div class="contact-area gray-bg py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mb-3 mb-md-0">
          <div class="card location-card primary-shadow">
            <img src="./images/contact/location.jpg" class="card-img" alt="location">
            <div class="overlay bg-dark"></div>
            <div class="card-img-overlay location-info">
              <h6 class="text-white">Hall Of Fame</h6>
              <h4 class="text-white">49 West 32nd Street, New York</h4>
            </div>
            <span class="map-trigger" @click="toggleMap">
              <i class="fa fa-map-marker"></i>
            </span>
            <div class="google-map-area" :class="{'show-map': mapVisible}">
              <div id="map" class="map"></div>
              <span class="map-close" @click="toggleMap">
                <i class="fa fa-close"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card contact-info primary-shadow white-bg p-4">
            <h4>Contact Info</h4>
            <div class="row">
              <div class="col-12 mb-3">
                <ContactPerson
                    img-src="images/contact/cp1.jpg"
                    name="Ruby Martin"
                    title="Organizer"
                    phone="+02 596 355 32"
                    email="ruby@evemate.com"
                />
              </div>
              <div class="col-12">
                <ContactPerson
                    img-src="images/contact/cp2.jpg"
                    name="Ella Robinson"
                    title="Planner"
                    phone="+02 596 355 32"
                    email="ella@evemate.com"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import ContactPerson from './ContactPerson.vue';

export default {
  components: { ContactPerson },
  setup() {
    const mapVisible = ref(false);
    const toggleMap = () => {
      mapVisible.value = !mapVisible.value;
    };

    return { mapVisible, toggleMap };
  }
};
</script>

<style scoped>
.contact-area {
  padding: 100px 0 70px;
}

.location-card {
  position: relative;
  overflow: hidden;
}
.location-card .overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  opacity: .5;
}
.location-info {
  position: absolute;
  left: 0;
  bottom: 0;
  padding: 0 0 25px 30px;
  color: #fff;
  text-transform: uppercase;
}

.map-trigger .fa,
.map-close .fa {
  text-shadow: 0 1px 2px rgba(43, 59, 93, 0.29);
}
.map-trigger,
.map-close {
  position: absolute;
  top: 0;
  right: 0;
  font-size: 30px;
  line-height: 30px;
  margin: 30px;
  color: #fff;
  cursor: pointer;
}

.google-map-area {
  position: absolute;
  top: -100%;
  left: -100%;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 0.3s, top 0.3s, left 0.3s;
}
.google-map-area.show-map {
  top: 0;
  left: 0;
  opacity: 1;
}
.map {
  position: relative;
  width: 100%;
  height: 100%;
}

.contact-info {
  padding: 40px;
}
.contact-info h4::after {
  position: absolute;
  top: 7px;
  left: 0;
  width: 2px;
  height: 14px;
  content: "";
  background: #198754;
}
.contact-info h4 {
  position: relative;
  text-transform: uppercase;
  color: #198754;
  padding-left: 12px;
  padding-bottom: 32px;
}

.single-contact-info h6 {
  text-transform: uppercase;
  font-weight: 900;
  color: #363636;
}
.single-contact-info span {
  color: #198754;
}

.single-contact-info ul {
  padding-top: 5px;
}
.single-contact-info ul li {
  line-height: 18px;
  font-size: 12px;
}
</style>
