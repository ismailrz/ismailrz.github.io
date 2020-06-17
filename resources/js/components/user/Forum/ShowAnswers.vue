<template>  
  <div>   
		<section class="forum-page py-2">     
          <div class="forum-questions mb-2 px-1 py-3" v-for="answer in showAnswers" v-bind:key="answer.id">           
            <div class="row">                      
              <div class="col-2 pr-0">
                <div class="usr_img">
                  <router-link :to="`/user-profile/${answer.user.id}`">
                    <img v-if="answer.user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+answer.user.id+'/Users/'+answer.user.profile_picture" > 
                    <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
                  </router-link>                                
                </div>
                <div class="float-left">
                  <router-link :to="`/user-profile/${answer.user.id}`">
                    <p style="font-size: 10px;">{{answer.user.name}}</p>
                  </router-link>                                
                  <p class="com text-dark"><i class="fa fa-question-circle"></i> {{answer.user.total_questions}}</p>
                  <p class="com text-dark"><i class="fa fa-check-circle"></i> {{answer.user.total_answers}}</p>
                  <p class="com text-dark"><i class="fa fa-star"></i> {{answer.user.total_score}}</p>
                </div>
              </div>
              <div class="col-10 pl-0">
                <div>
                  <router-link :to="`/question-details/${answer.question_id}`">
                    <p class="h6 text-justify font-weight-bold text-primary" v-html=" answer.title"></p>
                  </router-link>
                  <p class="text-justify pb-2" v-html="answer.answer"></p>
                </div> 
                <div class="row border-bottom">
                  <ul class="quest-tags my-3" v-if="answer.is_accepted > 0">
                    <span class="badge badge-success">Accepted</span>
                  </ul>
                </div>                           
                <div class="row pt-2">  
                  <div class="col px-0">
                    <ul class="react-links">
                      <li><a style="font-size: 14px;"><i class="fa fa-clock-o"></i>{{ answer.created_at|questionFormatDate }} </a></li>
                      <li><a class="com text-dark"><i class="fa fa-plus-circle"></i><b class="text-primary">{{ answer.up_vote }}</b></a></li>
                      <li><a class="com text-dark"><i class="fa fa-minus-circle"></i><b class="text-danger">{{ answer.down_vote }}</b></a></li>
                      <li class="row" v-if="answer.user_id == loggedInId">
                        <router-link class="com text-dark" :to="`/update-answer/${answer.id}`">
                          <i class="fa fa-edit"></i>
                        </router-link> 
                        <a class="pl-3">
                          <DeleteModal  v-on:setConfirmation="delete_answer" :id="answer.id"/>                           
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
  name: 'ShowAnswers',
  components: {
    DeleteModal,
  },
  data () {
    return {    
      up_vote:"",
      question_id:"",
      like : false,
      dislike: false,
      loggedInId: "",
    }
  },

	props: {
		showAnswers: {},
	},
 mounted() {
    this.loggedInId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
  },
 
  methods: {
      delete_answer(id) {
      axios.delete(`/api/delete-answer/${id}`)
        .then(res => {
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
