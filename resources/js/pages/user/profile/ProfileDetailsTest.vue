<template>
  	<div>
        <div class="wrapper">	
            <main>
                <div class="main-section">
                    <div class="container">
                        <div class="main-section-data">
                            <div class="row">
                                <div class="col-lg-3">
                                   col-lg-3
                                </div>
                                <div class="col-lg-6">
                                    <div class="main-ws-sec">
                                        <div class="user-tab-sec rewivew">
                                                <div class="tab-feed st2 settingjb">
                                                <ul>
                                                    <li data-tab="feed-dd" class="active">
                                                        <a href="#" title="">
                                                            <img src="images/ic1.png" alt="">
                                                            <span>Feed</span>
                                                        </a>
                                                    </li>
                                                    <li data-tab="info-dd">
                                                        <a href="#" title="">
                                                            <img src="images/ic2.png" alt="">
                                                            <span>Info</span>
                                                        </a>
                                                    </li>

                                                    <li data-tab="my-bids">
                                                        <a href="#" title="">
                                                            <img src="images/ic5.png" alt="">
                                                            <span>Bids</span>
                                                        </a>
                                                   
                                                  </li>
                                                    
                                                </ul>
                                                <a class="nav-item nav-link" id="nav-acc-tab" data-toggle="tab" href="#nav-acc" role="tab" aria-controls="nav-acc" aria-selected="true"><i class="la la-cogs"></i>Account Setting</a>
                                               
                                            </div><!-- tab-feed end-->
                                        </div><!--user-tab-sec end-->
                                        <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade" id="nav-acc" role="tabpanel" aria-labelledby="nav-acc-tab">
                                            Test
                                        </div>
                                        </div>
                                        <div class="product-feed-tab current" id="feed-dd">
                                            Feed
                                        </div><!--product-feed-tab end-->

                                        <div class="product-feed-tab" id="my-bids">
                                                Bids
                                        </div><!--product-feed-tab end-->

                                        <div class="product-feed-tab" id="info-dd">
                                            informations
                                        </div><!--product-feed-tab end-->
                                    </div><!--main-ws-sec end-->
                                </div>
                                <div class="col-lg-3">
                                    col-lg-3
                                </div>
                            </div>
                        </div><!-- main-section-data end-->
                    </div> 
                </div>
            </main>

        </div><!--theme-layout end-->
  	</div>
</template>
<script>
import Header from '@/components/user/Header';
import Footer from '@/components/user/Footer';
import CoverPic from '@/components/user/user_profile/CoverPic';
import ProfilePic from '@/components/user/user_profile/ProfilePic';
import SocialLink from '@/components/user/user_profile/SocialLink';
import Friends from '@/components/user/user_profile/Friends';
import Feed from '@/components/user/user_profile/Feed';
import Info from '@/components/user/user_profile/Info';
import Jobs from '@/components/user/user_profile/Jobs';
import Bids from '@/components/user/user_profile/Bids';
import Reviews from '@/components/user/user_profile/Reviews';
import Portfolio_dd from '@/components/user/user_profile/Portfolio_dd';
import Payment from '@/components/user/user_profile/Payment';
import Profession from '@/components/user/user_profile/Profession';
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
		Feed,
		Info,
		Jobs,
		Bids,
		Reviews,
		Portfolio_dd,
		Payment,
		Profession
	},
    data() {
   		return {
			userData: {},
    	};
	},
	mounted(){
		this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
		this.loadStyleSheets("user");
        this.loadJsScripts("user");
	},
  	methods: {
	
 	}
}
</script>