<template>
    <div>
        <form  @submit.prevent="create_or_update_event">                   
            <div class="cp-field mt-2">
                <h5 > Event Title</h5>
                <div class="cpp-fiel">
                    <input type="text" v-model="title" placeholder="Event title" required>
                    <i class="la la-globe"></i>
                </div>
            </div>

            <div class="cp-field col-6 mt-2">
               <h5>Event Type</h5>                 
                <select v-model="event_type_id" name="event_type_id" class="form-control" required>
                <option v-for="(type,index) in eventTypes" :key="type" v-bind:value="index">{{type}}</option>
                </select>
            </div>
            <div v-if="event_type_id != 5">
                 <div class="cp-field col-6 mt-2">
                    <h5>Venue</h5>
                    <div class="cpp-fiel">
                        <input type="text" v-model="venue" placeholder="Venue" required>
                        <i class="la la-globe"></i>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="cp-field col-6 mt-2">
                    <h5>Webinar URL</h5>
                    <div class="cpp-fiel">
                        <input type="text" v-model="webinar_url" placeholder="Webinar URL" >
                        <i class="la la-globe"></i>
                    </div>
                </div>
                <div class="cp-field col-6 mt-2">
                    <h5>Room Id</h5>
                    <div class="cpp-fiel">
                        <input type="text" v-model="room_id" placeholder="Room Id" >
                        <i class="la la-globe"></i>
                    </div>
                </div>
                <div class="cp-field col-6 mt-2">
                    <h5>Password</h5>
                    <div class="cpp-fiel">
                        <input type="text" v-model="password" placeholder="password" >
                        <i class="la la-globe"></i>
                    </div>
                </div>
            </div>
           
            <div class="cp-field col-6 mt-2">
                <h5>Contact Phone</h5>
                <div class="cpp-fiel">
                    <input type="tel" v-model="contact_phone_no" placeholder="phone Number" required>
                    <i class="la la-globe"></i>
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>Contact Email</h5>
                <div class="cpp-fiel">
                    <input type="email" v-model="contact_email" placeholder="Contact Email" required>
                    <i class="la la-globe"></i>
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>Start Date</h5>
                <div class="cpp-fiel">
                    <input type="date" v-model="start_date" required>
                    <i class="la la-globe"></i>
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>End Date (Optional)</h5>
                <div class="cpp-fiel">
                    <input type="date" v-model="end_date">
                    <i class="la la-globe"></i>
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>Start Time (Optional)</h5>
                <div class="cpp-fiel">
                    <input type="time" v-model="start_time">
                    <i class="la la-globe"></i>
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>End Time (Optional)</h5>
                <div class="cpp-fiel">
                    <input type="time" v-model="end_time">
                    <i class="la la-globe"></i>
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>Mentor</h5>
                <div class="cpp-fiel">
                      <input type="email"  v-model="mentor_email" placeholder="Enter Mentor Email">
                      <a type="button" class="btn btn-light" @click="get_mentor">Find</a>
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
                  <p v-if="!checkMentor" class="text-danger">Mentor not Found, Please enter valid email.</p>
                  <p v-if="mentorExists" class="text-danger">Mentor already added.</p>
                <div v-if="mentor.id" class="form-group">
                    <div class="row">
                      <div class="col">
                        <router-link :to="{name: 'UserProfile', params: { id: mentor.id}}">
                          <div v-if="mentor.profile_picture">
                              <img class="img-fluid" v-bind:src="'/storage/uploads/'+mentor.id+'/Users/'+mentor.profile_picture" width="100px" >              
                          </div>
                          <div v-else>
                                  <img class="img-fluid" v-bind:src="'/images/profile/profile_logo.png'" width="100px" >
                          </div>
                            <div >
                              <p>Name :  {{mentor.name}}</p>
                            </div>
                        </router-link>
                      </div>
                      <div class="col">
                            <p class="text-justify"> {{mentor.about_yourself}} &nbsp; 
                              <router-link :to="{name: 'UserProfile', params: { id: mentor.id}}">
                                  View more
                            </router-link>
                          </p>
                          <p><a class="btn btn-light" @click.prevent="add_mentor">Select</a> </p>
                      </div>
                    </div>
                </div>
            </div>
            <div class="cpp-fiel">
                <div v-if="mentorList" class="cp-field"> 
                    <p class="font-weight-bold">Mentor List</p> <br>
                      <ul>
                        <li v-for="(mentor, index) in mentorList" :key="mentor.id">
                              <router-link :to="{name: 'UserProfile', params: { id: mentor.id}}">
                                    <p > Name : &nbsp; {{mentor.name}}  &nbsp;  <a class="btn btn-light" @click="remove_mentor(index)">Remove</a> </p>
                              </router-link>
                        </li>
                      </ul>
                </div>
            </div>
            <div class="cp-field mt-2">
                <h5>Interest Group</h5>
                <div class="cpp-fiel">
                   <select v-model="model.interest_group_id" multiple name="interest_group_id[]" class="form-control">
                           <option v-for="(interestGroup, index) in interestGroups" v-bind:key="index" :value="index">{{ interestGroup }}</option>
                  </select>
                </div>
            </div>
            <div class="cp-field mt-2">
                <h5>Details</h5>
                <div class="cpp-fiel">
                    <textarea v-model="details" id="" cols="30" rows="2" required></textarea>               
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>Logo (Optional)</h5>
                  <input  type="file" class="form-control" @change="take_logo"  ref="fileInput"/>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>Banner (Optional)</h5>
                    <input  type="file" class="form-control"  @change="take_banner"  ref="fileInput"/>
            </div>
            <div class="cp-field col-6 mt-2">
              <h5>Choose Type</h5>
              <label class="radio-inline mr-5" ><input type="radio" v-model="is_public" checked value="0">Private</label>
              <label class="radio-inline" ><input type="radio" v-model="is_public" value="1">Public</label>
            </div>       
            <div class="save-stngs pd2">
                <ul>
                    <li><button type="submit">Save </button></li>                              
                    <li><router-link to="/events">
                        <button type="submit" >Cancel</button>
                    </router-link></li>                              
                </ul>
            </div>
        </form>           
    </div>
