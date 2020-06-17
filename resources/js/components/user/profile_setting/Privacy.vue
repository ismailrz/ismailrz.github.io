<template>
    <div>
         <form class="radio-form" @submit.prevent="change_user_Privacy">
        <div class="row">
            <div class="col-12">
            <h3>Privacy</h3>
        </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your community</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your community</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="communityStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="communityStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="communityStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                             

                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="communityStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="communityStatus == 10" style="float: right;">Friends</p>
                                <p v-if="communityStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">                
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your experiences</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your experiences</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="experienceStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="experienceStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="experienceStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="experienceStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="experienceStatus == 10" style="float: right;">Friends</p>
                                <p v-if="experienceStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your sosical links</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your social links</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="socialLinkStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="socialLinkStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="socialLinkStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="socialLinkStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="socialLinkStatus == 10" style="float: right;">Friends</p>
                                <p v-if="socialLinkStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your skills</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your skills</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="skillStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="skillStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="skillStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="skillStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="skillStatus == 10" style="float: right;">Friends</p>
                                <p v-if="skillStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your educations</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your educations</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="educationStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="educationStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="educationStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="educationStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="educationStatus == 10" style="float: right;">Friends</p>
                                <p v-if="educationStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your contacts</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your contacts</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="contactStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="contactStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="contactStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="contactStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="contactStatus == 10" style="float: right;">Friends</p>
                                <p v-if="contactStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your about yourself</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your about yourself</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="aboutYourselfStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="aboutYourselfStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="aboutYourselfStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="aboutYourselfStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="aboutYourselfStatus == 10" style="float: right;">Friends</p>
                                <p v-if="aboutYourselfStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your location</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your location</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="locationStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="locationStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="locationStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="locationStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="locationStatus == 10" style="float: right;">Friends</p>
                                <p v-if="locationStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="privabtns">
                   <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
          </form>
    </div>
                              
</template>

<script>
export default {
    name: 'Privacy',
    data() {
        return{
            communityStatus: "",
            experienceStatus: "",
            socialLinkStatus: "",
            skillStatus: "",          
            educationStatus: "",          
            aboutYourselfStatus: "",          
            locationStatus: "",          
            contactStatus: "",          
            profileStatus:{},           
        }
     },
    mounted() {
        this.get_user_privay_data();
    },
     methods: {
        get_user_privay_data() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-user-privay-data/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id }).then(
                result => {
                    this.profileStatus = result.data.userPrivacyStatus;
                    for(let i=0; i<this.profileStatus.length; i++){
                        if(this.profileStatus[i].profile_setting_id == 2)
                            this.communityStatus = this.profileStatus[i].status;   
                        else if(this.profileStatus[i].profile_setting_id == 4)
                                this.socialLinkStatus = this.profileStatus[i].status;
                        else if(this.profileStatus[i].profile_setting_id == 7)
                                this.experienceStatus = this.profileStatus[i].status;
                        else if(this.profileStatus[i].profile_setting_id == 8)
                                this.skillStatus = this.profileStatus[i].status;
                        else if(this.profileStatus[i].profile_setting_id == 6)
                                this.educationStatus = this.profileStatus[i].status;
                        else if(this.profileStatus[i].profile_setting_id == 10)
                                this.aboutYourselfStatus = this.profileStatus[i].status;
                        else if(this.profileStatus[i].profile_setting_id == 5)
                                this.contactStatus = this.profileStatus[i].status;
                        else if(this.profileStatus[i].profile_setting_id == 9)
                                this.locationStatus = this.profileStatus[i].status;

                    }
                },
                error => {
                console.error(error);
                }
            );
        },
        change_user_Privacy() {
            axios
            .put("/api/change-user-Privacy/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
                communityStatus : this.communityStatus,
                experienceStatus : this.experienceStatus,
                socialLinkStatus : this.socialLinkStatus,
                skillStatus : this.skillStatus,             
                educationStatus : this.educationStatus,             
                locationStatus : this.locationStatus,             
                contactStatus : this.contactStatus,             
                aboutYourselfStatus : this.aboutYourselfStatus,             
                email : JSON.parse(localStorage.getItem('TTNetwork.user')).email,             
                name : JSON.parse(localStorage.getItem('TTNetwork.user')).name,             
            })
            .then(res => {
               this.get_user_privay_data();
            })
            .catch(err => {
                console.log(err);
            });
        },
    }
}
</script>