<template>
    <div>
        <div class="main-ws-sec">
            <div class="posts-section">
                <div class="post-bar"  v-for="job in jobs" v-bind:key="job.id">
                    <span class="badge badge-secondary float-left">{{job.organization_name}}</span>
                    <span class="badge badge-pill badge-warning float-right">Jobs</span>
                    <div class="p-all saved-post">
                        <div class="usy-dt">
                            <div class="wordpressdevlp">
                                <div style="display:block; height:10px"></div>
                                <router-link :to="`/job/${job.id}`">{{job.title}}</router-link>
                                <div style="display:block; height:10px"></div>
                                <p>Posted on {{job.created_at | questionFormatDate}} <br>{{job.job_location}}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span class="badge badge-pill badge-primary">
                            <div v-if="job.job_type_id == 1">Full Time</div>
                            <div v-if="job.job_type_id == 10">Part Time</div>
                            <div v-if="job.job_type_id == 20">Remote</div>
                        </span>
                        <span class="badge badge-pill badge-light">Deadline: {{job.application_deadline | questionFormatDate}}</span>
                    </div>
                    <div class="job-status-bar mt-3">
                         <JobFooter :job='job' />
                    </div>
                </div>
            </div><!--posts-section end-->
        </div><!--main-ws-sec end-->
    </div>
</template>
<script>
import JobFooter from '@/components/user/Job/JobFooter';
export default {
    name: 'ShowJobList',
    components: {
        JobFooter,
    },
    props: {
        jobs: Array,
    },
    methods:{
       
    },
}
</script>