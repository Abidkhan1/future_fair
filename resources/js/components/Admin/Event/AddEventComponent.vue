<template>
    <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Add New Event</h3>
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
                <label>Start Date</label>
                <input type="date" class="form-control" id="start_date" placeholder="" v-model:value="start_date">
                <span v-if="errors.start_date" style="color:red;">{{errors.start_date[0]}}</span>
              </div>

              <!-- /.form-group -->
            </div>

            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" id="description" placeholder="Description" v-model:value="description">
                <span v-if="errors.description" style="color:red;">{{errors.description[0]}}</span>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>End Date</label>
                <input type="date" class="form-control" id="end_date" placeholder="Details" v-model:value="end_date">
                <span v-if="errors.end_date" style="color:red;">{{errors.end_date[0]}}</span>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Fees</label>
                <input type="number" class="form-control" id="fees" placeholder="Fees" min="0" v-model:value="fees">
                <span v-if="errors.fees" style="color:red;">{{errors.fees[0]}}</span>
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <!-- <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" id="inputEmail3" placeholder="Password" v-model:value="password" autocomplete="off">
                  <span v-if="errors.password" style="color:red;">{{errors.password[0]}}</span>
                </div> -->
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
         </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click.prevent="addEvent">Add</button>
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
        name: "add-event",
        data(){
            return {
                name:'',
                description:'',
                fees:'',
                start_date:'',
                end_date:'',
                errors:[],
                base_url:APP_URL,
            }
        },
        mounted() {
        },
        methods:{
            addEvent(){
                axios.post(APP_URL+'events',{
                    name:this.name,
                    description:this.description,
                    start_date:this.start_date,
                    end_date:this.end_date,
                    fees:this.fees,
                }).then(res=>{
                    Swal.fire(
                      'Good job!',
                      'Event added Successfully!',
                      'success'
                    )
                    this.name = '';
                    this.description = '';
                    this.start_date = '';
                    this.end_date = '';
                    this.fees = '';

                    let url = this.base_url+'events';
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
