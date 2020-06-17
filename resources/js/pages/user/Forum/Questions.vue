<template>
  <div>
    <div class="wrapper">
      <Header/>      
      <section class="profile-account-setting">
        <div class="container px-0">
          <div class="account-tabs-setting">
            <div class="row">
              <div class="col-lg-3 pl-0">
                <ForumLeftSidebar v-on:leftSideBarClicked="get_content_type" />
              </div>
              <div class="col-lg-6 px-0">
                <ForumTopbar  v-on:setQuestions="get_category_id" />
                <Loader v-if="shouldShowLoader" /> 

                
                <!-- My Question -->
                <div v-if="content_type=='my_questions'">               
                  <ShowQuestions :showQuestions = questions />
                </div>


                <!-- My Answer -->
                <div v-else-if="content_type=='my_answers'">  
                  <ShowAnswers :showAnswers = answers />
                </div>


                <!-- Question Listing -->
                <div v-else>                 
                  <ShowQuestions :showQuestions = questions />
                </div> 

              </div>
              <div class="col-lg-3 pr-0">
                <PopularQuestion />
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
import Loader from '@/components/Loader';
import ForumTopbar from '@/components/user/Forum/ForumTopbar';
import ShowQuestions from '@/components/user/Forum/ShowQuestions';
import ShowAnswers from '@/components/user/Forum/ShowAnswers';
import PopularQuestion from '@/components/user/Forum/PopularQuestion';
import ForumLeftSidebar from '@/components/user/Forum/ForumLeftSidebar';
import DeleteModal from '@/components/DeleteModal';
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: 'Questions',
  mixins: [ScriptLoader],
  data () {
    return {    
      questions: {},
      shouldShowLoader: false,
      question_id:"",
      userId: 0,
      loggedInId: "",
      categoryId: 0,
      answers: "",
      page: "1",
      limit: "10",
      content_type: 'questions',
      user: JSON.parse(localStorage.getItem('TTNetwork.user')),
    }
  },

  components: {
    Header,
    Footer,
    Loader,
    ForumTopbar,
    PopularQuestion,
    ForumLeftSidebar,
    DeleteModal,
    ShowQuestions,
    ShowAnswers,
  },

  mounted() {
    this.loadStyleSheets("user");
    this.loadJsScripts("user");
    this.get_questions();
    this.get_my_answers();
    this.loggedInId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
  },

  methods: {
    get_questions(){
      this.shouldShowLoader = true;
      if(this.content_type == 'questions'){
        this.userId = 0;
      } else if(this.content_type == 'my_questions') {
       this.userId = this.loggedInId;
      }
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
      axios({ method: "GET", url: "/api/get-questions/"+this.userId+"/"+this.categoryId+"/"+this.limit+"/"+this.page}).then(
      result => {                    
          this.questions  = result.data.questions.data;
          console.log(this.questions);    
          this.shouldShowLoader = false;                                  
      error => {
      console.error(error);
      }
      });       
    },

    get_my_answers(){
      if(this.content_type == 'my_answers'){
        this.shouldShowLoader = true;
        this.userId = this.loggedInId;
        axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("TTNetwork.jwt");
        axios.post("/api/get-user-answers", {
          userId: this.userId,
          categoryId: this.categoryId,
          page: "1",
          limit: "10"
        })
        .then(result => {
          this.shouldShowLoader = false;
          this.answers  = result.data.answers;  
          console.log(this.answers);               
        });
      }
    },

    get_content_type(contentType){
      this.content_type = contentType;
      if(this.content_type=='my_questions' || this.content_type=='questions'){
        this.get_questions();
      }
      this.get_my_answers();
    },

    get_category_id(categoryId){
      this.categoryId = categoryId;
      if(this.content_type=='my_questions' || this.content_type=='questions'){
        this.get_questions();
      }
      this.get_my_answers();
    },

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
		
   
    //// Answer Part //////
    delete_answer(id) {
      axios.delete(`/api/delete-answer/${id}`)
        .then(res => {
          this.get_my_answers();
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
};
</script>
<style scoped>
  
</style>