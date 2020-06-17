<template>
  	<div>
		<div class="wrapper">
			<Header/>
			<CoverPic :userData="userData"/>
			<div class="main-section">
				<div class="container-fluid">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3">
								<div class="main-left-sidebar">
									<div class="user_profile">
										<ProfilePic :userData="userData"/>
										<SocialLink v-if="loginUserId == userId || userData.socialLinkStatus == 20 || ( userData.socialLinkStatus == 10 && userData.friendVisibility ==1)" :userData="userData"/>
									</div>
									<div class="suggestions full-width">
										<Friends v-if="loginUserId == userId || userData.communityStatus == 20 || ( userData.communityStatus == 10 && userData.friendVisibility ==1)"/>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="main-ws-sec">
									<ProfileTabs v-on:setActiveTab="get_tab" />
									<Posts v-if=" activeTab == 'posts' "  />
									<Jobs v-if=" activeTab == 'jobs' " />
									<Events  v-if=" activeTab == 'events' "/>
									<Questions  v-if=" activeTab == 'questions' "/>									
									<Answers  v-if=" activeTab == 'answers' "/>
									<Pages  v-if=" activeTab == 'pages' "/>
									<About  v-if=" activeTab == 'about' "  :userData = userData />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
     	</div>
     	<Footer/>
  	</div>
</template>
<script>
import Header from '@/components/user/Header';
import Footer from '@/components/user/Footer';
import CoverPic from '@/components/user/user_profile/CoverPic';
import ProfilePic from '@/components/user/user_profile/ProfilePic';
import SocialLink from '@/components/user/user_profile/SocialLink';
import Friends from '@/components/user/user_profile/Friends';
import Posts from '@/components/user/user_profile/Posts';
import About from '@/components/user/user_profile/About';
import Jobs from '@/components/user/user_profile/Jobs';
import Events from '@/components/user/user_profile/Events';
import Questions from '@/components/user/user_profile/Questions';
import Answers from '@/components/user/user_profile/Answers';
import Pages from '@/components/user/user_profile/Pages';
import ProfileTabs from '@/components/user/user_profile/ProfileTabs';
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
    name: 'ProfileDetails',
	mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        CoverPic,
        ProfilePic,
        SocialLink,
        Friends,
		Posts,
		About,
		Jobs,
		Events,
		Questions,
		Answers,
		Pages,
		ProfileTabs
	},
    data() {
   		return {
			userData: {},
			userId:"",
			loginUserId:"",
			activeTab:"posts",
    	};
	},
	mounted(){
		this.userId = window.location.href.split('/').pop();
		this.loginUserId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
		this.loadStyleSheets("user");
        this.loadJsScripts("user");
        this.get_user_info();
	},
  	methods: {
		  get_tab(activeTab){
			  this.activeTab = activeTab;
		  },
		get_user_info() {	
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
			axios({ method: "GET", url: "/api/get-user-info/"+this.userId+"/"+this.loginUserId }).then(
				result => {
					this.userData = result.data.userData;
					console.log(this.userData);
				},
				error => {
				console.error(error);
				}
			);
		},
 	}
}
</script>