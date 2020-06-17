<template>  
  <div>   
		<section class="forum-page py-2">                 
			 <div class="forum-questions mb-2 px-1 py-3" v-for="question in showQuestions" v-bind:key="question.id">              
            <div class="row">                     
              <div class="col-2 pr-0">
                <div class="usr_img">
                  <router-link :to="`/user-profile/${question.user.id}`">
                    <img v-if="question.user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+question.user.id+'/Users/'+question.user.profile_picture" > 
                    <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
                  </router-link>                                
                </div>
                <div class="float-left" >
                  <router-link :to="`/user-profile/${question.user.id}`">
                    <p style="font-size: 10px;">{{ question.user.name }}</p>
                  </router-link>                                  
                  <p class="com text-dark"><i class="fa fa-question-circle"></i> {{ question.user.total_questions }}</p>
                  <p class="com text-dark"><i class="fa fa-check-circle"></i> {{ question.user.total_answers }}</p>
                  <p class="com text-dark"><i class="fa fa-star"></i> {{ question.user.total_score }}</p>
                </div>
              </div>
              <div class="col-10 pl-0">
                <div>
                  <router-link :to="`/question-details/${question.id}`">
                    <p class="h6 text-justify font-weight-bold text-primary"> {{ question.title}}</p>
                  </router-link>
                  <p class="text-justify card-text" v-html="question.details"></p>
                </div>                              
                <div class="row border-bottom">
                  <ul class="quest-tags my-3">
                    <span class="badge badge-primary">{{ question.question_category.title }}</span>
                    <router-link :to="`/question-details/${question.id}`">
                      <span class="badge badge-success">{{ question.total_answer }} Answers</span>
                    </router-link>
                  </ul>
                </div>
                <div class="row pt-2">                                  
                  <div class="col px-0">
                    <ul class="react-links">
                      <li><a style="font-size: 13px;"><i class="fa fa-clock-o"></i>{{ question.created_at| questionFormatDate }}</a></li>
                      <li><a v-if="question.created_by != loggedInId" href="javascript:void(0);" class="com text-dark" @click="give_up_vote(question)"><i class="fa fa-plus-circle"></i></a> Up:<b class="text-primary">{{ question.up_vote }}</b></li>
                      <li><a v-if="question.created_by != loggedInId" href="javascript:void(0);" class="com text-dark" @click="give_down_vote(question)"><i class="fa fa-minus-circle"></i></a>Down: <b class="text-danger">{{ question.down_vote }}</b></li>
                      <li><a class="com text-dark"><i class="fa fa-eye"></i> {{ question.total_view }}</a></li>
                      <li class="row" v-if="question.created_by == loggedInId">
                        <router-link class="com text-dark" :to="`/update-question/${question.id}`">
                          <i class="fa fa-edit"></i>
                        </router-link> 
                        <a class="pl-2">
                          <DeleteModal   v-on:setConfirmation="delete_question" :id="question.id"/>                           
                        </a> 
                      </li>        
                    </ul> 
                  </div>
                </div>                             
              </div>
            </div>
        </div>
    </section>   
  </div>
</template>

<script>
import DeleteModal from '@/components/DeleteModal';

export default {
  name: 'ShowQuestions',
  components: {
    DeleteModal,
  },
  data () {
    return {    
      up_vote:"",
      question_id:"",
      like : false,
      dislike: false,
      userId: "",
    }
  },

	props: {
		showQuestions: {},
	},
 mounted() {
    this.loggedInId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
  },
 
  methods: {
      give_up_vote(question){
        var userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
        if(userId == question.created_by){
          toast.fire({
            icon: "info",
            title: "You can not vote yourself!"
          });
        } else {
          axios.get(`/api/up-vote/${question.id}/${userId}/questions`).then(result => {
            if(result.data.response == "success"){
              question.up_vote++;
              for(let i = 0; i <this.questions.length; i++){
                if(this.questions[i].user.id == question.user.id){
                  this.questions[i].user.total_score+=10;
                }
              }
              toast.fire({
                icon: "info",
                title: result.data.message,
              });
            }
            toast.fire({
              icon: "info",
              title: result.data.message,
            });
          });
        }     
      },

      give_down_vote(question){
        var userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
        if(userId == question.created_by){
          toast.fire({
            icon: "info",
            title: "You can not vote yourself!"
          });
        } else {
          axios.get(`/api/down-vote/${question.id}/${userId}/questions`).then(result => {
            if(result.data.response == "success"){
              question.down_vote++;
              for(let i = 0; i <this.questions.length; i++){
                if(this.questions[i].user.id == question.user.id){
                  this.questions[i].user.total_score-=5;
                }
              }
              toast.fire({
                icon: "info",
                title: result.data.message,
              });
            }
            toast.fire({
                icon: "info",
                title: result.data.message,
            });
          }); 
        }     
      },
     delete_question(id) {
      axios.delete(`/api/questions/${id}`)
        .then(res => {
          this.get_questions();
          $('#deleteModal'+id).modal('hide');
          toast.fire({
            icon: "info",
            title: "Deleted!"
          });
        })
        .catch(err => {
          console.log(err);
        });
    },
  }  
}
</script>

<style scoped>
</style>
