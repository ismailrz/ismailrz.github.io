<template>
  	<div>
	 <div class="wrapper">
        <Header/>
        <section class="profile-account-setting">
            <div class="container-fluid">
                <div class="account-tabs-setting">
                    <div class="row">
                        <div class="col-lg-2">
                            <EventLeftSidebar v-on:setContentType="get_events" />
                        </div>
                        <div class="col-lg-7"> 
                            <EventTopbar v-on:setEvents="get_events"/>               
                            <ShowEventLists :showEvents="allEvents" />
                        </div>
                        <div class="col-lg-3">
                            <EventRightSidebar  />
                        </div>
                    </div>
                </div>
            </div>
        </section>
     </div>
     <Footer/>	  
	</div>
</template>
<script>
import Header from '@/components/user/Header';
import Footer from '@/components/user/Footer';
import EventLeftSidebar from '@/components/user/Event/EventLeftSidebar';
import EventRightSidebar from '@/components/user/Event/EventRightSidebar';
import EventTopbar from '@/components/user/Event/EventTopbar';
import ShowEventLists from '@/components/user/Event/ShowEventLists';
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
    name: 'Events',
    mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        ShowEventLists,
        EventTopbar,
        EventLeftSidebar,
        EventRightSidebar,
    },
    data(){
        return {
            eventCategory: "",
            myEvent: null,
            url: "",
            eventTypeId: 0,
            allEvents: [],
        }
    },
    mounted() {
        localStorage.setItem('checkEventUrl', JSON.stringify('events'));
        this.loadStyleSheets("user");
        this.loadJsScripts("user");
        this.get_events();
    },
    methods: {   
        get_events(){
            this.generate_url();
            // alert(this.eventTypeId++)
            // alert(localStorage.getItem('tag'));
            // alert(localStorage.getItem('typeId'));
            // alert(localStorage.getItem('category'));
            // if(JSON.parse(localStorage.getItem('tag')) == null){
            //     localStorage.setItem("tag", JSON.stringify('events'));
            // }
            // if(JSON.parse(localStorage.getItem('category')) == null){
            //    localStorage.setItem("category", JSON.stringify('up-coming'));
            // }
            // if(JSON.parse(localStorage.getItem('typeId')) == null){
            //    localStorage.setItem("typeId", JSON.stringify(0));
            // }
            //  alert(localStorage.getItem('tag'));
            // alert(localStorage.getItem('typeId'));
            // alert(localStorage.getItem('category'));
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-events/"+this.url}).then(
                result => {                    
                    this.allEvents  = result.data.events; 
                    console.log(this.allEvents);  
                error => {
                console.error(error);
                }
            });  
        },
        generate_url(){
            if(JSON.parse(localStorage.getItem('table')) != 'events'){
                localStorage.setItem('table', JSON.stringify('events'));
                localStorage.setItem('tag', JSON.stringify('events'));
                localStorage.setItem('category', JSON.stringify('up-coming'));
                localStorage.setItem('typeId', JSON.stringify(0));
                localStorage.setItem('interestedGroupId', JSON.stringify(0));
                localStorage.setItem('eventFilteringDate', JSON.stringify(0));
            }
            this.url = JSON.parse(localStorage.getItem('category'))+"/"+JSON.parse(localStorage.getItem('typeId'))+"/"+JSON.parse(localStorage.getItem('interestedGroupId'))+"/"+JSON.parse(localStorage.getItem('eventFilteringDate'))+"/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id+"/"+JSON.parse(localStorage.getItem('tag'));
       }
      
    }
};
</script>

