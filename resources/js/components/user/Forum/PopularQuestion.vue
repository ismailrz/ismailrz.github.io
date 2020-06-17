<template>
	<div>
		<div class="widget widget-user">
      <h3 class="title-wd padding font-weight-bold text-primary">Popular Question</h3>
      <div>
        <ul style="overflow-y: scroll; height: 350px;">
          <li v-for="popularQuestion in popularQuestions" :key="popularQuestion.id" class="px-2 py-1 border-bottom">
            <div class="usr-msg-details py-2">
              <div class="row">

              </div>
              <div class="row">
                  <img style="padding-right:3px" v-if="popularQuestion.user.profile_picture" class="rounded-circle col-3"  v-bind:src="'/storage/uploads/'+popularQuestion.user.id+'/Users/'+popularQuestion.user.profile_picture" > 
                  <img style="padding-right:3px" v-else  class="rounded-circle col-3" v-bind:src="'/Images/profile/profile_logo.png'">
                  <p class="col-9" style="font-size: 14px; padding-top: 7px; padding-left: 0px;">{{ popularQuestion.user.name }} </p>
              </div>
              <div class="row">
                <div class="col-12 py-1 popular-question"><router-link :to="`/question-details/${popularQuestion.id}`">
                    {{ popularQuestion.title}}
                  </router-link>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
		</div>
	</div>
</template>
<script>
	export default {
  name: 'PoularQuestion',
  data () {
    return {    
      popularQuestions: {},
    }
  },
  mounted() {
    this.popularQuestion();
  },
  methods: {
    popularQuestion() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/popular-question"}).then(
        response => {
          console.log(response.data);
          this.shouldShowLoader = false;
          this.popularQuestions = response.data.popularQuestions;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },
  }    
};
</script>