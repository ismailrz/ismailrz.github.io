<template>
    <div>      
         <div class="post-topbar">
           <div class="row">
                  <select  @change="set_job_category(jobCategoryId,organizationId,jobTypeId)" v-model="jobCategoryId" class="mr-2 col btn btn-sm btn-outline-secondary ">
                      <option value="0">Categories</option>
                      <option v-for="(category, index) in jobCategories" :key="category" v-bind:value="index">
                        {{category}}
                      </option>
                  </select>
                   <select  @change="set_job_category(jobCategoryId,organizationId,jobTypeId)" v-model="organizationId" class="mr-2 col btn btn-sm btn-outline-secondary ">
                      <option value="0">Organizations</option>
                      <option v-for="(org, index) in organizations" :key="org" v-bind:value="index">
                        {{org}}
                      </option>
                  </select>
                  <select  @change="set_job_category(jobCategoryId,organizationId,jobTypeId)" v-model="jobTypeId" class="col btn btn-sm btn-outline-secondary">
                      <option value="0">Types</option>
                      <option v-for="(type, index) in types" :key="type" :value="index">
                        {{type}}
                      </option>
                  </select>
                  <div class="col float-right">
                  <router-link to="/new-job"><button class="btn btn-sm btn-primary float-right">Post a Job</button> </router-link> 
                  </div>
            </div>
         </div>
    </div>
</template>
<script>
 export default {
  name: 'JobTopbar',
  data(){
    return{
      jobCategories: [],
      organizations: [],
      types: [],
      jobCategoryId:"0",
      organizationId:"0",
      jobTypeId:"0",
      url: null,
    }
  },
  mounted(){
    this.url = window.location.href.split('/').pop();
    if(this.url == 'jobs'){
        localStorage.setItem('jobTypeId', JSON.stringify(0));
        localStorage.setItem('jobCategoryId', JSON.stringify(0));
        localStorage.setItem('organizationId', JSON.stringify(0));
    }
    this.get_job_categories();
  },
  methods:{
        get_job_categories() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-job-categories-organizations-types"}).then(
              result => {
                this.jobCategories = result.data.jobCategories;
                this.organizations = result.data.organizations;
                this.types = result.data.jobTypes;
              },
              error => {
                console.error(error);
              }
            );
        },
        set_job_category(jobCategoryId,organizationId,jobTypeId) {
           localStorage.setItem('jobCategoryId', JSON.stringify(jobCategoryId));
            localStorage.setItem('organizationId', JSON.stringify(organizationId));
           localStorage.setItem('jobTypeId', JSON.stringify(jobTypeId));

           if(JSON.parse(localStorage.getItem('checkJobUrl')) == 'single-job' || JSON.parse(localStorage.getItem('checkJobUrl')) == 'applied-job'){
            this.$router.push("/jobs").catch(err => {});
          }else{
            this.$emit('setJobs');
          }            
        },
  },
}
</script>
