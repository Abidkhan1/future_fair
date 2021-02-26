<template>
    <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Add New Offer</h3>
      </div>

      <form class="form-horizontal">
        <div class="card-body">
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" id="title" placeholder="Title" v-model:value="title">
                <span v-if="errors.title" style="color:red;">{{errors.title[0]}}</span>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Description</label>
                <textarea rows="10" cols="30" class="form-control" id="description" placeholder="Description" v-model:value="description">
                </textarea>
                <span v-if="errors.description" style="color:red;">{{errors.description[0]}}</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Start Time</label>
                <input type="time" class="form-control" id="start_time" v-model:value="start_time">
                <span v-if="errors.start_time" style="color:red;">{{errors.start_time[0]}}</span>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                  <label>End Time</label>
                  <input type="time" class="form-control" id="end_time" v-model:value="end_time">
                  <span v-if="errors.end_time" style="color:red;">{{errors.end_time[0]}}</span>
                </div>
            </div>
            <!-- /.col -->
          </div>
         </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click.prevent="addOffer">Add</button>
          <a type="button" :href="base_url+'offer'" class="btn btn-danger float-right">Cancel</a>
         </div>
          <!-- /.card-footer -->
        </form>
       </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        name: "add-offer",
        data(){
            return {
                title:'',
                description:'',
                start_time:'',
                end_time:'',
                errors:[],
                base_url:APP_URL,
            }
        },
        mounted() {
        },
        methods:{
            addOffer(){
                axios.post(APP_URL+'offer',{
                    title:this.title,
                    description:this.description,
                    start_time:this.start_time,
                    end_time:this.end_time,
                }).then(res=>{
                    Swal.fire(
                      'Good job!',
                      'Offer added Successfully!',
                      'success'
                    )

                    console.log('res:',res);

                    this.title = '';
                    this.description = '';

                    let url = this.base_url+'offer';
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
