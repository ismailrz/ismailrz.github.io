<template>
  	<div>
	 <div class="wrapper">
        <Header/>
        <!-- <JobTopSearchbar/> -->
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3">
								<JobLeftSidebar v-on:setContentType="get_jobs"/>
							</div>
							<div class="col-lg-6">
                                <JobTopbar v-on:setJobs="get_jobs"/>
                                <Loader v-if="shouldShowLoader" />
								<ShowJobList :jobs='allJobs'/>
							</div>
							<div class="col-lg-3">
								<JobRightSidebar/>
							</div>
						</div>
					</div><!-- main-section-data end-->
				</div>
			</div>
		</main>
     </div>
     <Footer/>
	</div>
</template>
<script>
import Header from '@/components/user/Header';
import Footer from '@/components/user/Footer';
import JobLeftSidebar from '@/components/user/Job/JobLeftSidebar';
import JobRightSidebar from '@/components/user/Job/JobRightSidebar';
import JobTopbar from '@/components/user/Job/JobTopbar';
import ShowJobList from '@/components/user/Job/ShowJobList';
import ScriptLoader from '@/mixins/ScriptLoader';
import Loader from '@/components/Loader';
export default {
    name: 'Jobs',
    mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        Loader,
        JobTopbar,
        JobLeftSidebar,
        JobRightSidebar,
        ShowJobList,
    },
    data(){
        return {
            jobCategory: "",
            allJobs:[],
            shouldShowLoader: false,
            types:{},
            url:""
        }
    },
    mounted() {
        localStorage.setItem('checkJobUrl', JSON.stringify('jobs'));
        this.loadStyleSheets("user");
        this.loadJsScripts("user");
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
                localStorage.setItem('jobTag', JSON.stringify('jobs'));
                localStorage.setItem('jobCategoryId', JSON.stringify(0));
                localStorage.setItem('organizationId', JSON.stringify(0));
                localStorage.setItem('jobTypeId', JSON.stringify(0));
            }
            this.url =JSON.parse(localStorage.getItem('TTNetwork.user')).id+"/"+JSON.parse(localStorage.getItem('jobTag'))+"/"+ JSON.parse(localStorage.getItem('jobCategoryId'))+"/"+JSON.parse(localStorage.getItem('organizationId'))+"/"+JSON.parse(localStorage.getItem('jobTypeId'))+"/"+0;
       }

    }
};
</script>

