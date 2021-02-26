<template>
  <div class="main_container padding_topTwo"   style="padding-top: 0px;">
    <!-- banner secton start -->
    <div class="banner">
      <figure><img :src="base_url+'future_html/images/home_banner_final.jpg'" alt="banner"></figure>
      <div class="banner_content">
        <div class="auto_container">
          <div class="main_banner">
            <div class="top_logos">
              <ul>
                <li>
                  <a href="javascript:void(0);">
                    <img :src="base_url+'future_html/images/future_fair.png'" alt="logo">
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <img
                    :src="base_url+'future_html/images/steph_logo.png'" alt="logo">
                  </a>
                </li>
              </ul>
            </div>
            <div class="profile">
              <div class="profile_main">
                <div class="profile_content">
                  <div class="profile_left">
                    <ul>
                      <template v-if="!changePassword">
                        <li>
                          <div class="profile_data">
                            <title>Name:</title>
                            <input :class="(!updateProfile)?'form-control-plaintext':'form-control'" type="text" name="" v-model:value="name">
                            <span v-if="errors.name" style="color:red;">{{errors.name[0]}}</span>
                            <!-- <span>Test</span> -->
                          </div>
                        </li>
                        <li>
                          <div class="profile_data">
                            <title>Email:</title>
                            <input :class="(!updateProfile)?'form-control-plaintext':'form-control'" type="text" name="" v-model:value="email">
                            <span v-if="errors.email" style="color:red;">{{errors.email[0]}}</span>
                            <!-- <span>testuser@gmail.com</span> -->
                          </div>
                        </li>
                        <li>
                          <div class="profile_data">
                            <title>Address:</title>
                            <input :class="(!updateProfile)?'form-control-plaintext':'form-control'" type="text" name="" v-model:value="address">
                            <span v-if="errors.address" style="color:red;">{{errors.address[0]}}</span>
                            <!-- <span>Model Town Lahore</span> -->
                          </div>
                        </li>
                        <li>
                          <div class="profile_data">
                            <title>Phone No:</title>
                            <input :class="(!updateProfile)?'form-control-plaintext':'form-control'" type="text" name="" v-model:value="contact">
                            <span v-if="errors.contact" style="color:red;">{{errors.contact[0]}}</span>
                            <!-- <span>03213498127</span> -->
                          </div>
                        </li>
                        <li>
                          <div class="profile_data">
                            <title>Occupation:</title>
                            <input :class="(!updateProfile)?'form-control-plaintext':'form-control'" type="text" name="" v-model:value="occupation">
                            <span v-if="errors.occupation" style="color:red;">{{errors.occupation[0]}}</span>
                            <!-- <span>Student</span> -->
                          </div>
                        </li>
                        <li>
                          <div class="profile_data">
                            <title>Industry:</title>
                            <input :class="(!updateProfile)?'form-control-plaintext':'form-control'" type="text" name="" v-model:value="industry">
                            <span v-if="errors.industry" style="color:red;">{{errors.industry[0]}}</span>
                            <!-- <span>Information Technology</span> -->
                          </div>
                        </li>
                        <li>
                          <div class="profile_data">
                            <title>Details:</title>
                            <input :class="(!updateProfile)?'form-control-plaintext':'form-control'" type="text" name="" v-model:value="details">
                            <span v-if="errors.details" style="color:red;">{{errors.details[0]}}</span>
                            <!-- <span>Information Technology</span> -->
                          </div>
                        </li>
                      </template>

                      <template v-else>
                        <li>
                          <div class="profile_data">
                            <title>Passwod:</title>
                            <input class="form-control" type="password" name="" v-model:value="password">
                            <span v-if="errors.password" style="color:red;">{{errors.password[0]}}</span>
                          </div>
                        </li>
                        <li>
                          <div class="profile_data">
                            <title>Confirm Passwod:</title>
                            <input class="form-control" type="password" name="" v-model:value="confirm_password">
                            <span v-if="mismatch_error" style="color:red;">Mis match password</span>
                          </div>
                        </li>
                      </template>


                    </ul>
                  </div>
                  <div class="profile_right">
                    <form :action="base_url+'profile_image'" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="_token" v-bind:value="csrf">
                      <input type="hidden" name="id" v-bind:value="user.id">
                    <div class="profile_pic">
                      <span><img :src="profile_image" alt="profile img"></span>
                      <small>
                        <input type="file"
                        name="profile_image" accept="image/png, image/jpeg" @change="imageUpload">
                        <b>Upload Profile Photo</b>
                      </small>
                      <button class="btn btn-sm btn-primary" type="submit" name="button" v-if="changePhoto">
                        Update
                      </button>
                    </div>

                    </form>
                    <div class="profile_action">
                      <ul>
                        <li>
                          <div class="custom_btnTwo">
                            <a :style="(updateProfile)?'background-color:green;':''" @click="changeProfile" href="javascript:void(0);">
                              {{(updateProfile)?'Save':'Edit'}} Details
                            </a>
                          </div>
                        </li>
                        <li>
                          <div class="custom_btnTwo">
                            <a :style="(changePassword)?'background-color:green;':''" @click="updatePassword" href="javascript:void(0);">
                              {{(changePassword)?'Save':'Edit'}} Password
                            </a>
                          </div>
                        </li>
                        <!-- <li>
                          <div class="custom_btnTwo">
                            <a href="#">Deactivate Account</a>
                          </div>
                        </li> -->
                      </ul>
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
import Swal from 'sweetalert2'
export default {

  props:['id','csrf'],
  name: "pavillion",
  data(){
    return {
      user:'',
      updateProfile:false,
      mismatch_error:false,
      changePassword:false,
      changePhoto:false,
      base_url:APP_URL,
      name : '',
      email : '',
      contact : '',
      address : '',
      details : '',
      occupation : '',
      industry : '',
      password : '',
      profile_image : '',
      confirm_password : '',
      errors : [],
    }
  },
  mounted(){
    console.log('hello profile');
    axios.get(APP_URL+`user_data/${this.id}`)
    .then(res=>{
      console.log('res:',res.data);
      this.user = res.data.user;
      this.id = res.data.user.id;
      this.name = res.data.user.name;
      this.email = res.data.user.email;
      this.contact = res.data.user.contact;
      this.address = res.data.user.address;
      this.details = res.data.user.details;
      this.occupation = res.data.user.occupation;
      this.industry = res.data.user.industry;
      this.profile_image = this.base_url+res.data.user.profile_image;
    })
    .catch(err=>{
      console.log('error:',err);
    })
  },//mounted

  methods:{
    imageUpload(event){
      this.changePhoto = true;
      const file = event.target.files[0];
      this.profile_image = URL.createObjectURL(file);
    },//imageUpload
    updatePassword(){
      this.updateProfile = false;
      if (!this.changePassword) {
        this.changePassword = true;
      }
      else if (this.password !== this.confirm_password) {
        this.mismatch_error = true;
        this.errors = [];
      }else {
        this.mismatch_error = false;
        axios.post(APP_URL+'change_password',{
          'id' : this.user.id,
          'password' : this.password,
        })
        .then(response => {
          console.log('response:',response.data);
          Swal.fire('Good job!','Password updated Successfully!','success');

          this.changePassword = false;
        })
        .catch(error => {
          this.errors = [];
          this.errors = error.response.data.errors
          console.log('error:',error.response.data.errors);
        })
      }
    },//updatePassword

    changeProfile(){
      this.changePassword = false;
      if (!this.updateProfile) {
        this.updateProfile = true;
      }else {
        console.log('now make axios call to save data');
        axios.post(APP_URL+'save_user_data',{
          'id' : this.user.id,
          'name' : this.name,
          'email' : this.email,
          'contact' : this.contact,
          'address' : this.address,
          'details' : this.details,
          'occupation' : this.occupation,
          'industry' : this.industry,
        })
        .then(response => {
          console.log('response:',response.data);
          Swal.fire('Good job!','Profile updated Successfully!','success');

          this.updateProfile = false;
        })
        .catch(error => {
          this.errors = error.response.data.errors
          console.log('error:',error.response.data.errors);
        })
      }
    },//changeProfile
  },
}
</script>

<style lang="css" scoped>
.profile_data > title {
  padding-top: 10px;
}
</style>
