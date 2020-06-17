<template>
  <div>
    <LeftSidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <HeaderBar />
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <div class="row">
                    <div class="col mb-2">
                    <h6 class="m-0 font-weight-bold text-primary float-left">Jobs</h6>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      <input type="text" v-model="search" class="form-control" placeholder="Search">
                    </div>
                    <div class="col-8 row">
                      <select  @change="set_job_category(jobCategoryId)" v-model="jobCategoryId" class="mr-2 col btn btn-sm btn-outline-secondary ">
                        <option value="0">Categories</option>
                        <option v-for="(category, index) in jobCategories" :key="category" :value="index">
                          {{category}}
                        </option>
                      </select>
                      <select  @change="set_org_id(organizationId)" v-model="organizationId" class="mr-2 col btn btn-sm btn-outline-secondary ">
                          <option value="0">Organizations</option>
                          <option v-for="(org, index) in organizations" :key="org" :value="index">
                            {{org}}
                          </option>
                      </select>
                      <select  @change="set_type_id(jobTypeId)" v-model="jobTypeId" class="col mr-2 btn btn-sm btn-outline-secondary">
                          <option value="0">Types</option>
                          <option v-for="(type, index) in types" :key="type" :value="index">
                            {{type}}
                          </option>
                      </select>
                      <button class="btn btn-primary" @click="reset_filter">Reset</button>
                    </div>

                  </div>
                </div>
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <td>Title</td>
                        <td>Organization</td>
                        <td>Options</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="shouldShowLoader">
                          <Loader/>
                      </tr>
                      <tr v-for="job in allJobs" :key="job.id">
                        <td><router-link :to="`/job/${job.id}`">{{job.title}}</router-link></td>
                        <td>{{job.organization_name}}</td>
                        <td>
                          <router-link :to="'/controller-update-job/'+job.id"><a class="com text-dark" href="" title="Edit">
                          <i class="fa fa-edit"></i>
                          </a>
                          </router-link>
                          <a href="#" class="com text-dark" @click="delete_job(job.id)" title="Delete"> <i style="color:red"  class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <FooterBar />
  </div>
</template>

<script>
import axios from "axios";
import ScriptLoader from '@/mixins/ScriptLoader';
import HeaderBar from "@/components/admin/HeaderBar";
import LeftSidebar from "@/components/admin/LeftSidebar";
import Loader from '@/components/Loader';
import FooterBar from "@/components/admin/FooterBar";
export default {
  data(){
    return {
      allJobs: [],
      jobCategories: [],
      organizations: [],
      types: [],
      search: "0",
      jobCategoryId:"0",
      organizationId:"0",
      jobTypeId:"0",
      url: null,
      awaitingSearch: false,
      shouldShowLoader: false,
    }
  },
  mixins: [ScriptLoader],
  name: "ControllerJob",
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
    Loader
  },
  watch : {
    search: function(val) {
        if (!this.awaitingSearch) {
          setTimeout(() => {
          this.searchResults = null;
          this.hide = false;
          if(this.search.length >= 2){
            this.shouldShowLoader = true;
            this.get_jobs();
          }
            this.awaitingSearch = false;
          }, 1000);
        }
        this.awaitingSearch = true;
      }
  },
  mounted(){
        this.loadStyleSheets("controller");
        this.loadJsScripts("controller");
        this.url = window.location.href.split('/').pop();
        if(this.url == 'controller-jobs'){
          localStorage.setItem('jobTypeId', JSON.stringify(0));
          localStorage.setItem('jobCategoryId', JSON.stringify(0));
          localStorage.setItem('organizationId', JSON.stringify(0));
        }
        this.get_jobs();
        this.get_job_categories();
    },
    methods: {
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
        get_jobs(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-jobs/"
            +JSON.parse(localStorage.getItem('TTNetwork.user')).id+"/"
            +0+"/"
            +JSON.parse(localStorage.getItem('jobCategoryId'))+"/"
            +JSON.parse(localStorage.getItem('organizationId'))+"/"
            +JSON.parse(localStorage.getItem('jobTypeId'))+"/"+this.search
            }).then(
                result => {
                    this.allJobs  = result.data.jobs;
                    console.log(this.allJobs)
                error => {
                console.error(error);
                }
            });
        },
        set_job_category(jobCategoryId) {
          localStorage.setItem('jobCategoryId', JSON.stringify(jobCategoryId));
          this.get_jobs();
        },
        set_org_id(organizationId) {
          localStorage.setItem('organizationId', JSON.stringify(organizationId));
          this.get_jobs();
        },
        set_type_id(jobTypeId) {
          localStorage.setItem('jobTypeId', JSON.stringify(jobTypeId));
          this.get_jobs();
        },
        delete_job(id) {
            if (confirm("Are yor comfirm to delete?")) {
                axios
                .delete("/api/delete-job/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id+"/"+id)
                .then(res => {
                    toast.fire({icon: "info", title: "Deleted!" });
                    this.$router.push( "/controller-jobs");
                })
                .catch(err => {
                    console.log(err);
                });
            }
        },
        reset_filter(){
          this.search = "0";
          localStorage.setItem('jobTypeId', JSON.stringify(0));
          localStorage.setItem('jobCategoryId', JSON.stringify(0));
          localStorage.setItem('organizationId', JSON.stringify(0));
          this.get_jobs();
          this.jobCategoryId ="0",
          this.organizationId = "0",
          this.jobTypeId = "0"
        }
    }
}

</script>

<style lang="scss" scoped></style>
