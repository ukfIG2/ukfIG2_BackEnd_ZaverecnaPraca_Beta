<template>
  <div class="page-heading">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ul>
            <h2>Contact</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.page-heading -->
  <contact-area/>
</template>


<script>

import ContactArea from "@/components/ContactArea.vue";

export default {
  name: 'contactNav',
  components: {ContactArea}
}
</script>

<style>
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
</style>
