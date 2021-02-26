<template>
  <div class="mx-auto" style="">
    <label for="staticEmail" class="col-sm-12 col-form-label"><h3>Enter Pavillion</h3></label>
    <select class="form-control" @change="eventSelected" v-model="event_id">
      <option disabled selected>Select Event</option>
      <option v-for="event in events" :key="event.id" :value="event.id">{{event.name}}</option>
    </select>
  </div>
</template>

<script>
export default {
  props:['events'],
  name: "events-select",
  data(){
    return {
      event_id:'',
      base_url:APP_URL,
    }
  },
  mounted(){
    console.log('hello',this.events);
  },//mounted
  methods:{
    eventSelected(){
      console.log('eventSelected',this.event_id);
      let url = this.base_url+`event_select/${this.event_id}`;
      setTimeout(function(){ window.location.href = url; }, 500);
    },//eventSelected
  },
}
</script>

<style lang="css" scoped>
</style>
