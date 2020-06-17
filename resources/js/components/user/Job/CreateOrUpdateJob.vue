<template>
    <div>
        <form  @submit.prevent="create_or_update_job">                   
            <div class="cp-field mt-4">
                <h5 > Job Title</h5>
                <div class="">
                    <input class="form-control" type="text" v-model.trim="$v.title.$model" placeholder="Job title" required min="5">
                    <div class="error" v-if="!$v.title.required && $v.title.$dirty">Field is required</div>
                    <div class="error" v-if="!$v.title.minLength && $v.title.$dirty">Name must have at least {{$v.title.$params.minLength.min}} characters.</div>
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
               <h5>Job Type</h5> 
                <select class="form-control" v-model="job_type_id" required>
                  <option value="">Select</option>
                    <option v-for="(jobType, index) in jobTypes" :key="jobType" :value="index">{{ jobType }}</option>
                </select>
                <div class="inline-error">{{errors.get('job_type_id')}}</div>    
            </div>
            <div class="cp-field col-6 mt-2">
               <h5>Job Category</h5> 
                <select class="form-control" v-model="job_category_id" required>
                  <option value="">Select</option>
                  <option v-for="(jobCategory, index) in jobCategories" :key="jobCategory" :value="index">{{ jobCategory }}</option>
                </select>   
                <div class="inline-error">{{errors.get('job_category_id')}}</div>    
            </div>
            <div class="cp-field col-6 mt-2">
               <h5>Organization</h5>
               <select class="form-control" v-model="organization_id" required>
                  <option value="">Select</option>
                  <option v-for="(organization, index) in organizations" :key="organization" :value="index">
                    {{organization}}
                  </option>
                </select>
                <div class="inline-error">{{errors.get('organization_id')}}</div>    
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>Location</h5>
                <div class="cpp-fiel">
                    <input type="text" v-model="job_location" placeholder="Job location" required>
                    <p class="inline-error">{{errors.get('job_location')}}</p>
                </div>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>Vacancy</h5>
                <div class="cpp-fiel">
                    <input type="text" v-model="$v.total_vacancy.$model" placeholder="Vacancy" required>
                    <p class="inline-error">{{errors.get('total_vacancy')}}</p>
                    <div class="error" v-if="!$v.total_vacancy.numeric">Should be a number</div>
                </div>
            </div>
             <div class="cp-field col-6 mt-2">
                <h5>Deadline</h5>
                <div class="cpp-fiel">
                    <input type="date" v-model="application_deadline" required>
                    <p class="inline-error">{{errors.get('application_deadline')}}</p>
                </div>
            </div>
            <div class="cp-field col-12 mt-2">
                <h5>Experience</h5>
                <div class="cpp-fiel row">
                    <input class="col mr-2" type="text" v-model="$v.minimum_experience.$model" placeholder="min">
                    <input class="col" type="text" v-model="$v.maximum_experience.$model" placeholder="max">
                </div>
                <div class="error" v-if="!$v.maximum_experience.checkExperience && $v.maximum_experience.$dirty">Maximum experience should be greater than minimum</div>
                <div class="error" v-if="!$v.minimum_experience.numeric">Minimum experience should be a number</div>
                <div class="error" v-if="!$v.maximum_experience.numeric">Maximum experience should be a number</div>
                <div class="inline-error">{{errors.get('maximum_experience')}}</div>
            </div>
          
            <div class="cp-field col-12 mt-2">
                <h5>Age</h5>
                <div class="cpp-fiel row">
                    <input class="col mr-2" type="text" v-model="$v.minimum_age.$model" placeholder="min">
                    <input class="col" type="text" v-model="$v.maximum_age.$model" placeholder="max">   
                </div>
                <div class="error" v-if="!$v.maximum_age.checkAge && $v.maximum_age.$dirty">Maximum age should be greater than minimum</div>
                <div class="error" v-if="!$v.minimum_age.numeric">Minimum age should be a number</div>
                <div class="error" v-if="!$v.maximum_age.numeric">Maximum age should be a number</div>
                <div class="inline-error">{{errors.get('maximum_age')}}</div>
            </div>
            <div class="cp-field col-6 mt-2">
                <h5>Salary Range</h5>
                <div class="cpp-fiel">
                    <input type="text" v-model="salary_range" placeholder="20000 - 30000" required>
                    <p class="inline-error">{{errors.get('salary_range')}}</p>
                </div>
            </div>
             <div class="cp-field col-6 mt-2">
                <h5>Preferred Gender</h5>
                <div class="cpp-fiel">
                    <select v-model="preferred_gender" name="preferred_gender" class="form-control">
                        <option value="10">Male</option>
                        <option value="20">Female</option>
                        <option value="30">Both</option>
                    </select>
                </div>
            </div>
            
            <div class="cp-field mt-2">
                <h5>Responsibility</h5>
                <div class="cpp-fiel">
                    <textarea v-model="responsibilities" id="" cols="30" rows="2" required></textarea>               
                </div>
            </div>    
            <div class="cp-field mt-2">
                <h5>Requirement</h5>
                <div class="cpp-fiel">
                    <textarea v-model="requirements" id="" cols="30" rows="2" required></textarea>               
                </div>
            </div>    
            <div class="cp-field mt-2">
                <h5>Other Benefits</h5>
                <div class="cpp-fiel">
                    <textarea v-model="other_benefits" id="" cols="30" rows="2" required></textarea>               
                </div>
            </div>    
            <div class="cp-field mt-2">
                <h5>Special Instruction</h5>
                <div class="cpp-fiel">
                    <textarea v-model="special_instruction" id="" cols="30" rows="2"></textarea>               
                </div>
            </div>          
            <div class="save-stngs pd2">
                <ul>
                    <li><button type="submit">Save </button></li>                              
                    <li><router-link to="/jobs">
                        <button type="submit" >Cancel</button>
                    </router-link></li>                              
                </ul>
            </div>
        </form>           
    </div>
