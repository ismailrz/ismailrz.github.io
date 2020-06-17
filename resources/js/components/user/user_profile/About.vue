<template>
    <div >
		<div class="product-feed-tab current" id="user-about">
			<div v-if="loginUserId == userId || userData.contactStatus == 20 || ( userData.contactStatus == 10 && userData.friendVisibility ==1)" class="user-profile-ov">
				<h3>Contact</h3>
				<p> <b>Email: </b> {{userData.email}} </p>	 
				<p><b>Phone:</b>{{userData.phone}} </p>	  			  
			</div>		
			<div v-if="loginUserId == userId || userData.aboutYourselfStatus == 20 || ( userData.aboutYourselfStatus == 10 && userData.friendVisibility ==1) " class="user-profile-ov">
				<h3>About Yourself<a href="javascript:void(0);" v-if="userId == loginUserId" title="" @click="modal_open('aboutYourself')" class="overview-open">
					<i class="fa fa-plus-square"></i></a></h3>
				<p class="text-justify">{{userData.about_yourself}}</p>
			</div>
			<UserExperiences v-if="loginUserId == userId || userData.experienceStatus  == 20 || ( userData.experienceStatus == 10 && userData.friendVisibility ==1)"/>
			<UserEducations v-if="loginUserId == userId || userData.educationStatus == 20 || ( userData.educationStatus == 10 && userData.friendVisibility ==1)"/>
			<UserSkills v-if="loginUserId == userId || userData.skillStatus == 20 || ( userData.skillStatus == 10 && userData.friendVisibility ==1)"/>
			<div v-if="loginUserId == userId || userData.locationStatus == 20 || ( userData.locationStatus == 10 && userData.friendVisibility ==1)" class="user-profile-ov" >
				<h3>Location<a href="javascript:void(0);"  v-if="userId == loginUserId"  @click="modal_open('location')" title="" class="lct-box-open"><i class="fa fa-plus-square"></i></a></h3>
				<div v-if="userData.country">
					<h4 class="text-bold" >Country :</h4>{{userData.country.name}}
					<p>State: {{userData.state.name}}, City : {{userData.city.name}}, Post Code: {{userData.post_code}} </p>
					<p class="text-bold">Address: </p>{{userData.address}}
				</div>
			</div>			
			<div class="overview-box" id="overview-box">
				<div class="overview-edit">
					<h3>About Yourself</h3>
					<span>max 5000 character</span>				
					<form  @submit.prevent="update_about_your_self">
							{{userData.about_yourself}}
						<textarea v-model="about_yourself"  cols="30" rows="10" required></textarea>
						<button type="submit" class="save">Save</button>					
					</form>
					<a href="javascript:void(0);" title="" @click="modal_close('aboutYourself')" class="close-box"><i class="fas fa-times"></i></a>
				</div>
			</div>
			<div class="overview-box" id="location-box">
				<div class="overview-edit">
					<h3>Location</h3>
					<form @submit.prevent="update_location">
						<div class="datefm">
						<select v-model="country_id" name="country_id"  @change="load_states" required>
							<option v-for="(country, index) in countries" v-bind:key="index" :value="index">{{ country }}</option>
						</select> 
							<i class="fa fa-globe"></i>
						</div>					
						<div class="datefm">
							<select v-model="state_id" name="state_id"  @change="load_city" required>
								<option  v-for="(state, index) in states" v-bind:key="index" :value="index" >{{state }}</option>
							</select>
							<i class="fa fa-map-marker"></i>
						</div>
						<div class="datefm">
							<select v-model="city_id" name="city_id" required>
								<option v-for="(city, index) in cities" v-bind:key="index" :value="index">{{ city }}</option>
							</select>
							<i class="fa fa-map-marker"></i>
						</div>
						<div class="datefm">
							<h5>Post Code</h5>
							<div class="cpp-fiel">
								<input type="text" v-model="post_code" placeholder="Post Code" required>
								<i class="la la-globe"></i>
							</div>
						</div>
						<button type="submit" class="save">Save</button>					
					</form>
					<a href="javascript:void(0);" title=""  @click="modal_close('location')" class="close-box"><i class="fas fa-times"></i></a>
				</div>
			</div>	
		</div>	 
    </div>
</template>
<script>
import UserEducations from '@/components/user/profile_setting/Education';
import UserExperiences from '@/components/user/profile_setting/Experience';
import UserSkills from '@/components/user/profile_setting/Skill';
export default {
	name: 'About',
	 components: {
        UserEducations,      
        UserExperiences,      
        UserSkills,      
	},
    data() {
		return { 
			allSkill:{},
			countries: {},
			states: {},
			cities: {},		
			country_id : 0,
			state_id : 0,
			city_id : 0,
			post_code :"",
			about_yourself :"",		
			userId: "",
			loginUserId: "",
    	};   
	  },
	  props: {
		userData:{},
	},
 	mounted() {
		this.userId = window.location.href.split('/').pop();
		this.loginUserId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
		this.load_countries();
 	 },
  	methods: {
		modal_open(modalName){
			if(modalName == "aboutYourself"){
				$(".overview-open").on("click", function(){
					$("#overview-box").addClass("open");
					$(".wrapper").addClass("overlay");
					return false;
				});
			}else{
				 $(".lct-box-open").on("click", function(){
					$("#location-box").addClass("open");
					$(".wrapper").addClass("overlay");
					return false;
				});
			}
			
		},
		modal_close(modalName){
			if(modalName == "aboutYourself"){
				 $(".close-box").on("click", function(){
					$("#overview-box").removeClass("open");
					$(".wrapper").removeClass("overlay");
					return false;
				});
			}else{
				 $(".close-box").on("click", function(){
					$("#location-box").removeClass("open");
					$(".wrapper").removeClass("overlay");
					return false;
				});
			}
			
		},
		update_location() {
			axios
			.put("/api/update-Location/"+this.userId, {
				country_id : this.country_id,
				state_id : this.state_id,
				city_id : this.city_id,
				post_code : this.post_code,
			})
			.then(res => {
				if(res.data.response = "success"){
				    toast.fire({icon: "info", title: res.data.message});
				}else{
				    toast.fire({icon: "info", title: res.data.message});
				}
				this.get_user_info();
			})
			.catch(err => {
				console.log(err);
			});
		},
		update_about_your_self() {
			axios
			.put("/api/update-about-your-self/"+this.userId, {
				about_yourself : this.about_yourself,
			})
			.then(res => {
				if(res.data.response = "success"){
					toast.fire({icon: "info", title: res.data.message});
               		localStorage.setItem("TTNetwork.user", JSON.stringify(res.data.user));					
					this.about_yourself = "";				
				}else{
					toast.fire({icon: "info", title: "Please insert valid data"});
				}
				this.get_user_info();
			})
			.catch(err => {
				console.log(err);
			});
		},
		load_countries() {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
			axios({ method: "GET", url: "/api/get-countries"}).then(
				result => {
				this.countries = result.data.countries;
				console.log(this.countries);
				},
				error => {
				console.error(error);
				}
			);
		},
		load_states() {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
			axios({ method: "GET", url: "/api/get-states/"+ this.country_id }).then(
				result => {
				console.log(result.data);
				this.states = result.data;
				this.cities = null;				
				},
				error => {
				console.error(error);
				}
			);
		},
		load_city() {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
			axios({ method: "GET", url: "/api/get-cities/"+this.state_id}).then(
				result => {
				console.log(result.data);
				this.cities = result.data;				
				},
				error => {
				console.error(error);
				}
			);		
		},
	}
}
</script>