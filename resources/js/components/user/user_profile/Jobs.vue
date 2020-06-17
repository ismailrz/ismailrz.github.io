<template>
    <div>
		<div class="product-feed-tab current" id="user-jobs">
             <JobTopbar v-on:setJobs="get_jobs"/>
              <ShowJobList :jobs='allJobs'/>
        </div>
    </div>
</template>

<script>
import ShowJobList from '@/components/user/Job/ShowJobList';
import JobTopbar from '@/components/user/Job/JobTopbar';
export default {
    name: 'Jobs',
    components: {
        ShowJobList,
        JobTopbar,
    },
    data() {
     return { 
        allJobs:[],
        userId:"",
        url:"",
      };
  },
    mounted() {
        localStorage.setItem('checkJobUrl', JSON.stringify('user-profile'));
        this.get_jobs();
    },
  methods: {
         get_jobs(){
            this.generate_url();
            this.shouldShowLoader = true;
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-jobs/"+this.url }).then(
                result => {
                    this.allJobs  = result.data.jobs;
                    this.shouldShowLoader = false;
                error => {
                console.error(error);
                }
            });
        },
         generate_url(){
            if(JSON.parse(localStorage.getItem('table')) != 'jobs'){
                localStorage.setItem('table', JSON.stringify('jobs'));
                localStorage.setItem('jobTag', JSON.stringify('myJob'));
                localStorage.setItem('jobCategoryId', JSON.stringify(0));
                localStorage.setItem('organizationId', JSON.stringify(0));
                localStorage.setItem('jobTypeId', JSON.stringify(0));
            }
            this.url =JSON.parse(localStorage.getItem('TTNetwork.user')).id+"/"+"myJob"+"/"+ JSON.parse(localStorage.getItem('jobCategoryId'))+"/"+JSON.parse(localStorage.getItem('organizationId'))+"/"+JSON.parse(localStorage.getItem('jobTypeId'))+"/"+0;
       }

     
  }
}
</script>