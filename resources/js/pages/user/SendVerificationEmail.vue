<template>
  <div>
	  <div class="full-body">
		<LandingPageHeader />
				<section class="block">
					<div class="container mt-2">
						<div class="row mb-0">
							<p class="display-4 text-center offset-2">Thanks for your registration</p>
						</div>
						<div class="sign-in-page" style="padding:20px;">
							<div class="signin-popup">
								<div class="signin-pop">
									<div class="row">
										<SigningPageLeftBar />
										<div class="col-lg-6">
											<div class="cmp-info">
												<p class="text-justify font-weight-bold">Your account has been created. A verification email is sent to your account.
												Please check your mail and click on the activation link.</p>

												<p>After email verification you can login here.<router-link class=" py-3 px-0 px-lg-3" to="/sign-in">Login</router-link>  </p>
											
												<!-- <p class="text-justify text-bold">	We have sent an email with a confirmation link to your email address.
												In order to complete the sign-up process, please click the confirmation link.
												If you do not receive a confirmation email, please check your spam folder.
												Also, please verify that you entered a valid email address in our sign-up form.
												If you need assistance, please contact us. </p> -->
													
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
		mounted(){
			this.loadStyleSheets("user_login");
			this.loadJsScripts("user_login");
		},
        data() {
            return {
                name: "",
              
            }
		},
		components: {
			LandingPageHeader,
			LandingPageFooter,
			SigningPageLeftBar,
		},
        methods: {		
     
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