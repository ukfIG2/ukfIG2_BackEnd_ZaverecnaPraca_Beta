<template>
  <div class="single-contact-info">
    <div class="row">
      <div class="col-5">
        <img :src="imgSrc" alt="contact" class="img-fluid" />
      </div>
      <div class="col-7">
        <h6>{{ name }}</h6>
        <span class="p-like">{{ title }}</span>
        <ul>
          <li>{{ phone }}</li>
          <li>{{ email }}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    imgSrc: String,
    name: String,
    title: String,
    phone: String,
    email: String
  }
};
</script>

<style scoped>
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
