<template>
  <div class="schedule-area py-5">
    <div class="container">
      <h4 class="text-center mb-4 schedule-title">Program</h4>
      <div class="row">
        <div class="col-md-3">
          <div class="schedule-date">
            <h5 class="text-center mb-4">Stage</h5>
            <ul class="nav nav-tabs flex-column" role="tablist">
              <li v-for="(day, index) in days" :key="index" :class="{ 'nav-item': true, 'active': index === 0 }">
                <a :href="'#date-' + (index + 1)" data-bs-toggle="tab" class="nav-link" :class="{ 'active': index === 0 }">
                  <h4 class="text-center mb-1">{{ day.name }}</h4>
                  <h5 class="text-center">{{ day.date }}</h5>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div v-for="(day, index) in days" :key="index" :id="'date-' + (index + 1)" role="tabpanel" :class="{ 'tab-pane': true, 'fade': true, 'show': index === 0, 'active': index === 0 }">
              <div v-for="(session, sIndex) in day.sessions" :key="sIndex" class="single-schedule mb-4 panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab">
                    <h5 class="panel-title">
                      <a :class="[ 'collapsed', { 'active': sIndex === 0 } ]" data-bs-toggle="collapse" :data-bs-target="'#schedule-' + (index + 1) + '-' + (sIndex + 1)" aria-expanded="true">
                        {{ session.time }} - {{ session.title }}
                      </a>
                    </h5>
                  </div>
                  <div :id="'schedule-' + (index + 1) + '-' + (sIndex + 1)" class="collapse {{ sIndex === 0 ? 'show' : '' }}" role="tabpanel">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-3 schedule-img">
                          <img :src="session.image" alt="schedule" class="img-fluid" />
                        </div>
                        <div class="col-md-9 schedule-info">
                          <p>{{ session.description }}</p>
                          <h5>With: {{ session.host }} <small>Designer at <a href="">{{ session.hostCompany }}</a></small></h5>
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
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      days: [
        {
          name: 'Stage 1',
          date: '24 DECEMBER',
          sessions: [
            {
              time: '09:00 AM - 02:00 PM',
              title: 'Introducing Material Design',
              image: 'images/schedule/1.jpg',
              description: 'Material Design is a new Design language invented by Google & it\'s going to rule the design industry for a few next years. So I think every designer should have some or at least a little bit of knowledge about material design.',
              host: 'Zarina Kame',
              hostCompany: 'Google'
            },
          ]
        },
        {
          name: 'Stage 2',
          date: '25 DECEMBER',
          sessions: [
            // Sessions for Day 2
          ]
        },
        // Add more days if needed
      ]
    };
  }
}
</script>

<style>
.schedule-area {
  background: #f9f9f9;
  padding-bottom: 100px;
}

.schedule-title {
  background: #198754 ;
  color: #fff;
  text-transform: uppercase;
  border-bottom: 1px solid #198754;
  padding: 10px 0;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.schedule-date h5 {
  color: #043927;
}

.schedule-date .nav-tabs li {
  margin-bottom: 10px;
  border-bottom: none;
}

.schedule-date .nav-tabs li a {
  display: block;
  background: #198754;
  color: #fff;
  border: 0;
  border-radius: 5px;
  margin-right: 0;
  padding: 13px 30px;
  transition: background 0.3s ease;
}

.schedule-date .nav-tabs > li.active > a,
.schedule-date .nav-tabs > li.active > a:hover,
.schedule-date .nav-tabs > li.active > a:focus {
  background: #198754;
}

.nav-tabs {
  border: none;
}

.panel {
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

.panel-heading {
  background: #fff;
  color: #333;
  border-radius: 5px 5px 0 0;
  padding: 15px;
}

.panel-title a {
  display: block;
  color: #198754;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s ease;
}

.panel-title a:hover {
  color: #198754;
}

.panel-body {
  padding: 15px;
  background: #fff;
  border-radius: 0 0 5px 5px;
}

.schedule-img img {
  border-radius: 5px;
}

.schedule-info h5 {
  color: #777;
}

.schedule-info h5 a {
  font-weight: bold;
  color: #333;
}

.schedule-info h5 a:hover {
  color: #198754;
}

.schedule-info h5 small {
  font-size: 0.9em;
}

.schedule-info {
  padding-left: 15px;
}

.nav-tabs .nav-link {
  text-align: center;
}
</style>
