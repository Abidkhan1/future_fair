<template>
  <transition
    enter-active-class="animate__animated  animate__backInUp"
    leave-active-class="animate__animated animate__backInDown"
  >
  <div class="main_container padding_topTwo" style="padding-top: 0px;" v-if="changePavillion">
            <!-- banner secton start -->
    <div class="banner pavilion_banner">
      <figure><img
        :src="base_url+'future_html/images/pav_final.jpg'" alt="banner">
      </figure>
      <div class="banner_content pavillion_banner_content">
        <div class="auto_container">

          <div class="main_banner">
            <div class="pavilion_gallery">
             <ul>
               <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[0])? base_url+'reception/'+company_ids[0]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[0])">
                   <img :src="(banners[0])? banners[0]:alt_banner" alt="No Image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall1.png'" alt=""> </strong>
                </div>
               </li>
               <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[1])? base_url+'reception/'+company_ids[1]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[1])">
                   <img :src="(banners[1])? banners[1]:alt_banner" alt="No image">
                   </a>
                   <strong> <img :src="base_url+'future_html/images/Stall2.png'" alt=""> </strong>
                </div>
               </li>
               <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[2])? base_url+'reception/'+company_ids[2]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[2])">
                   <img :src="(banners[2])? banners[2]:alt_banner" alt="No Image">
                   </a>
                   <strong> <img :src="base_url+'future_html/images/Stall3.png'" alt=""> </strong>
                </div>
               </li>
               <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[3])? base_url+'reception/'+company_ids[3]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[3])">
                   <img :src="(banners[3])? banners[3]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall4.png'" alt=""> </strong>
                </div>
               </li>
               <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[4])? base_url+'reception/'+company_ids[4]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[4])">
                   <img :src="(banners[4])? banners[4]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall5.png'" alt=""> </strong>
                </div>
              </li>

              <li>
               <div class="pav_galleryInner">
                <a :href="(company_ids[5])? base_url+'receptio'/event/'+event_idnevent/'+company_ids[5]+'/event'+event_id:'javascript:void(0);'"
                @click="stallStatus(company_ids[5])">
                  <img :src="(banners[5])? banners[5]:alt_banner" alt="No image">
                </a>
                <strong> <img :src="base_url+'future_html/images/Stall2.png'" alt=""> </strong>
               </div>
              </li>
              <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[6])? base_url+'reception/'+company_ids[6]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[6])">
                   <img :src="(banners[6])? banners[6]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall3.png'" alt=""> </strong>
                </div>
              </li>
              <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[7])? base_url+'reception/'+company_ids[7]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[7])">
                   <img :src="(banners[7])? banners[7]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall4.png'" alt=""> </strong>
                </div>
              </li>
              <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[8])? base_url+'reception/'+company_ids[8]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[8])">
                   <img :src="(banners[8])? banners[8]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall5.png'" alt=""> </strong>
                </div>
              </li>
              <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[9])? base_url+'reception/'+company_ids[9]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[9])">
                   <img :src="(banners[9])? banners[9]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall1.png'" alt=""> </strong>
                </div>
              </li>
              <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[10])? base_url+'reception/'+company_ids[10]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[10])">
                   <img :src="(banners[10])? banners[10]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall2.png'" alt=""> </strong>
                </div>
              </li>
              <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[11])? base_url+'reception/'+company_ids[11]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[11])">
                   <img :src="(banners[11])? banners[11]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall3.png'" alt=""> </strong>
                </div>
              </li>
              <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[12])? base_url+'reception/'+company_ids[12]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[12])">
                   <img :src="(banners[12])? banners[12]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall4.png'" alt=""> </strong>
                </div>
              </li>
              <li>
                <div class="pav_galleryInner">
                 <a :href="(company_ids[13])? base_url+'reception/'+company_ids[13]+'/event/'+event_id:'javascript:void(0);'"
                 @click="stallStatus(company_ids[13])"
                 >
                   <img :src="(banners[13])? banners[13]:alt_banner" alt="No image">
                 </a>
                 <strong> <img :src="base_url+'future_html/images/Stall5.png'" alt=""> </strong>
                </div>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
    <div class="arrow_scroll">
      <!-- <a href=""></a> -->
      <img :src="base_url+'future_html/images/arow_down.png'" alt="img"
      v-if="pav_index < total_pavillions -1"
      @click="nextPavillion">
      <img :src="base_url+'future_html/images/arow_up.png'" alt="img"
      v-if="pav_index > 0"
      @click="previousPavillion">
      <!-- <a href=""></a> -->
    </div>
    </div>
            <!-- banner secton end -->
  </div>
  </transition>
</template>

<script>
import Swal from 'sweetalert2'
import 'animate.css'
export default {

  props:['event'],
  name: "pavillion",
  data(){
    return {
      slots:[],
      banners:['','','','','','','','','','','','','',''],
      company_ids:['','','','','','','','','','','','','',''],
      pavillions:[],
      selected_pav:[],
      slots_data:[],
      pav_index:0,
      event_id:'',
      changePavillion:true,
      total_pavillions:'',
      sm_background:APP_URL+'future_html/images/mob_pav.jpg',
      lg_background:APP_URL+'future_html/images/pavillion_new.jpg',
      alt_banner:APP_URL+'future_html/images/door_company.png',
      base_url:APP_URL,
    }
  },
  mounted(){
    this.event_id = this.event.id;
    axios.get(APP_URL+`pavillion_data/${this.event.id}`)
    .then(res=>{
      this.total_pavillions = res.data.pavillion_ids.length;
      this.pavillions = res.data.data;
      this.$nextTick(()=>{
        this.selected_pav = this.pavillions[this.pav_index];
        this.setData();
      })
    })
    .catch(err=>{
      console.log('error:',err);
    })
  },//mounted
  methods:{
    stallStatus(status){
      if (status == '') {
        Swal.fire(
          'Empty Slot!',
          'This Slot is vaccant, not assigned to anyone.',
          'error'
        )
      }
    },//stallStatus

    nextPavillion(){
      this.changePavillion = false;
      this.pav_index++;
      let _self = this;
      this.$nextTick(()=>{
        _self.changePavillion= true;
        _self.selected_pav = _self.pavillions[this.pav_index];
        _self.clearArray();
        // _self.setData();
      })
    },//nextPav
    previousPavillion(){
      this.changePavillion = false;
      this.pav_index--;
      let _self = this;
      this.$nextTick(()=>{
        _self.changePavillion= true;
        _self.selected_pav = _self.pavillions[this.pav_index];
        _self.clearArray();
        // _self.setData();
      })
    },//previousPav

    clearArray(){
      for (var i = 0; i < 14; i++) {
        this.banners.splice(i, 1, '');
        this.company_ids.splice(i,1,'');
      }
      let _self = this
      this.$nextTick(()=>{
        _self.setData();
      })
    },//clearArray

    setData(){
      this.selected_pav.forEach((item, i) => {
        let path = this.base_url+item.company.logo;
        this.banners.splice(parseInt(item.name)-1, 1, path);
        this.company_ids.splice(parseInt(item.name)-1,1,item.company.id);
      });
      this.$nextTick(()=>{
      console.log('company_ids',this.company_ids);
      console.log('banners',this.banners);
      });
    },//setData
  },
}
</script>

<style lang="css" scoped>
</style>
