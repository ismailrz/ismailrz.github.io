<template>
    <div>      
        <div class="acc-leftbar">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a type="button" class="font-weight-bold btn btn-primary"  :class="{'active': jobs}" @click="set_content_type('jobs')"> <i class="fa fa-calendar-week"></i>Jobs</a>
                <a type="button" class="font-weight-bold btn btn-primary"  :class="{'active': myJob}" @click="set_content_type('myJob')"> <i class="fa fa-calendar-week"></i>My jobs</a>
                <a type="button" class="font-weight-bold btn btn-primary" :class="{'active': appliedJob}"  @click="set_content_type('appliedJob')"><i class="fa fa-shield-alt"></i>Applied</a>
            </div>
        </div>
      </div>
</template>
<script>
export default {
    name: 'JobLeftSidebar',
    data() {
      return { 
        name: "",
        url: null,
        jobs: false,
        myJob: false,
        appliedJob: false,
     };   
   },
  mounted() {
      this.url = window.location.href.split('/').pop();
      if(this.url == 'jobs'){
      // localStorage.setItem('jobTag', JSON.stringify('jobs'));
          if(JSON.parse(localStorage.getItem('jobTag')) == 'myJob'){
            this.myJob = true;
          }else if(JSON.parse(localStorage.getItem('jobTag')) == 'appliedJob'){
            this.appliedJob = true;
          }else{
            this.jobs = true;
          }
      }
  },
   methods:{
     set_content_type(contentType){
         localStorage.setItem('jobTag', JSON.stringify(contentType));
          if(JSON.parse(localStorage.getItem('jobTag')) == 'myJob'){
              this.jobs = false;
              this.myJob = true;
              this.appliedJob = false;
            }else if(JSON.parse(localStorage.getItem('jobTag')) == 'appliedJob'){
              this.jobs = false;
              this.myJob = false;
              this.appliedJob = true;
            }else if(JSON.parse(localStorage.getItem('jobTag')) == 'jobs'){
              this.jobs = true;
              this.myJob = false;
              this.appliedJob = false;
            }
          if(this.url != 'jobs'){
            this.$router.push("/jobs");
          }else{
            this.$emit('setContentType');
          }
     }
   }
}
</script>