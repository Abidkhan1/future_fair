<template>
  <div class="main_container padding_topTwo">
    <!-- banner secton start -->
    <div class="banner home_banner">
      <figure><img :src="base_url+'future_html/images/home_banner_final.jpg'" alt="banner"></figure>
      <div class="banner_content">
        <div class="auto_container">
          <div class="main_banner">
            <div class="top_logos">
              <ul>
                <li>
                  <a href="#">
                    <img :src="base_url+'future_html/images/future_fair.png'" alt="logo">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img :src="base_url+'future_html/images/company_logos/company2.png'" alt="logo">
                  </a>
                </li>
              </ul>
            </div>
            <div class="comapny_logos">
              <ul>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo0)?companyLogo0:base_url+'future_html/images/company_logos/company1.png'"alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo1)?companyLogo1:base_url+'future_html/images/company_logos/company2.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo2)?companyLogo2:base_url+'future_html/images/company_logos/company3.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo3)?companyLogo3:base_url+'future_html/images/company_logos/company4.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo4)?companyLogo4:base_url+'future_html/images/company_logos/company5.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo5)?companyLogo5:base_url+'future_html/images/company_logos/company6.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo6)?companyLogo6:base_url+'future_html/images/company_logos/company7.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo7)?companyLogo7:base_url+'future_html/images/company_logos/company8.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo8)?companyLogo8:base_url+'future_html/images/company_logos/company9.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo9)?companyLogo9:base_url+'future_html/images/company_logos/company10.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo10)?companyLogo10:base_url+'future_html/images/company_logos/company11.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo11)?companyLogo11:base_url+'future_html/images/company_logos/company12.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo12)?companyLogo12:base_url+'future_html/images/company_logos/company13.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo13)?companyLogo13:base_url+'future_html/images/company_logos/company14.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo14)?companyLogo14:base_url+'future_html/images/company_logos/company15.png'" alt="logo"></a>
                  </div>
                </li>
                <li>
                  <div class="logos_main">
                    <a href="#"><img :src="(companyLogo15)?companyLogo15:base_url+'future_html/images/company_logos/company16.png'" alt="logo"></a>
                  </div>
                </li>
              </ul>
            </div>

            <div class="my_description">
              <h1>{{dashboard_title}}</h1>
              <p><marquee scrollamount="1" width="100%" direction="up" height="100px" v-html="offers">
                <!-- {{offers}} -->
              </marquee></p>
            </div>

            <div class="row">
              <div class="col"></div>
                <div class="col-6 mt-3 pb-5" style="border-radius: 25px;
                background-color: black; opacity: 0.7; color: #14ff47;">
                  <events-select :events="events"></events-select>
                </div>
                <div class="col">
                </div>
               </div>

              </div>
            </div>
          </div>
        </div>
        <!-- banner secton end -->
      </div>
</template>

<script>
export default {
  props:['events'],
  name: "enduser-dashboad",
  data(){
    return {
      base_url: APP_URL,
      site_data: [],
      offers_data: [],
      offers: 'No offers by any Company',
      companyLogo0: '',
      companyLogo1: '',
      companyLogo2: '',
      companyLogo3: '',
      companyLogo4: '',
      companyLogo5: '',
      companyLogo6: '',
      companyLogo7: '',
      companyLogo8: '',
      companyLogo9: '',
      companyLogo10: '',
      companyLogo11: '',
      companyLogo12: '',
      companyLogo13: '',
      companyLogo14: '',
      companyLogo15: '',
      companyLogo16: '',
      dashboard_title: 'A Global Virtual Event Solution.',
      dashboard_description: 'A Global Virtual Event Solution For Everyone. The COVID-19 coronavirus has challenged event planners to find education and networking opportunities that don’t rely on in-person events. Connect attendees from anywhere in the world through virtual, hybrid, and in-person events. Build Buzz and Engage with Prospects Through an Immersive Online Trade Show. Leverage a gorgeous virtual space for your biggest trade show yet, with customizable exhibitor booths, on-demand content, chat forums, and convenient online order placement.',
    }
  },
  mounted(){
    console.log('hello');
    axios.get(APP_URL+'get_sitesettings')
    .then(response=>{
      console.log('res',response);
      this.site_data = response.data.site_settings;
      this.offers_data = response.data.offers;
      this.$nextTick(()=>{
        this.fixData()
      })
      this.setOffers();
    })
    .catch(error => {
      console.log('error:',error);
    })
  },//mounted

  methods:{
    setOffers(){
      this.offers = '';
      this.offers_data.forEach((item, i) => {
        let company_name = item.company.name;
        let company_offer = item.description;

        this.offers = this.offers+company_name+' : '+company_offer+'<br></br>'
      });

    },//setOffers

    fixData(){
      this.site_data.forEach((item, i) => {
        switch (item.name) {
          case 'dashboard_title':
            this.dashboard_title = item.value;
            break;
          case 'dashboard_description':
            this.dashboard_description = item.value;
            break;
          case 'dashboard_logo0':
            this.companyLogo0 = APP_URL+item.value;
          console.log('companyLogo0',this.companyLogo0);
            break;
          case 'dashboard_logo1':
            this.companyLogo1 = APP_URL+item.value;
            console.log('companyLogo1',this.companyLogo1);
            break;
          case 'dashboard_logo2':
            this.companyLogo2 = APP_URL+item.value;
            break;
          case 'dashboard_logo3':
            this.companyLogo3 = APP_URL+item.value;
            break;
          case 'dashboard_logo4':
            this.companyLogo4 = APP_URL+item.value;
            break;
          case 'dashboard_logo5':
            this.companyLogo5 = APP_URL+item.value;
            break;
          case 'dashboard_logo6':
            this.companyLogo6 = APP_URL+item.value;
            break;
          case 'dashboard_logo7':
            this.companyLogo7 = APP_URL+item.value;
            break;
          case 'dashboard_logo8':
            this.companyLogo8 = APP_URL+item.value;
            break;
          case 'dashboard_logo9':
            this.companyLogo9 = APP_URL+item.value;
            break;
          case 'dashboard_logo10':
            this.companyLogo10 = APP_URL+item.value;
            break;
          case 'dashboard_logo11':
            this.companyLogo11 = APP_URL+item.value;
            break;
          case 'dashboard_logo12':
            this.companyLogo12 = APP_URL+item.value;
            break;
          case 'dashboard_logo13':
            this.companyLogo13 = APP_URL+item.value;
            break;
          case 'dashboard_logo14':
            this.companyLogo14 = APP_URL+item.value;
            break;
          case 'dashboard_logo15':
            this.companyLogo15 = APP_URL+item.value;
            break;
        }
      });
    },//fixData
  }
}
</script>

<style lang="css" scoped>
</style>
