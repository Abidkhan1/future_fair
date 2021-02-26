<template>
  <div class="main_container padding_topTwo" style="
    padding-top: 0px;">
      <!-- banner secton start -->
      <div class="banner chatInnner_banner">
          <figure class="reception_banner"><img :src="base_url+'future_html/images/reception_new.jpg'" alt="banner"></figure>
          <div class="banner_content">
            <div class="my_marquee for_mobile">
              <marquee width="60%" direction="left" height="30px">
                {{marquee_text}}
              </marquee>
            </div>
              <div class="auto_container">
                  <div class="main_banner for_reception">
                      <div class="chat_topBtn">
                          <ul>
                              <li>
                                  <a :href="base_url+'event_select/'+event_id"> Pavillion</a>
                              </li>
                              <li>
                                  <a type="button" data-toggle="modal" data-target="#aboutUs">About Us</a>
                              </li>
                              <li>
                                  <a type="button" data-toggle="modal" data-target="#companyDocuments">Documents</a>
                              </li>
                              <li>
                                  <a type="button" data-toggle="modal" data-target="#companyVideos">Videos</a>
                              </li>
                              <li>
                                  <a type="button" data-toggle="modal" data-target="#companyGallery">Gallery</a>
                              </li>
                              <li>
                                  <a type="button" data-toggle="modal" data-target="#posterBanner" style="padding:15px 10px;">Banner & Poster</a>
                              </li>
                          </ul>
                      </div>
                      <div class="my_marquee for_web">
                        <marquee width="60%" direction="left" height="30px">
                          {{marquee_text}}
                        </marquee>
                      </div>
                      <div class="my_logo_reception">
                        <div class="pavilion_gallery logo_setting">
                         <ul>
                           <li>
                            <div class="pav_galleryInner">
                             <a href="javascript:void(0);">
                               <img :src="logo" alt="No Image">
                             </a>
                            </div>
                           </li>
                         </ul>
                        </div>

                        <!-- for right logo -->

                        <div class="pv_dashboard_rightLogo">
                            <span>
                                <img :src="banner" alt="">
                            </span>
                        </div>


                        <!-- for bottom logo -->
                        <div class="pv_dashboard_BottomLogo">
                            <span>
                                <img :src="logo" alt="">
                            </span>
                        </div>
                      </div>
                  </div>
                  <div class="custom_popup" :style="(video_call)?'display:block':''">
                    <div class="custom_popup_inner">
                      <end-user-video-chat
                       v-if="video_call"
                      @closeVideoCall="video_call= false" :username="userName"
                      :room_name="roomName"/>
                    </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- banner secton end -->
      <!-- Chat Component -->
      <template v-if="company">
        <chat :company="company" @onChange="childCallBack">
        </chat>
      </template>

      <!-- Chat Component -->


      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modals ends here  -->

      <!-- Modal -->
      <div class="modal fade" id="companyVideos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Videos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row mt-3"  v-for="(item,index) in videos" :key="index">
                <iframe width="900px" height="500px"
                :src="item.name">
                </iframe>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modals ends here  -->

      <!-- Modal -->
      <div class="modal fade" id="companyGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Gallery</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="card my-3 mx-3" v-for="(item,index) in galleryImages" :key="index" style="width: 45%;">
                    <div class="card-header">
                      <h4>{{item.title}}</h4>
                    </div>
                    <div class="card-body">
                      <img class="card-img-top" :src="base_url+item.name" alt="Card image cap" style="height: 100%; width: 100%; object-fit: contain">
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modals ends here  -->

      <!-- Modal -->
      <div class="modal fade" id="companyDocuments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Documents</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="card my-3 mx-3" v-for="(item,index) in documents" :key="index" style="width: 45%;">
                    <!-- <div class="card-header">

                    </div> -->
                    <div class="card-body">
                      <img class="card-img-top" :src="base_url+item.name" alt="Card image cap" style="height: 100%; width: 100%; object-fit: contain">
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modals ends here  -->

      <!-- Modal -->
      <div class="modal fade" id="posterBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Poster & Banner</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="card my-3 mx-3">
                    <div class="card-header">
                      <h4>Banner</h4>
                    </div>
                    <div class="card-body">
                      <img class="card-img-top" :src="base_url+company.banner" alt="Card image cap" style="height: 100%; width: 100%; object-fit: contain">
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="card my-3 px-3" style="">
                    <div class="card-header">
                      <h4>Poster</h4>
                    </div>
                    <div class="card-body">
                      <img class="card-img-top" :src="base_url+company.poster" alt="Card image cap" style="height: 100%; width: 100%; object-fit: contain">
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modals ends here  -->

      <!-- About US Modal -->
      <div class="modal fade" id="aboutUs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Company Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col form-group">
                  <label for="companyName" class="col-sm-12 col-form-label company_label ">Name</label>
                  <div class="col-sm-12 company_detail ">
                    <input type="text" readonly class="form-control-plaintext" :value="company.name">
                  </div>
                </div>
                <div class="col form-group inline">
                  <label for="companyName" class="col-sm-12 company_label col-form-label">Email</label>
                  <div class="col-sm-12 company_detail">
                    <input type="text" readonly class="form-control-plaintext" :value="company.email">
                  </div>
                </div>
                <div class="col form-group inline">
                  <label for="companyName" class="col-sm-12 col-form-label company_label">Contact</label>
                  <div class="col-sm-12 company_detail">
                    <input type="text" readonly class="form-control-plaintext" :value="company.contact">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col form-group">
                  <label for="companyName" class="col-sm-12 col-form-label company_label">Address</label>
                  <div class="col-sm-12 company_detail">
                    <input type="text" readonly class="form-control-plaintext" :value="company.address">
                  </div>
                </div>
                <div class="col form-group inline">
                  <label for="companyName" class="col-sm-12 col-form-label company_label">Web URL</label>
                  <div class="col-sm-12 company_detail">
                    <a :href="company.web_url">{{company.web_url}}</a>
                  </div>
                </div>
                <!-- <div class="col form-group inline">
                  <label for="companyName" class="col-sm-12 col-form-label company_label">Total Employees</label>
                  <div class="col-sm-12 company_detail">
                    <input type="text" readonly class="form-control-plaintext" :value="company.total_employees">
                  </div>
                </div> -->
              </div>
              <div class="">

              </div>
              <div class="row form-group pl-3">
                <label for="companyDescription" class="col-sm-3 col-form-label company_label">Company Description</label>
                <div class="col-md-10 company_detail">
                  <textarea class="form-control-plaintext" name="name" rows="8" cols="80" :value="company.details"></textarea>
                  <!-- <input type="text" readonly class="form-control-plaintext" :value="company.details"> -->
                </div>
              </div>
              <div class="row social_links">
                <div class="col-md-12">
                  <ul class="list-inline pull-right">
                    <li class="list-inline-item"><a :href="fb_link"><i class="fab fa-facebook-square fa-3x"></i></a></li>
                    <li class="list-inline-item"><a :href="tw_link"><i class="fab fa-twitter-square fa-3x"></i></a></li>
                    <li class="list-inline-item"><a :href="yt_link"><i class="fab fa-youtube-square fa-3x"></i></a></li>
                    <li class="list-inline-item"><a :href="li_link"><i class="fab fa-linkedin fa-3x"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- About US Modals ends here  -->
  </div>
