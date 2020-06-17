<template>
    <div>
      <div class="sd-title">
        <h3>Connented People</h3>
        <i class="la la-ellipsis-v"></i>
    </div><!--sd-title end-->
    <div class="suggestions-list">
        <div class="suggestion-usd" v-for="connectedUser in connectedUsers" :key="connectedUser.id">
             <router-link :to="{name: 'UserProfile', params: { id: connectedUser.id}}">
                <div v-if="connectedUser.profile_picture">
                    <img class="rounded-circle" v-bind:src="'/storage/uploads/'+connectedUser.id+'/Users/'+connectedUser.profile_picture"  width="50px" >
                </div>
                <div v-else>
                    <img src="/images/resources/s1.png" alt="">
                </div>
                <div class="sgt-text">
                    <h4>{{connectedUser.name}}</h4>
                </div>
            </router-link>
        </div>
        <div class="view-more">
            <a href="#" title="">View More</a>
        </div>
    </div><!--suggestions-list end-->    
    </div>
</template>

<script>
export default {
    name: 'Friends',
    data() {
     return { 
        name:"",
        userId:"",
        connectedUsers:{},
      };
  },
    mounted(){
       this.userId = window.location.href.split('/').pop();
       this.get_connected_users();
    },
  methods: {
      get_connected_users(){
             axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
            axios({ method: "GET", url: "/api/get-connected-users/"+this.userId}).then(
                result => {
                    this.connectedUsers = result.data.connectedUsers;
                    console.log(this.connectedUsers);
                },
                error => {
                console.error(error);
                }
            );
        },
  }
}
</script>