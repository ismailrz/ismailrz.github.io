<template>
  	<div>
        <ul class="like-com">
            <li v-show="userData.id == job.creator_id"><router-link :to="/job-applicants/+job.id" class="com  text-dark" title="Total Applicants"><i class="fa fa-users"></i> Applicants &nbsp;{{job.total_applicants}}</router-link></li> 
            <li><a href="javascript:void(0);" class="com text-dark" title="Comment" @click="get_comments"><i class="fa fa-comment"></i> Comment &nbsp;{{job.total_comments}}</a></li>
            <li><a href="javascript:void(0);" class="com text-dark" data-toggle="modal"  :data-target="'#shareModal'+job.id" title="Share"><i class="fa fa-share"></i>Share &nbsp;</a></li>                              
        </ul>  
        <ul  v-if="userData.id == job.creator_id" class="like-com float-right mt-2">
            <li> <router-link :to="'/update-job/'+job.id"><a class="com text-dark" href="" title="Edit">
                <i class="fa fa-edit"></i>
                 </a></router-link></li>
            <li>
                <a href="#" class="com text-dark" @click="delete_job(job.id)" title="Delete"> <i class="fa fa-trash"></i></a>                              
            </li>
        </ul>
        <JobComments v-on:commentIncrementDecrement="comment_increment_decrement" :jobId="job.id" v-if="displayComments"/>
        
         <div class="modal fade" :id="'shareModal'+job.id" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                 <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title text-white text-center h5" id="shareModalTitle">Share this job</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-2">
                        <textarea v-model="comment" class="form-control mb-2" placeholder="Say something about this....."></textarea>
                        <ShareJob :job="job" />
                    </div> 
                    <div class="modal-footer" style="background-color:#024ea2; height:60px">
                        <div class="float-right">
                            <button type="button" class="btn btn-sm  text-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-sm  text-white" @click="share_job">Share</button>
                        </div>
                    </div>                                
                </div>
            </div>
        </div>
	</div>
</template>
<script>
import ShareJob from '@/components/user/Job/ShareJob';
import JobComments from '@/components/user/Job/JobComments';
export default {
    name: 'JobFooter',
    components:{
        ShareJob,
        JobComments
    },
    data() {
		return { 
		comment:"",
		userData:{},
		invitationIds:[],
		connectedUsers:{},
        invitedUsers:[],
        displayComments:false,
    	};   
    },
    props: {
     job: Object,
    },
    computed: {
        select_all: {
            get: function () {
                return this.connectedUsers ? this.invitationIds.length == this.connectedUsers.length : false;
            },
            set: function (value) {
                var selected = [];
                let invitedUsers =  this.invitedUsers;
                if (value) {
                    this.connectedUsers.forEach(function (connectedUser) {
                        let active = false;
                        invitedUsers.forEach(function (invitedUser){
                            if(invitedUser == connectedUser.id ){
                                active = true;
                            }
                        });
                        if(active == false){
                            selected.push(connectedUser.id);
                        }
                    });
                }
                this.invitationIds = selected;
            }
        }
    },
    mounted() {
        this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
    },
    methods: {
        get_comments(){
             if(!this.displayComments){
                this.displayComments = true;
             }else if(this.displayComments){
                 this.displayComments = false;
             }
        },
        share_job(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios.post("/api/share-job",{
                user_id : this.userData.id,
                owner_id : this.job.creator_id,
                shareable_id : this.job.id,
                comment : this.comment,
            })
            .then(res => {
                if(res.data.response == "success"){ 
                    toast.fire({icon: "info", title: res.data.message});
                    this.comment= "";
                    $('#shareModal'+this.job.id).modal('hide');
                }else{
                    toast.fire({icon: "info", title: res.data.message});                  
                }
            })
            .catch(err => { 
                    toast.fire({icon: "info", title: "Please enter valid data."});                                           
                    console.log(err);
            });
        },
        
        delete_job(id) {
            if (confirm("Are yor comfirm to delete?")) {
                axios
                .delete("/api/delete-job/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id+"/"+id)
                .then(res => {
                    toast.fire({icon: "info", title: "Deleted!" });
                    this.$router.push( "/jobs");
                })
                .catch(err => {
                    console.log(err);
                });
            }
        },
        comment_increment_decrement(commnetTrueFalse){
            if(commnetTrueFalse){
                this.job.total_comments++
            }else{
                this.job.total_comments--;
            }
        },
    }
};
</script>