</template>
<script>
import moment from "moment";
import { required, minLength, numeric } from 'vuelidate/lib/validators';

// custom frontend validation
let checkExperience = (value, vm) => vm.minimum_experience < vm.maximum_experience;
let checkAge = (value, vm) => vm.minimum_age < vm.maximum_age;


// checking backend errors
class Errors{
  constructor(){
    this.errors = {}
  }

  get (field){
    if(this.errors[field]){
      return this.errors[field][0];
    }
  }

  record(errors){
    this.errors = errors;
  }

}
// End checking backend errors
export default {
    name: 'CreateOrUpdateJob',
    data() {
      return { 
        interestGroups: {},
        jobTypes: {},
        organizations: {},
        jobCategories: {},
        statuses: {},
        id: "",       
        title: "",
        job_location: "",
        total_vacancy: "",
        application_deadline: "",
        salary_range: "",
        minimum_experience: "",
        maximum_experience: "",
        minimum_age: "",
        maximum_age: "",
        preferred_gender: 10,
        responsibilities: "",
        requirements: "",
        other_benefits: "",
        special_instruction: "",
        job_type_id: "",
        job_category_id: "",
        organization_id: "",
        checkUpdateJob: false,
        errors: new Errors(),
     };   
   },
   validations: {
    title: {
      required,
      minLength: minLength(5)
    },
    maximum_experience: {
      checkExperience,
      numeric 
    },
    minimum_experience: {
      numeric 
    },
    maximum_age: {
      checkAge,
      numeric 
    },
    minimum_age: {
      numeric 
    },
    total_vacancy: {
      numeric
    }
  },
   mounted() {
    this.get_job_categories_organizations_types();
  },
  methods: {
     get_job_categories_organizations_types() {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
      axios({ method: "GET", url: "/api/get-job-categories-organizations-types"}).then(
        result => {
          this.jobCategories = result.data.jobCategories;
          this.organizations = result.data.organizations;
          this.jobTypes = result.data.jobTypes;
          this.statuses = result.data.statuses;
        });
    },
    create_or_update_job() {
      if(this.checkUpdateJob == false){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
        axios
          .put("/api/create-job/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
            id : this.id,
            title : this.title,
            job_type_id : this.job_type_id,
            job_category_id : this.job_category_id,
            organization_id : this.organization_id,
            job_location : this.job_location,
            total_vacancy : this.total_vacancy,
            application_deadline : this.application_deadline,
            salary_range : this.salary_range,
            minimum_experience : this.minimum_experience,
            maximum_experience : this.maximum_experience,
            minimum_age : this.minimum_age,
            maximum_age : this.maximum_age,
            preferred_gender : this.preferred_gender,
            responsibilities : this.responsibilities,
            requirements : this.requirements,
            other_benefits : this.other_benefits,
            special_instruction : this.special_instruction,
          })
          .then(res => {
            if(res.data.response == "success"){ 
                toast.fire({icon: "info", title: res.data.message});
                 this.$router.push("/jobs");
              }else{
                this.errors.record(res.data.errors);                 
              }
          });
      }else if(this.checkUpdateJob == true){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');          
          axios
            .put("/api/update-job/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
                id : this.id,
                title : this.title,
                job_type_id : this.job_type_id,
                job_category_id : this.job_category_id,
                organization_id : this.organization_id,
                job_location : this.job_location,
                total_vacancy : this.total_vacancy,
                application_deadline : this.application_deadline,
                salary_range : this.salary_range,
                minimum_experience : this.minimum_experience,
                maximum_experience : this.maximum_experience,
                minimum_age : this.minimum_age,
                maximum_age : this.maximum_age,
                preferred_gender : this.preferred_gender,
                responsibilities : this.responsibilities,
                requirements : this.requirements,
                other_benefits : this.other_benefits,
                special_instruction : this.special_instruction,
            })
            .then(res => {
               if(res.data.response == "success"){ 
                toast.fire({icon: "info", title: res.data.message});
                 this.$router.push("/jobs");   
              }else{
                toast.fire({icon: "info", title: res.data.message}); 
                this.errors.record(res.data.errors);                   
              }
            })
            .catch(err => {
                console.log(err);
              toast.fire({icon: "info", title: "Please enter valid data."});
            });
      }
    },
    edit_job(job) {
        this.id = job.id;
        this.title = job.title;
        this.job_type_id = job.job_type_id;
        this.job_category_id = job.job_category_id;
        this.organization_id = job.organization_id;
        this.job_location = job.job_location;
        this.total_vacancy = job.total_vacancy;
        this.application_deadline = job.application_deadline;
        this.salary_range = job.salary_range;
        this.minimum_experience = job.minimum_experience;
        this.maximum_experience = job.maximum_experience;
        this.minimum_age = job.minimum_age;
        this.maximum_age = job.maximum_age;
        this.preferred_gender = job.preferred_gender;
        this.responsibilities = job.responsibilities;
        this.requirements = job.requirements;
        this.other_benefits = job.other_benefits;
        this.special_instruction = job.special_instruction;
        this. checkUpdateJob = true;
    },
  }
}
</script>