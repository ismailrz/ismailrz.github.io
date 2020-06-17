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
                  <h6 class="m-0 font-weight-bold text-primary float-left">Update Job</h6>
                </div>
                <div class="card-body">
                    <CreateOrUpdateJob ref="form"/>
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
import FooterBar from "@/components/admin/FooterBar";
import CreateOrUpdateJob from '@/components/admin/Job/CreateOrUpdateJob';
export default {
  mixins: [ScriptLoader],
  name: "ControllerJobCreate",
  components: {
    HeaderBar,
    CreateOrUpdateJob,
    LeftSidebar,
    FooterBar
  },

  mounted(){
        this.get_edit_job(window.location.href.split('/').pop());
        this.loadStyleSheets("controller");
        this.loadJsScripts("controller");
    },
    methods: {
        get_edit_job(jobId){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/controller-edit-job/"+jobId+"/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id,}).then(
                result => {          
                    this.$refs.form.edit_job(result.data);                    
                error => {
                console.error(error);
                }
            });  
        }        
    }
}

</script>

<style lang="scss" scoped></style>
