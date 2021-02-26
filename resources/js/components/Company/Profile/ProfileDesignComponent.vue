<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Company Design</h3>
      </div>
      <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="card-body">
              <div class="row mt-5">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Staff</label>
                      <select class="form-control select2" v-model="staff_id" style="width: 100%;">
                        <option value="" selected disabled>Select Staff</option>
                        <option v-for="(staff,index) in staffs" :key="index" :value="staff.id">{{staff.name}}</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Template</label>
                      <select class="form-control select2" style="width: 100%;" v-model="template_id" @change="templateChanged">
                        <option value="" selected disabled>Select Template</option>
                        <option value="1">Template 1</option>
                        <!-- <option v-for="(template,index) in templates" :key="index" :value="template.id">{{template.name}}</option> -->
                      </select>
                    </div>
                </div>
            </div>

            <div class="row mt-5" v-if="selected_template">
              <img :src="base_url+'images/Templates/'+selected_template" alt="" style="height: 600px; width: 100%; object-fit: contain">
            </div>

        </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click="saveDesign" :disabled="!(staff_id && template_id)">Save</button>
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
        props:['id','csrf'],
        name: "comp-design",
        data(){
            return {
              name:'',
              details:'',
              selected_template:'Template1.PNG',
              template_id:'',
              staff_id:'',
              staffs:[],
              templates:[],
              url:'',
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
          console.log('hello');
            axios.get(APP_URL+`get_design`).then(res=>{
              console.log('response :',res.data);
              this.staffs = res.data.staffs;
              this.templates = res.data.templates;
              this.staff_id =  res.data.slot_design.staff_id;
              this.template_id = res.data.slot_design.template_id;

              let self = this;
              Vue.nextTick(function () {
                self.templateChanged();
              });

            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },

        methods:{
          templateChanged(){
            console.log('hello change');
             this.templates.find(x=>{
              if(x.id===this.template_id){
                this.selected_template = x.path;
              }
            });
          },

          saveDesign(){
            axios.post(APP_URL+'save_design',{
              staff_id:this.staff_id,
              template_id:this.template_id,
            })
            .then(response=>{
              console.log('res:',response.data);
              Swal.fire(
                'Good job!',
                'Design Saved Successfully!',
                'success')

                let url = this.base_url+'design';
                setTimeout(function(){ window.location.href = url; }, 1500);

            }).catch(err=>{
              console.log('err:',err);
            })
          }//saveDesign
        }
    }
</script>
