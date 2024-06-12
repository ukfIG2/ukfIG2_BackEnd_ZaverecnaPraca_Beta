<template>
  <div>
    <div class="footer-area bg-black py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6">
            <div class="single-footer-widget">
              <p>Evemat is a Responsive HTML Event Template based on material design language invented by google .</p>
              <ul class="footer-social">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="single-footer-widget">
              <h4>SUBSCribe Me !</h4>
              <form class="subscription-form">
                <input type="text" placeholder="Your Email" />
                <input type="submit" value="go" />
              </form>
              <p>Your Information is safe to us .</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bar-area bg-success">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <span>Copyright 2015 . Designed By <a href="#">BestPixels</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name:'FooterArea'
};
</script>

<style scoped>
.footer-area {
  background: #198754 ;
  padding: 100px 0 70px;
}

.single-footer-widget {
  margin-bottom: 30px;
}

.single-footer-widget h4 {
  text-transform: uppercase;
  color: #fff;
  padding-bottom: 13px;
}

.single-footer-widget p {
  color: #fff;
}


.footer-social {
  padding-top: 5px;
}

.footer-social li {
  display: inline-block;
  margin-right: 12px;
}

.footer-social li a {
  color: #fff;
}

.footer-social li a:hover {
  color: #198754 ;
}

.subscription-form {
  padding-bottom: 5px;
}

.subscription-form input[type="text"] {
  width: 80%;
  line-height: 44px;
  border: 3px solid #198754 ;
  padding-left: 15px;
  display: inline-block;
}

.subscription-form input[type="submit"] {
  width: 19%;
  line-height: 52px;
  background:#198754 ;
  text-align: center;
  text-transform: uppercase;
  color: #fff;
  border: none;
  display: inline-block;
  margin-left: -6px;
}


.footer-bar-area span {
  line-height: 40px;
  display: inline-block;
  color: #fff;
}

.footer-bar-area a {
  font-weight: 700;
  color: #fff;
}

.footer-bar-area a:hover {
  color: #262626;
}

.footer-bar-area {
  background: #198754 ;
  padding: 10px 0;
}
</style>
