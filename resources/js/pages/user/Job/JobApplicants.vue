<template>
  	<div>
	 <div class="wrapper">
        <Header/>
        <!-- <JobTopSearchbar/> -->
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">  <div class="col-lg-3">
								<JobLeftSidebar />
							</div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <JobTopbar />
                                <div class="main-ws-sec">
                                    <div class="posts-section">
                                        <div class="post-bar">
                                        <!-- <span class="badge badge-secondary float-left">{{job.organization.name}}</span> -->
                                        <div class="p-all saved-post">
                                            <div class="usy-dt">
                                                <div class="single-job-title-section">
                                                    <h2>{{job.title}}</h2>
                                                    <p>Posted on {{job.created_at | questionFormatDate}} <br>{{job.job_location}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <span style="font-size: 14px;" class="badge badge-pill badge-primary mr-2">
                                                <div v-if="job.job_type_id == 1">Full Time</div>
                                                <div v-if="job.job_type_id == 2">Part Time</div>
                                                <div v-if="job.job_type_id == 3">Remote</div>
                                            </span>
                                            <span style="font-size: 14px;" class="badge badge-pill badge-light">Deadline: {{job.application_deadline | questionFormatDate}}</span>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col pl-0">
                                                <strong>Total Vacancy: <span class="text-muted">{{job.total_vacancy}}</span></strong>
                                            </div>
                                            <div class="col">
                                                <strong>Salary range: <span class="text-muted">{{job.salary_range}}</span></strong>
                                            </div>
                                        </div>
                                        <h3 class="section-heading">Applicants list</h3>
                                        <div class="row mt-3">
                                            <div v-for="user in users" :key="user.id" class="col-4">
                                                <div class="company_profile_info">
                                                    <div class="company-up-info">
                                                       <img
                                                        v-if="user.profile_picture"
                                                        v-bind:src="
                                                            '/storage/uploads/' +
                                                            user.id +
                                                            '/Users/' +
                                                            user.profile_picture
                                                        "
                                                        />
                                                        <img v-else :src="'/Images/profile/profile_logo.png'" />
                                                        <h3>{{ user.name }}</h3>
                                                        <!-- <h4>Graphic Designer</h4> -->
                                                        <ul>
                                                            <li><i class="fa fa-envelope"></i> {{user.email}}</li>
                                                            <li v-show="user.phone"><i class="fa fa-phone"></i> {{user.phone}}</li>
                                                        </ul>
                                                    </div>
                                                    <router-link :to="/user-profile/+user.id" title="" class="view-more-pro">View Profile</router-link>
                                                </div><!--company_profile_info end-->
                                            </div>
                                        </div>
                                         <div class="job-status-bar mt-3">
                                            <JobFooter :job='job' />
                                        </div>
                                    </div>
                                        <!--post-bar end-->
                                    </div>
                                    <!--posts-section end-->
                                </div>
                                <!--main-ws-sec end-->
                                
                            </div>

                            <div class="modal" id="applyNow">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="text-light text-center">Apply to this job</h3>
                                            </div>
                                            <div class="modal-body">
                                                <div class="innerbody apply-jobbox">
                                                    <form class="form-group">
                                                        <input class="mb-2" v-model="expectedSalary" type="text" placeholder="Expected Salary">
                                                        <textarea class="form-control" v-model="coverLetter" name="" id="" cols="30" rows="7" placeholder="Cover Letter"></textarea>
                                                    </form>
                                                    <!-- <div class="select-files">
                                                    <h3>Attach File With CV</h3>
                                                        <input type="file" class="custom-file-input">
                                                        <p>Upload your cv / resume file. Max file size : 3MB</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-success-outline" @click="job_apply(job.id)">Apply</button>
                                                <button class="btn btn-success-outline" type="button" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <div class="right-sidebar">
                                    <div class="widget widget-about bid-place">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applyNow" data-whatever="@mdo">Apply Now</button>
                                    </div>
                                    <!--widget-about end-->
                                    <div class="widget widget-jobs">
                                        <div class="sd-title">
                                            <h3>About the Employer</h3>
                                            <i class="la la-ellipsis-v"></i>
                                        </div>
                                        <div class="sd-title paymethd">
                                            <h4>Payment Method</h4>                                          
                                            <p>Verified</p>
                                            <ul class="star">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-half-o"></i></li>
                                                <li>
                                                    <a>5.00 of 5 Reviews</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="sd-title">
                                            <h4>India</h4>                                            
                                            <p>SKS Nagar, Ludhiana 1 AM</p>
                                        </div>
                                        <div class="sd-title">
                                            <h4>20 Projects Posted | 15 Jobs Posted</h4>                                            
                                            <p>85% Hire Rate, 15% Open Jobs</p>
                                        </div>
                                        <div class="sd-title">
                                            <h4>Member Since</h4>                                            
                                            <p>August 24, 2017</p>
                                        </div>
                                    </div>
                                    <!--widget-jobs end-->
                                </div>
                                <!--right-sidebar end-->
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
import JobFooter from '@/components/user/Job/JobFooter';
import JobLeftSidebar from '@/components/user/Job/JobLeftSidebar';
import JobTopbar from '@/components/user/Job/JobTopbar';
import ScriptLoader from '@/mixins/ScriptLoader';
import Loader from '@/components/Loader';
export default {
    name: 'JobApplicants',
    mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        JobFooter,
        JobLeftSidebar,
        JobTopbar,
        Loader
    },
    data(){
        return {
            job: {},
            users: {},
            expectedSalary: "",
            coverLetter: "",
            url : window.location.href.split('/').pop(),
            shouldShowLoader: false,
            user_profile: JSON.parse(localStorage.getItem("TTNetwork.user"))
        }
    },
    mounted() {
        localStorage.setItem('checkJobUrl', JSON.stringify('applied-job'));
        this.loadStyleSheets("user");
        this.loadJsScripts("user");
        this.get_job();
    },
    methods: {   
          get_job(){
            this.shouldShowLoader = true;
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-job-applicants/"+ this.url
            }).then(
                result => {                    
                    this.job  = result.data.job; 
                    this.users  = result.data.users; 
                    this.shouldShowLoader = false;
                error => {
                console.error(error);
                }
            });
        }
    }
};
</script>

