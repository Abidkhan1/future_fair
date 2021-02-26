<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Company Profile</h3>
      </div>
      <form class="form-horizontal">
        <div class="card-body">
              <div class="row mt-5">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" v-model:value="name">
                    <span v-if="errors.name" style="color:red;">{{errors.name[0]}}</span>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Creation Date</label>
                    <input type="text" readonly class="form-control" id="creation_date" placeholder="" v-model:value="creation_date">
                    <span v-if="errors.creation_date" style="color:red;">{{errors.creation_date[0]}}</span>
                  </div>
                </div>

                <!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Display Name</label>
                    <input type="text" class="form-control" id="display_name" placeholder="Display Name" v-model:value="display_name">
                    <span v-if="errors.display_name" style="color:red;">{{errors.display_name[0]}}</span>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Number of Employees</label>
                    <input type="number" class="form-control" id="total_employees" placeholder="Number of Employees" v-model:value="total_employees">
                    <span v-if="errors.total_employees" style="color:red;">{{errors.total_employees[0]}}</span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" v-model:value="email">
                    <span v-if="errors.email" style="color:red;">{{errors.email[0]}}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Company Slogan</label>
                    <input type="text" class="form-control" id="slogan" placeholder="Slogan" v-model:value="slogan">
                    <span v-if="errors.slogan" style="color:red;">{{errors.slogan[0]}}</span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Website URL</label>
                    <input type="url" class="form-control" id="web_url" placeholder="URL" v-model:value="web_url">
                    <span v-if="errors.web_url" style="color:red;">{{errors.web_url[0]}}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Company Location</label>
                    <input type="text" class="form-control" id="location" placeholder="Location" v-model:value="location">
                    <span v-if="errors.location" style="color:red;">{{errors.location[0]}}</span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name External Link</label>
                    <input type="text" class="form-control" id="name_ext_link" placeholder="Name" v-model:value="name_ext_link">
                    <span v-if="errors.name_ext_link" style="color:red;">{{errors.name_ext_link[0]}}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>External Link</label>
                    <input type="url" class="form-control" id="ext_link" placeholder="http://" v-model:value="ext_link">
                    <span v-if="errors.ext_link" style="color:red;">{{errors.ext_link[0]}}</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name Complementary Link 1</label>
                    <input type="text" class="form-control" id="name_comp_link_1" placeholder="Name" v-model:value="name_comp_link_1">
                    <span v-if="errors.name_comp_link_1" style="color:red;">{{errors.name_comp_link_1[0]}}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Complementary Link 1</label>
                    <input type="url" class="form-control" id="comp_link_1" placeholder="http://" v-model:value="comp_link_1">
                    <span v-if="errors.comp_link_1" style="color:red;">{{errors.comp_link_1[0]}}</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name Complementary Link 2</label>
                    <input type="text" class="form-control" id="name_comp_link_2" placeholder="Name" v-model:value="name_comp_link_2">
                    <span v-if="errors.name_comp_link_2" style="color:red;">{{errors.name_comp_link_2[0]}}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Complementary Link 2</label>
                    <input type="url" class="form-control" id="comp_link_2" placeholder="http://" v-model:value="comp_link_2">
                    <span v-if="errors.comp_link_2" style="color:red;">{{errors.comp_link_2[0]}}</span>
                  </div>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                      </div>
                      <input type="url" class="form-control" name="facebook" v-model:value="facebook">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                      </div>
                      <input type="url" class="form-control" name="twitter" v-model:value="twitter">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-linkedin-in"></i></span>
                      </div>
                      <input type="url" class="form-control" name="linkedin" v-model:value="linkedin">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                      </div>
                      <input type="url" class="form-control" name="youtube" v-model:value="youtube">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row my-5">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea id="details" class="form-control" name="details" placeholder="Description" rows="8" cols="80" v-model:value="details"></textarea>
                    <span v-if="errors.details" style="color:red;">{{errors.details[0]}}</span>
                  </div>
                </div>
              </div>

        </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click.prevent="updateProfile">Save</button>

          <a type="button" :href="base_url+'home'" class="btn btn-danger float-right">Cancel</a>

         </div>
          <!-- /.card-footer -->
        </form>
       </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        props:['id'],
        name: "comp-profile",
        data(){
            return {
              name:'',
              details:'',
              banner:'',
              location:'',
              slogan:'',
              email:'',
              logo:'',
              url:'',
              web_url:'',
              facebook:'',
              twitter:'',
              linkedin:'',
              youtube:'',
              display_name:'',
              name_ext_link:'',
              ext_link:'',
              name_comp_link_1:'',
              comp_link_1:'',
              name_comp_link_2:'',
              comp_link_2:'',
              creation_date:'',
              total_employees:'',
              files:[],
              uploadDocuments:[],
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
            axios.get(APP_URL+`company_profile/${this.id}`).then(res=>{
              console.log('response :',res.data);
                this.name = res.data.company.name;
                this.details = res.data.company.details;
                this.display_name = res.data.company.display_name;
                this.total_employees = res.data.company.total_employees;
                this.email = res.data.company.email;
                this.slogan = res.data.company.slogan;
                this.details = res.data.company.details;
                this.web_url = res.data.company.web_url;
                this.location = res.data.company.location;
                this.name_ext_link = res.data.company.name_ext_link;
                this.ext_link = res.data.company.name_ext_link_url;
                this.name_comp_link_1 = res.data.company.name_comp_link_1;
                this.comp_link_1 = res.data.company.name_comp_link_1_url;
                this.name_comp_link_2 = res.data.company.name_comp_link_2;
                this.comp_link_2 = res.data.company.name_comp_link_2_url;
                this.facebook = res.data.company.facebook_url;
                this.twitter = res.data.company.twitter_url;
                this.linkedin = res.data.company.linkedin_url;
                this.youtube = res.data.company.youtube_url;

                var today  = new Date(res.data.company.created_at);

                this.creation_date = today.toLocaleDateString("en-US");
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{

          updateProfile(){
              axios.post(APP_URL+'comp_prof_details',{
                name:this.name,
                email:this.email,
                slogan:this.slogan,
                details:this.details,
                web_url:this.web_url,
                location:this.location,
                display_name:this.display_name,
                creation_date:this.creation_date,
                total_employees:this.total_employees,
                name_ext_link:this.name_ext_link,
                ext_link:this.ext_link,
                name_comp_link_1:this.name_comp_link_1,
                comp_link_1:this.comp_link_1,
                name_comp_link_2:this.name_comp_link_2,
                comp_link_2:this.comp_link_2,
                facebook:this.facebook,
                twitter:this.twitter,
                linkedin:this.linkedin,
                youtube:this.youtube,
              }).then(res=>{
                  console.log('response:',res.data);
                  Swal.fire(
                    'Good job!',
                    'Details updated Successfully!',
                    'success')

                  this.name = '';
                  this.email = '';
                  this.slogan = '';
                  this.details = '';
                  this.web_url = '';
                  this.location = '';
                  this.display_name = '';
                  this.creation_date = '';
                  this.total_employees = '';
                  let url = this.base_url+'company_profile';
                  setTimeout(function(){ window.location.href = url; }, 1500);

              }).catch(error=>{
                  this.errors = error.response.data.errors;
                  Swal.fire({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong!, Fill required fields',
                    })
                  console.log(error);
              })
          }
        }
    }
</script>
