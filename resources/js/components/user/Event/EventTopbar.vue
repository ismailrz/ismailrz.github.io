<template>
    <div>      
         <div class="post-topbar">
           <div class="row">
                  <button type="button" class="btn btn-sm btn-outline-primary mr-1" :class="{'active': activeUpComing}" id="up-coming" @click="set_event_category('up-coming', eventTypeId,interestedGroupId,date)" >Upcoming</button>
                  <button type="button" class="btn btn-sm btn-outline-primary mr-1" :class="{'active': activeArchived}" id="archived" @click="set_event_category('archived',eventTypeId,interestedGroupId,date)" >Archived</button>
                  <button type="button" class="btn btn-sm btn-outline-primary mr-1" :class="{'active': activAllEvent}" id="all-events" @click="set_event_category('all-events',eventTypeId,interestedGroupId,date)" >All Events</button>
                   <select   @change="set_event_category(storeCategory,eventTypeId,interestedGroupId,date)" v-model="eventTypeId" class="btn btn-sm btn-outline-primary ">
                      <option v-for="(type,index) in eventTypes" :key="type" v-bind:value="index">
                        {{ type}}
                      </option>
                  </select>
                   <select  @change="set_event_category(storeCategory,eventTypeId,interestedGroupId,date)" v-model="interestedGroupId" class="btn btn-sm btn-outline-primary ">
                      <option v-for="(interestGroup,index) in interestGroups" :key="interestGroup" v-bind:value="index">
                        {{ interestGroup}} 
                      </option>
                  </select>
                  <div  >
                        <input type="date" class="form-control" v-model="date" @change="set_event_category(storeCategory,eventTypeId,interestedGroupId,date)" >
                  </div>
                  
                  <div class="col float-right">
                  <router-link to="/new-event"><button class="btn btn-sm btn-primary float-right">New Event</button> </router-link> 
                  </div>
            </div>
         </div>
    </div>
</template>
<script>
 export default {
  name: 'EventTopbar',
  data(){
    return{
      eventTypes: [],
      interestGroups: [],
      eventTypeId: 0,
      interestedGroupId: 0,
      date: 0,
      activeUpComing: false,
      storeCategory: "up-coming",
      activeArchived: false,
      activAllEvent: false,
    }
  },
  mounted(){
    this.get_event_types();
    this.get_interest_groups();
    if(JSON.parse(localStorage.getItem('typeId')) != 0 && JSON.parse(localStorage.getItem('typeId')) !=null){
       this.eventTypeId = JSON.parse(localStorage.getItem('typeId'));
    }
    if(JSON.parse(localStorage.getItem('interestedGroupId')) != 0 && JSON.parse(localStorage.getItem('interestedGroupId')) !=null){
       this.interestedGroupId = JSON.parse(localStorage.getItem('interestedGroupId'));
    }
      if(JSON.parse(localStorage.getItem('category')) == 'archived'){
        this.activeArchived = true;
      }else if(JSON.parse(localStorage.getItem('category')) == 'all-events'){
        this.activAllEvent = true;
    }else{
        this.activeUpComing = true;
      }
  },
  methods:{
        get_event_types() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-event-types"}).then(
              result => {
                console.log(result.data.eventTypes);
                this.eventTypes = result.data.eventTypes;
              },
              error => {
                console.error(error);
              }
            );
        },
      	get_interest_groups() {	
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-interest-groups" }).then(
                result => {
                  this.interestGroups = result.data.interestGroups;
                  console.log(this.interestGroups);   
                },
                error => {
                console.error(error);
                }
            );
        },
        set_event_category(eventCategory, eventTypeId,interestedGroupId,date) {
          localStorage.setItem('category', JSON.stringify(eventCategory));
          localStorage.setItem('typeId', JSON.stringify(eventTypeId));
          localStorage.setItem('interestedGroupId', JSON.stringify(interestedGroupId));
          localStorage.setItem('eventFilteringDate', JSON.stringify(date));
          if(JSON.parse(localStorage.getItem('category')) == "up-coming"){
               this.storeCategory = "up-coming";
               this.activeUpComing = true;
               this.activeArchived = false;
               this.activAllEvent = false;
          }else if(JSON.parse(localStorage.getItem('category')) == "archived"){
               this.storeCategory = "archived";
               this.activeUpComing = false;
               this.activeArchived = true;
               this.activAllEvent = false;
          }else if(JSON.parse(localStorage.getItem('category')) == "all-events"){
               this.storeCategory = "all-events";
               this.activeUpComing = false;
               this.activeArchived = false;
               this.activAllEvent = true
          }
          if(JSON.parse(localStorage.getItem('checkEventUrl')) == 'event-details' ){
              this.$router.push("/events").catch(err => {});
          }else{
              this.$emit('setEvents');
          }            
        },
  },
}
</script>
