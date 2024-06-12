<template>
  <div class="sponsors-area gray-bg">
    <div class="container">
      <div class="sub-heading">
        <div class="row">
          <div class="col-md-12">
            <h4 class="mt-5 text-uppercase fw-bold">Sponsors</h4>
          </div>
        </div>
      </div>

      <div class="sponsors-nav mt-3">
        <ul class="nav nav-tabs" id="sponsorTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="silver-tab" data-bs-toggle="tab" href="#SilverSponsors" role="tab" aria-controls="SilverSponsors" aria-selected="true">Silver Sponsors</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="gold-tab" data-bs-toggle="tab" href="#GoldSponsors" role="tab" aria-controls="GoldSponsors" aria-selected="false">Gold Sponsors</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="platinum-tab" data-bs-toggle="tab" href="#PlatinumSponsors" role="tab" aria-controls="PlatinumSponsors" aria-selected="false">Platinum Sponsors</a>
          </li>
        </ul>
      </div>

      <div class="tab-content sponsors-contents text-center mt-3" id="sponsorTabsContent">
        <div class="tab-pane fade show active" id="SilverSponsors" role="tabpanel" aria-labelledby="silver-tab">
          <div class="row">
            <div v-for="sponsor in silverSponsors" :key="sponsor.id" class="col-md-3 col-sm-6 mb-3">
              <div class="single-sponsor primary-shadow white-bg">
                <img :src="sponsor.img" :alt="sponsor.alt" />
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="GoldSponsors" role="tabpanel" aria-labelledby="gold-tab">
          <div class="row">
            <div v-for="sponsor in goldSponsors" :key="sponsor.id" class="col-md-3 col-sm-6 mb-3">
              <div class="single-sponsor primary-shadow white-bg">
                <img :src="sponsor.img" :alt="sponsor.alt" />
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="PlatinumSponsors" role="tabpanel" aria-labelledby="platinum-tab">
          <div class="row">
            <div v-for="sponsor in platinumSponsors" :key="sponsor.id" class="col-md-3 col-sm-6 mb-3">
              <div class="single-sponsor primary-shadow white-bg">
                <img :src="sponsor.img" :alt="sponsor.alt" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="become-sponsor text-center mt-5">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sponsor-form">Become a Sponsor</button>
      </div>
      <div class="modal fade" id="sponsor-form" tabindex="-1" aria-labelledby="sponsorFormLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="sponsorFormLabel">Become a Sponsor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body sponsor-form-area">
              <form @submit.prevent="submitForm">
                <div class="mb-3">
                  <label for="Your-name" class="form-label">Your Name</label>
                  <input type="text" class="form-control" id="Your-name" v-model="form.name" required>
                </div>
                <div class="mb-3">
                  <label for="Email-address" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="Email-address" v-model="form.email" required>
                </div>
                <div class="mb-3">
                  <label for="Phone-No" class="form-label">Phone No</label>
                  <input type="tel" class="form-control" id="Phone-No" v-model="form.phone" required>
                </div>
                <div class="mb-3">
                  <label for="Company-name" class="form-label">Company Name</label>
                  <input type="text" class="form-control" id="Company-name" v-model="form.company" required>
                </div>
                <div class="mb-3">
                  <label for="Position" class="form-label">Position</label>
                  <input type="text" class="form-control" id="Position" v-model="form.position" required>
                </div>
                <div class="mb-3">
                  <label for="Website-Url" class="form-label">Website URL</label>
                  <input type="url" class="form-control" id="Website-Url" v-model="form.website" required>
                </div>
                <div class="mb-3">
                  <label for="some-text" class="form-label">Tell more about you or your company</label>
                  <textarea class="form-control" id="some-text" v-model="form.description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="sps" id="Silver" value="Silver" v-model="form.package" checked>
                    <label class="form-check-label" for="Silver">
                      Silver
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="sps" id="Gold" value="Gold" v-model="form.package">
                    <label class="form-check-label" for="Gold">
                      Gold
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="sps" id="Platinum" value="Platinum" v-model="form.package">
                    <label class="form-check-label" for="Platinum">
                      Platinum
                    </label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import sponsor1 from './images/sponsor/1.png';
import sponsor2 from './images/sponsor/2.png';
import sponsor3 from './images/sponsor/3.png';
import sponsor4 from './images/sponsor/4.png';

export default {
  name: 'Sponsors',
  data() {
    return {
      silverSponsors: [
        { id: 1, img: sponsor1, alt: 'Silver Sponsor 1' },
        { id: 2, img: sponsor2, alt: 'Silver Sponsor 2' },
        { id: 3, img: sponsor3, alt: 'Silver Sponsor 3' },
        { id: 4, img: sponsor4, alt: 'Silver Sponsor 4' },
      ],
      goldSponsors: [
        { id: 1, img: sponsor2, alt: 'Gold Sponsor 1' },
        { id: 2, img: sponsor4, alt: 'Gold Sponsor 2' },
        { id: 3, img: sponsor1, alt: 'Gold Sponsor 3' },
        { id: 4, img: sponsor3, alt: 'Gold Sponsor 4' },
      ],
      platinumSponsors: [
        { id: 1, img: sponsor4, alt: 'Platinum Sponsor 1' },
        { id: 2, img: sponsor3, alt: 'Platinum Sponsor 2' },
        { id: 3, img: sponsor2, alt: 'Platinum Sponsor 3' },
        { id: 4, img: sponsor1, alt: 'Platinum Sponsor 4' },
      ],
      form: {
        name: '',
        email: '',
        phone: '',
        company: '',
        position: '',
        website: '',
        description: '',
        package: 'Silver'
      }
    };
  },
  methods: {
    submitForm() {
      // Handle form submission
      console.log('Form submitted');
    }
  }
};
</script>

<style scoped>
/* Your scoped CSS styles */
.sponsors-area {
  padding-bottom: 100px;
}

.single-sponsor {
  position: relative;
  overflow: hidden;
}

.single-sponsor img {
  width: 100%;
}

.sponsors-nav .nav-tabs li {
  margin: 0 30px 0 0;
  background: #fff;
  box-shadow: 0 1px 2px rgba(43, 59, 93, 0.29);
}

.sponsors-nav .nav-tabs li a {
  border: 1px solid transparent;
  border-radius: 0;
  background: #fff;
  text-transform: uppercase;
  color: #262626;
  margin-right: 0;
}

.sponsors-nav .nav-tabs li a:hover,
.sponsors-nav .nav-tabs li a:focus {
  background-color: transparent;
  color: #262626;
}

.sponsors-nav .nav-tabs li.active a {
  background: #7c4dff;
  color: #fff;
}

.sponsor-form-area {
  margin: 50px 0;
  padding: 30px 30px 20px;
}

.input-box-underline :focus {
  color: #fff;
  background: #7c4dff;
}

.input-box-underline textarea{
  height: 130px;
}

.single-package-select label {
  background: #f0f1f3;
  border: none;
  border-bottom: 2px solid #7c4dff;
  margin-bottom: 30px;
  width: 100%;
  padding: 24px 0;
  cursor: pointer;
  transition: all 0.5s ease;
}

.single-package-select label{
  text-transform: uppercase;
  color: #262626;
  transition: all 0.5s ease;
}

.single-package-select input:checked + label {
  color: #fff;
  background: #7c4dff;
  cursor: default;
}

.single-package-select input:checked + label{
  color: #fff;
}

.single-package-select input {
  display: none;
}
</style>