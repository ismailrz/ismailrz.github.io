<template>
    <div> 
      <div class="right-sidebar">
          <div class="widget widget-jobs">
            <div class="sd-title">
              <h3>Popular Events</h3>
              <i class="la la-ellipsis-v"></i>
            </div>
            <div class="jobs-list">
              <table class="job-info table table-hover" v-for="event in popularEvents" :key="event.id">
                  <tbody>
                         <tr>
                              <router-link  :to="'/event-details/'+event.id">
                                  <div class="job-details">
                                    <h3>{{event.title}}</h3>
                                    <p v-if="event.venue"><i class="fa fa-map-marker mr-1"></i>{{event.venue}}</p>
                                  </div>
                              </router-link>
                                <div class="hr-rate">
                                  <div class="ml-5">
                                      <span class="badge  badge-light">{{event.start_date}}</span>
                                  </div>
                                </div>
                        </tr>
                   </tbody>
              </table><!--job-info end-->
             
            </div><!--events-list end-->
          </div><!--widget-events end-->
          <div class="widget widget-jobs">
            <div class="sd-title">
              <h3>Most Viewed This Week</h3>
              <i class="la la-ellipsis-v"></i>
            </div>
            <div class="jobs-list">
              <div class="job-info">
                <div class="job-details">
                  <h3>Senior Product Designer</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                </div>
                <div class="hr-rate">
                  <span>$25/hr</span>
                </div>
              </div><!--job-info end-->
              <div class="job-info">
                <div class="job-details">
                  <h3>Senior UI / UX Designer</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                </div>
                <div class="hr-rate">
                  <span>$25/hr</span>
                </div>
              </div><!--job-info end-->
              <div class="job-info">
                <div class="job-details">
                  <h3>Junior Seo Designer</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                </div>
                <div class="hr-rate">
                  <span>$25/hr</span>
                </div>
              </div><!--job-info end-->
            </div><!--jobs-list end-->
          </div><!--widget-jobs end-->
      </div><!--right-sidebar end-->
    </div>
</template>
<script>
export default {
    name: 'EventRightSidebar',
    data() {
        return { 
          popularEvents: {},
      };   
     },
    mounted() {
        this.get_popular_events();
    },
    methods:{
       get_popular_events(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-popular-events/"}).then(
                result => {                    
                    this.popularEvents  = result.data.popularEvents; 
                    console.log(this.popularEvents);                  
                error => {
                console.error(error);
                }
            });  
        },
    }
}
</script>