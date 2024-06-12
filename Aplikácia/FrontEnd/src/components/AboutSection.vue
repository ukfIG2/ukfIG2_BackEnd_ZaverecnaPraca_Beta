<template>
  <div class="about-area gray-bg py-5" id="about">
    <div class="container">
      <div class="row">
        <!-- Video Intro Section -->
        <div class="col-md-6 mb-3 mb-md-0">
          <div class="video-intro shadow-sm position-relative" style="width: 570px; height: 340px;">
            <img src="./images/video-intro.jpg" alt="video-intro" class="img-fluid">
            <a class="video-play embedded-popup position-absolute top-50 start-50 translate-middle" href="">
              <i class="fa fa-play fa-2x"></i>
            </a>
          </div>
        </div>
        <!-- About Text Section -->
        <div class="col-md-6">
          <div class="about-text">
            <h4>Pár slov o konferencii nConnect</h4>
            <p>Po mnohých rokoch premýšľania a plánovania sme vytvorili nConnect, jedinečnú udalosť v Nitre, ktorá spája študentov IT a popredné firmy z tohto dynamického odvetvia. Konferencia nConnect nadväzuje na dlhoročnú tradíciu formátu "IT v praxi" Fakulty prírodných vied a informatiky UKF v Nitre. Táto iniciatíva je mostom medzi novou generáciou talentov a skúsenými profesionálmi, ktorý poskytuje fórum pre vzájomnú výmenu myšlienok a inšpirácií. Naše poslanie bolo jasné: vyplniť medzeru v regionálnej komunikácii a spolupráci v IT a nConnect je hrdým výsledkom tejto vízie.</p>
          </div>
          <!-- Additional Information Section -->
          <div class="row">
            <div class="col-sm-6 mb-3">
              <div class="single-about shadow-sm p-3 bg-white h-100">
                <h5>Kto sme ?</h5>
                <p>Sme skupina nadšencov pre IT z akademického a súkromného sektora.</p>
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="single-about shadow-sm p-3 bg-white h-100">
                <h5>Čo chceme dosiahnuť ?</h5>
                <p>Vytvoriť udalosť, ktorá bude na pravidelnej báze spájať IT komunitu v Nitre.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'AboutSection'
}
</script>

<style scoped>
.about-area {
  background-color: #f8f9fa;
}
.video-intro {
  position: relative;
  overflow: hidden;
}
.video-play {
  color: #fff;
  background-color: rgba(0, 0, 0, 0.6);
  border-radius: 50%;
  padding: 10px;
  transition: background-color 0.3s;
}
.video-play:hover {
  background-color: rgba(0, 0, 0, 0.8);
}
</style>