<template>
  <div>
	    <div class="full-body">
		<LandingPageHeader />
				<section class="block">
					<div class="container mt-2">
						<div v-if="active" class="row mb-0">
							<p class="display-4 text-center offset-2">Thanks for activated your account.</p>
						</div>
						<div class="sign-in-page" style="padding:20px;">
							<div class="signin-popup">
								<div class="signin-pop">
									<div class="row">
										<SigningPageLeftBar />
										<div class="col-lg-6">
											<div v-if="active" class="cmp-info">
												<div v-if="role_id == 10 && status ==10"  class="col-lg-12 no-pdd">
													<p class="text-justify text-bold">Your account has been verified.Please login first!</p>
													<div class="checky-sec st2">
														<p> <router-link class=" py-3 px-0 px-lg-3" to="/sign-in">Login now!</router-link></p> 
													</div>
												</div>
												
											</div><!--cmp-info end-->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<LandingPageFooter />
		</div>	
	</div>
</template>

<script>
import SigningPageLeftBar from '@/components/user/SigningPageLeftBar';
import LandingPageHeader from '@/components/user/LandingPageHeader';
import LandingPageFooter from '@/components/user/LandingPageFooter';
import ScriptLoader from '@/mixins/ScriptLoader';
import axios from "axios";
export default {
	mixins: [ScriptLoader],
		components: {
			LandingPageHeader,
			LandingPageFooter,
			SigningPageLeftBar,
		},
        data() {
            return {
				role_id:"",
				status:"",
                active: false
            }
		},
	 mounted() {
		 this.loadStyleSheets("user_login");
		this.loadJsScripts("user_login");
   	 	this.active_user_account();
 	 },
        methods: {
			active_user_account() {
				let url = window.location.href.split('/');
				let token = url[5];
				let userId = url[4];
				// let token = window.location.href.split('/').pop();
				console.log(token);
				axios.put("/api/active-user-account", {userId,token}).then(response => {					
					this.active = true;
					let user = response.data.user;
					this.role_id = user.role_id;
					this.status = user.status;
				}).catch((error) => {
						console.log(error);
						 if(error.response.data.success == false){
                            this.active = false;
						}
				});
    		},		
     
        }
    }
</script>
<style scoped>
.full-body {
  background-color: #fff !important;
  height: fit-content;
}
.clear {
  clear: both;
}
</style>