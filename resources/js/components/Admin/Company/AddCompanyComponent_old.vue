<template>
    <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Add New Company</h3>
      </div>
          <!-- /.card-header -->
          <!-- form start -->
      <form class="form-horizontal">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" v-model:value="name">
                <span v-if="errors.name" style="color:red;">{{errors.name[0]}}</span>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email" v-model:value="email">
                <span v-if="errors.email" style="color:red;">{{errors.email[0]}}</span>
              </div>
              <!-- /.form-group -->
            </div>

            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Mobile#</label>
                <input type="text" class="form-control" id="contact" placeholder="03xxxxxxxxx" v-model:value="contact">
                <span v-if="errors.contact" style="color:red;">{{errors.contact[0]}}</span>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Details</label>
                <input type="text" class="form-control" id="details" placeholder="Details" v-model:value="details">
                <span v-if="errors.details" style="color:red;">{{errors.details[0]}}</span>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" id="address" placeholder="Address" v-model:value="address">
                <span v-if="errors.address" style="color:red;">{{errors.address[0]}}</span>
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" id="inputEmail3" placeholder="Password" v-model:value="password" autocomplete="off">
                  <span v-if="errors.password" style="color:red;">{{errors.password[0]}}</span>
                </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
         </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click.prevent="addCompany">Add</button>
          <a type="button" :href="base_url+'companies'" class="btn btn-danger float-right">Cancel</a>
         </div>
          <!-- /.card-footer -->
        </form>
       </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        name: "add-company",
        data(){
            return {
                name:'',
                email:'',
                address:'',
                contact:'',
                details:'',
                password:'',
                errors:[],
                base_url:APP_URL,
            }
        },
        mounted() {
        },
        methods:{
            addCompany(){
                axios.post(APP_URL+'companies',{
                    name:this.name,
                    email:this.email,
                    address:this.address,
                    contact:this.contact,
                    details:this.details,
                    password:this.password,
                }).then(res=>{
                    Swal.fire(
                      'Good job!',
                      'Company added Successfully!',
                      'success'
                    )
                    this.name = '';
                    this.email = '';
                    this.address = '';
                    this.contact = '';
                    this.details = '';
                    this.password = '';

                    let url = this.base_url+'companies';
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
