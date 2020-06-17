<template>
    <div>
		<div class="product-feed-tab current" id="user-posts">
            <PostCard :posts="userPosts" />
        </div>
    </div>
</template>

<script>
import PostCard from "@/components/user/Post/PostCard";
export default {
    name: 'Posts',
    components: {
        PostCard,
    },
    data() {
     return { 
        userPosts:{},
        userId:"",
      };
  },
     mounted() {
        this.userId = window.location.href.split('/').pop();
        this.get_user_posts();
    },
     methods: {
     	get_user_posts() {	
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
			axios({ method: "GET", url: "/api/get-user-posts/"+this.userId}).then(
				result => {
                    this.userPosts = result.data.userPosts;
                    // this.userPosts = this.userPosts.localStorage.getItem('TTNetwork.user');
					console.log(this.userPosts);  
				},
				error => {
				console.error(error);
				}
			);
		},
     }
}
</script>