<template>
    <div>
		  <div class="product-feed-tab current" id="user-questions">
          <ShowQuestions :showQuestions = questions />
      </div>		
    </div>
</template>

<script>
import ShowQuestions from '@/components/user/Forum/ShowQuestions';

export default {
    name: 'Questions',
     components: {
        ShowQuestions,
      },
    data() {
     return { 
        userId:"",
        questions:{},
      };
  },
  mounted() {
        this.userId = window.location.href.split('/').pop();
        this.get_questions();
  },
  methods: {
      get_questions(){
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
      axios({ method: "GET", url: "/api/get-questions/"+this.userId+"/"+0+"/"+100+"/"+1}).then(
      result => {                    
          this.questions  = result.data.questions.data;
          console.log(this.questions);    
      error => {
      console.error(error);
      }
      });       
    },
  }
}
</script>