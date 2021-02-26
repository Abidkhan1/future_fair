<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Edit Company</h3>
      </div>
      <form class="form-horizontal">
        <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" v-model:value="name">
                    <span v-if="errors.name" style="color:red;">{{errors.name[0]}}</span>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Email" v-model:value="email">
                    <span v-if="errors.email" style="color:red;">{{errors.email[0]}}</span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile#</label>
                    <input type="text" class="form-control" id="contact" placeholder="03xxxxxxxxx" v-model:value="contact">
                    <span v-if="errors.contact" style="color:red;">{{errors.contact[0]}}</span>
                  </div>
                  <div class="form-group">
                    <label>CNIC</label>
                    <input type="text" class="form-control" id="cnic" placeholder="CNIC" v-model:value="cnic">
                    <span v-if="errors.cnic" style="color:red;">{{errors.cnic[0]}}</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Address" v-model:value="address">
                    <span v-if="errors.address" style="color:red;">{{errors.address[0]}}</span>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="inputEmail3" placeholder="Password" v-model:value="password" autocomplete="off">
                      <span v-if="errors.password" style="color:red;">{{errors.password[0]}}</span>
                    </div>
                </div>
              </div>
             </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click.prevent="updateStaff">Save</button>

          <a type="button" :href="base_url+'staff'" class="btn btn-danger float-right">Cancel</a>

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
        name: "edit-driver",
        data(){
            return {
              name:'',
              email:'',
              address:'',
              contact:'',
              cnic:'',
              password:'',
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
            axios.get(APP_URL+`staff/${this.id}`).then(res=>{
              console.log('response :',res.data);
                this.name = res.data.staff.name;
                this.cnic = res.data.staff.cnic;
                this.address = res.data.staff.address;
                this.contact = res.data.staff.contact;
                this.email = res.data.staff.email;
                this.password = res.data.staff.password;
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{
            updateStaff(){
                axios.put(APP_URL+'staff/'+this.id,{
                  name:this.name,
                  email:this.email,
                  address:this.address,
                  contact:this.contact,
                  cnic:this.cnic,
                  password:this.password,
                }).then(res=>{
                    console.log('response:',res.data);
                    Swal.fire(
                      'Good job!',
                      'Staff updated Successfully!',
                      'success'
                    )
                    this.name = '';
                    this.email = '';
                    this.address = '';
                    this.contact = '';
                    this.cnic = '';
                    this.password = '';
                    let url = this.base_url+'staff';
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
