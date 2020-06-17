<template>
  	<div>
        <div class="wrapper">
            <Header/>
            <section class="profile-account-setting">
                <div class="container-fluid">
                    <div class="account-tabs-setting">
                        <div class="row">
                            <div class="col-lg-3">
                                <JobLeftSidebar/>
                            </div>
                            <div class="col-lg-6">
                                <div class="acc-setting">
                                    <h3 class="text-center">Update Job</h3>
                                    <CreateOrUpdateJob ref="form"/>
                                </div>
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
import JobLeftSidebar from '@/components/user/Job/JobLeftSidebar';
import CreateOrUpdateJob from '@/components/user/Job/CreateOrUpdateJob';
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
    name: 'UpdateJob',
    mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        CreateOrUpdateJob,
        JobLeftSidebar,
    },
    mounted(){
        this.get_edit_job(window.location.href.split('/').pop());
        this.loadStyleSheets("user");
        this.loadJsScripts("user");
    },
    methods: {
        get_edit_job(jobId){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-edit-job/"+jobId+"/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id,}).then(
                result => {          
                    this.$refs.form.edit_job(result.data);                    
                error => {
                console.error(error);
                }
            });  
        }        
    }
};
</script>