</template>

<script>
export default {
  name: "reception",
  props:['company_id','event_id'],
  data(){
    return {
      company:'',
      friend:'',
      fb_link:'',
      yt_link:'',
      tw_link:'',
      li_link:'',
      video_call:false,
      userName:'',
      roomName:'',
      logo:'',
      banner:'',
      offers:[],
      videos:[],
      documents:[],
      galleryImages:[],
      marquee_text:'',
      base_url:APP_URL,
    }
  },
  mounted(){
    axios.post(this.base_url+`getFriend/${this.company_id}`).then(res => {
      console.log('coompany:',res.data.data);
        this.logo = this.base_url+'public/'+res.data.data.logo
        this.banner = this.base_url+'public/'+res.data.data.banner
        this.company = res.data.data;
        this.friend = res.data.data;
        this.offers = res.data.data.offers;
        this.videos = res.data.data.videos;
        this.documents = res.data.data.documents;
        this.galleryImages = res.data.data.galleryImages;
        this.$nextTick(()=>{
          this.setMarquee();
          this.setLinks();
        });
      });
  },//mounted
  methods:{
    setLinks(){
      this.company.socialLinks.forEach((item, i) => {
        switch (item.type) {
          case 'facebook':
            this.fb_link = item.url;
            break;
          case 'twitter':
            this.tw_link = item.url;
            break;
          case 'youtube':
            this.yt_link = item.url;
            break;
          case 'linkedin':
            this.li_link = item.url;
            break;
        }
      });
    },//setLinks

    setMarquee(){
      if (this.offers.lenght != 0) {
        this.offers.forEach((item, i) => {
          this.marquee_text = this.marquee_text+' '+item.title+' : '+item.description+' - '
        });
      }else {
        this.marquee_text = 'No any Offer from this company.'
      }
    },//setMarquee

    childCallBack(message,room_name,username) {
      this.userName = username;
      this.roomName = room_name;
      this.video_call = true;
    }
  },
}
</script>

<style lang="css" scoped>
.company_label{
  background-color: #1c1c1c;
  color: #ffffff;
  border-radius: 5px;
  margin: 5px 5px;
}

.company_detail{
  background-color: #a4acb0;
  color: #1c1c1c;
  border-radius: 5px;
  margin: 5px 5px;
}

.modal-header{
  background-color: #0345fc;
  color: #ffffff;
}

.modal-body{
  background-color: #e1e6f2;
}

.modal-footer{
  background-color: #ffffff;
}

.card-header{
  text-align:center;
}


.pv_dashboard_rightLogo{
    position:absolute;
    top:126px;
    right:262px;
    display: flex;
    align-items:center;
    justify-content:center;
    background-color: rgb(255, 255, 255);
    max-width: 200px;
    width:100%;
    height:150px;
    border-width: 2px;
    border-style: none;
    border-color: rgb(0, 0, 0);
    border-radius: 4px;
}
.pv_dashboard_rightLogo span {
    display: block;
    width:100%;
    height:100%;
}
.pv_dashboard_rightLogo span img{
    display: block;
    width:100%;
    height:100%;
    object-fit:contain;
}


.pv_dashboard_BottomLogo{
    position:absolute;
    bottom:-397px;
    left:274px;
    display: flex;
    align-items:center;
    justify-content:center;
    background-color: rgb(255, 255, 255);
    max-width: 362px;
    width:100%;
    height:100px;
    border-width: 2px;
    border-style: none;
    border-color: rgb(0, 0, 0);
    border-radius: 4px;
}
.pv_dashboard_BottomLogo span {
    display: block;
    width:100%;
    height:100%;
}
.pv_dashboard_BottomLogo span img{
    display: block;
    width:100%;
    height:100%;
    object-fit:contain;
}

</style>
