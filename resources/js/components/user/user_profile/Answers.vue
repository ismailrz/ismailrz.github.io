<template>
    <div>
        <div class="product-feed-tab current" id="user-answers">
			<ShowAnswers :showAnswers = answers /> 
        </div>
    </div>
</template>

<script>
import ShowAnswers from '@/components/user/Forum/ShowAnswers';
export default {
    name: 'Answers',
     components: {
        ShowAnswers,
      },
    data() {
     return { 
        userId:"",
        answers:{},
      };
  },
    mounted() {
            this.userId = window.location.href.split('/').pop();
            this.get_user_answers();
    },
  methods: {
      get_user_answers(){
        axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("TTNetwork.jwt");
        axios.post("/api/get-user-answers", {
          userId: this.userId,
          categoryId: 0,
          page: "1",
          limit: "100"
        })
        .then(result => {
          this.answers  = result.data.answers;                 
        });
    },
  }
}
</script>