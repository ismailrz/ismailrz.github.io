<template>
    <div> 
      <div class="right-sidebar">
          <div class="widget widget-jobs">
            <div class="sd-title">
              <h3>Top Jobs</h3>
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
              <div class="job-info">
                <div class="job-details">
                  <h3>Senior PHP Designer</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                </div>
                <div class="hr-rate">
                  <span>$25/hr</span>
                </div>
              </div><!--job-info end-->
              <div class="job-info">
                <div class="job-details">
                  <h3>Senior Developer Designer</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                </div>
                <div class="hr-rate">
                  <span>$25/hr</span>
                </div>
              </div><!--job-info end-->
            </div><!--jobs-list end-->
          </div><!--widget-jobs end-->
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
    name: 'JobRightSidebar',
    data() {
      return { 
        name: "",
        url: null,
        events: false,
        myEvent: false,
        invitationReceived: false,
     };   
   },
  mounted() {
      this.url = window.location.href.split('/').pop();

       if(this.url == 'events'){
            if(JSON.parse(localStorage.getItem('tag')) == 'my_event'){
              this.myEvent = true;
            }else if(JSON.parse(localStorage.getItem('tag')) == 'invitation_received'){
              this.invitationReceived = true;
            }else{
              this.events = true;
            }
       }
      //  JSON.parse(localStorage.getItem('tag'))
  },
   methods:{
     set_content_type(contentType){
    
         localStorage.setItem('tag', JSON.stringify(contentType));
          if(JSON.parse(localStorage.getItem('tag')) == 'my_event'){
              this.events = false;
              this.myEvent = true;
              this.invitationReceived = false;
            }else if(JSON.parse(localStorage.getItem('tag')) == 'invitation_received'){
              this.events = false;
              this.myEvent = false;
              this.invitationReceived = true;
            }else if(JSON.parse(localStorage.getItem('tag')) == 'events'){
              this.events = true;
              this.myEvent = false;
              this.invitationReceived = false;
            }
       if(this.url != 'events'){
         this.$router.push("/events");
       }else{
         this.$emit('setContentType');
       }
     }
   }
}
</script>