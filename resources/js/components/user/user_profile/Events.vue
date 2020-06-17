<template>
    <div>
        <div class="product-feed-tab current" id="user-events">
             <EventTopbar v-on:setEvents="get_events"/> 
            <ShowEventLists :showEvents="allEvents" />
        </div>
    </div>
</template>

<script>
import ShowEventLists from '@/components/user/Event/ShowEventLists';
import EventTopbar from '@/components/user/Event/EventTopbar';
export default {
	name: 'Events',
    components: {
        ShowEventLists,
        EventTopbar,
    },
    data() {
     return { 
        userId:"",
        url: "",
        allEvents:[],
      };
  },
   mounted() {
        this.userId = window.location.href.split('/').pop();
        this.get_events();
        localStorage.setItem('checkEventUrl', JSON.stringify('user-profile'));
    },
  methods: {
       get_events(){
            this.generate_url();
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
            this.url = JSON.parse(localStorage.getItem('category'))+"/"+JSON.parse(localStorage.getItem('typeId'))+"/"+JSON.parse(localStorage.getItem('interestedGroupId'))+"/"+JSON.parse(localStorage.getItem('eventFilteringDate'))+"/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id+"/"+"my_event";
       },
  }
}
</script>