</template>
<script>
export default {
    name: 'CreateOrUpdateEvent',
    data() {
      return { 
        interestGroups: {},
        eventTypes: {},
        mentor:{},
        mentorList:[],
        mentor_email:"",
        id: "",       
        title: "",
        contact_phone_no: "",
        contact_email: "",
        start_date: "",
        end_date: "",
        start_time: "",
        end_time: "",
        venue: "",
        webinar_url: "",
        room_id: "",
        password: "",
        details: "",
        logo: "",
        banner: "",
        event_type_id: 0,
        is_public: 0,
        checkUpdateEvent: false,
        checkMentor: true,
        mentorExists: false,
        model:{
          'interest_group_id': [],
        }
     };   
   },
   mounted() {
    this.get_event_types()
    this.get_interest_groups()
  },
  methods: {
    add_mentor() {
        if(this.mentor){
            let exists = false
            for(let i=0; i<this.mentorList.length; i++){
                if(this.mentorList[i].id == this.mentor.id){
                    exists = true;
                }
            }
            if(exists == true){
                this.mentor = "";
                this.mentorExists = true;
            }else{
                this.mentorList.push(this.mentor);
                this.mentor = "";
                this.mentor_email = "";
                this.mentorExists = false;
                // console.log(this.mentorList);
            }
        }
    },
    remove_mentor(index) {
        this.mentorList.splice(index, 1);
    },
    get_mentor() {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
      axios({ method: "GET", url: "/api/get-mentor/"+this.mentor_email}).then(
        result => {
          console.log(result.data);
          if(result.data.mentor){
            this.mentor = result.data.mentor;
            this.checkMentor = true
           this.mentorExists = false;
          }else{
            this.mentor = "";
            this.checkMentor = false;
          }
        },
        error => {
          console.error(error);
        }
      );
    },
    get_interest_groups() {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
      axios({ method: "GET", url: "/api/get-interest-groups"}).then(
        result => {
          console.log(result.data);
          this.interestGroups = result.data.interestGroups;
        },
        error => {
          console.error(error);
        }
      );
    },
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
    create_or_update_event() {
      if(this.checkUpdateEvent == false){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
        axios
          .put("/api/create-event/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
            title : this.title,
            event_type_id : this.event_type_id,
            contact_phone_no : this.contact_phone_no,
            contact_email : this.contact_email,
            start_date : this.start_date,
            end_date : this.end_date,
            start_time : this.start_time,
            end_time : this.end_time,
            venue : this.venue,
            webinar_url : this.webinar_url,
            room_id : this.room_id,
            password : this.password,
            is_public : this.is_public,
            details : this.details,
            logo : this.logo,
            banner : this.banner,
            mentorList : this.mentorList,
            interest_group_id : this.model.interest_group_id,
          })
          .then(res => {
            if(res.data.response == "success"){ 
                toast.fire({icon: "info", title: res.data.message});
                 this.$router.push("/events");
              }else{
                toast.fire({icon: "info", title: res.data.message});                  
              }
          })
          .catch(err => { 
                toast.fire({icon: "info", title: "Please enter valid data."});                                           
                console.log(err);
          });
      }else if(this.checkUpdateEvent == true){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');          
          axios
            .put("/api/update-event/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
                id : this.id,
                title : this.title,
                event_type_id : this.event_type_id,
                contact_phone_no : this.contact_phone_no,
                contact_email : this.contact_email,
                start_date : this.start_date,
                end_date : this.end_date,
                start_time : this.start_time,
                end_time : this.end_time,
                venue : this.venue,
                webinar_url : this.webinar_url,
                room_id : this.room_id,
                password : this.password,
                is_public : this.is_public,
                details : this.details,
                logo : this.logo,
                banner : this.banner,
                mentorList : this.mentorList,
                interest_group_id : this.model.interest_group_id,
            })
            .then(res => {
               if(res.data.response == "success"){ 
                toast.fire({icon: "info", title: res.data.message});
                 this.$router.push("/events");   
              }else{
                toast.fire({icon: "info", title: res.data.message});                  
              }
            })
            .catch(err => {
                console.log(err);
              toast.fire({icon: "info", title: "Please enter valid data."});
            });
      }
    },
    edit_event(event) {
        this.id = event.id;
        this.title = event.title;
        this.contact_phone_no = event.contact_phone_no;
        this.contact_email = event.contact_email;
        this.start_date = event.start_date;
        this.end_date = event.end_date;
        this.start_time = event.start_time;
        this.end_time = event.end_time;
        this.venue = event.venue;
        this.webinar_url = event.webinar_url;
        this.room_id = event.room_id;
        this.password = event.password;
        this.is_public = event.is_public;
        this.details = event.details;
        this.logo = event.logo;
        this.banner = event.banner;
        this.event_type_id = event.event_type_id;
        this.mentorList = event.user;
        this.exists_event_interest_group(event.interest_groups)
        this.checkUpdateEvent = true;
    },
    take_logo(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = event => {
        this.logo = event.target.result;
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
    },
    take_banner(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = event => {
        this.banner = event.target.result;
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
    },
    exists_event_interest_group(interestGroups){
      if(interestGroups.length){
        for(let i=0; i<interestGroups.length;i++){
          this.model.interest_group_id[i]= interestGroups[i].id;
          // alert( this.model.interest_group_id);
        }
      }
    }
  }
}
</script>