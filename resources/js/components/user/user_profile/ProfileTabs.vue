<template>
    <div>
      <div class="post-topbar mt-2 ">
         <div class="tab-feed st2 settingjb my-0">
            <ul>
                <li data-tab="user-posts" class="active">
                    <a href="javascript:void(0);" title=""  @click="set_active_tab('posts')">
                        <img src="/images/ic1.png" alt="">
                        <span>Posts</span>
                    </a>
                </li>
                
                <li data-tab="user-jobs">
                    <a href="javascript:void(0);" title="" @click="set_active_tab('jobs')">
                        <img src="/images/ic4.png" alt="">
                        <span>Jobs</span>
                    </a>
                </li>
                <li data-tab="user-events">
                    <a href="javascript:void(0);" title="" @click="set_active_tab('events')">
                        <img src="/images/ic5.png" alt="">
                        <span>Events</span>
                    </a>
                </li>
                <li data-tab="user-questions">
                    <a href="javascript:void(0);" title="" @click="set_active_tab('questions')">
                        <img src="/images/review.png" alt="">
                        <span>Questions</span>
                    </a>
                </li>
                <li data-tab="user-answers">
                    <a href="javascript:void(0);" title="" @click="set_active_tab('answers')">
                        <img src="/images/ic6.png" alt="">
                        <span>Answers</span>
                    </a>
                </li> 
                <li data-tab="user-pages">
                    <a href="javascript:void(0);" title="" @click="set_active_tab('pages')">
                        <img src="/images/ic3.png" alt="">
                        <span>Pages</span>
                    </a>
                </li>
                <li data-tab="user-about">
                    <a href="javascript:void(0);" title="" @click="set_active_tab('about')">
                        <img src="/images/ic2.png" alt="">
                        <span>About</span>
                    </a>
                </li>
                <li v-if="userId == userData.id">
                    <router-link :to="{name: 'ProfileSetting', params: { id: userData.id}}">
                        <img src="/images/setting_icon.png" alt="">
                        <span>Setting </span>        
                    </router-link> 
                </li>                               
            </ul>
            
        </div><!-- tab-feed end-->
    </div><!--user-tab-sec end-->        
    </div>
</template>
<script>
    export default {
        name: 'ProfileTabs',
        data() {
            return { 
               userData:{},
               userId:"",
                };
         },
         mounted(){
             this.userId = window.location.href.split('/').pop();
             this.userData =JSON.parse(localStorage.getItem('TTNetwork.user'));
         },	  
        methods:{
            set_active_tab(activeTab){
                  this.$emit('setActiveTab',activeTab);
            },
        }
    }
</script>
