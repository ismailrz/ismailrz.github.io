<template>
    <div>
		<div class="user-profile-ov">
			<h3> All Notifications</h3>
			<div v-for="notification in notifications" :key="notification.id" class="notfication-details" >
			<div v-if="notification.data.notification_type == 'connection'">
				<div class="noty-user-img">
					<img
					class="rounded-circle" v-if="notification.data.profile_picture"
					v-bind:src="'/storage/uploads/'+userData.id+'/Users/'+userData.profile_picture"
					/>
					<img
					class="rounded-circle" v-else
					v-bind:src="'/images/profile/profile_logo.png'"
					/>
				</div>
				<div class="notification-info">
					<h3>
						<a href="#" title>{{notification.data.name}}</a> Sent You a Connection Request
					</h3>
					<button
					@click="acceptConnection(notification)"
					class="btn btn-success btn-sm"
					>Accept</button>
					<button
					@click="blockConnection(notification)"
					class="btn btn-warning btn-sm"
					>Block</button>
				</div>
				</div>
				<div v-else-if="notification.data.type == 'Job'">
				
				<div v-if="notification.type == 'App\\Notifications\\CommentNotification'
					" class="notification-info">
					<h3>
					<router-link :to="'/user_profile/'+notification.data.id" title>{{notification.data.name}}</router-link> commented on your <router-link :to="'/job/'+notification.data.type_id" title>job</router-link>
					</h3>
				</div>

				<div v-if="notification.type == 'App\\Notifications\\ShareNotification'
					" class="notification-info">
					<h3>
					<router-link :to="'/job/'+notification.data.type_id" title>{{notification.data.name}}</router-link> shared your <router-link :to="'/job/'+notification.data.type_id" title>job</router-link>
					</h3>
				</div>

				<div v-if="notification.type == 'App\\Notifications\\LikeOnCommentNotification'
					" class="notification-info">
					<h3>
					<router-link :to="'/job/'+notification.data.type_id" title>{{notification.data.name}}</router-link> liked your comment in this job<router-link :to="'/job/'+notification.data.type_id" title>job</router-link>
					</h3>
				</div>
				
				</div>
				<div v-else-if="notification.data.type == 'Post'">
				
				<div v-if="notification.type == 'App\\Notifications\\LikeNotification'
					" class="notification-info">
					<h3>
					<router-link :to="'/user_profile/'+notification.data.id" title>{{notification.data.name}}</router-link> liked your <router-link :to="'/job/'+notification.data.type_id" title>post</router-link>
					</h3>
				</div>

				<div v-else-if="notification.type == 'App\\Notifications\\CommentNotification'
					" class="notification-info">
					<h3>
					<router-link :to="'/user_profile/'+notification.data.id" title>{{notification.data.name}}</router-link> commented on your <router-link :to="'/post/'+notification.data.type_id" title>post</router-link>
					</h3>
				</div>

				<div v-if="notification.type == 'App\\Notifications\\ShareNotification'
					" class="notification-info">
					<h3>
					<router-link :to="'/post/'+notification.data.type_id" title>{{notification.data.name}}</router-link> shared your <router-link :to="'/post/'+notification.data.type_id" title>post</router-link>
					</h3>
				</div>

				<div v-if="notification.type == 'App\\Notifications\\LikeOnCommentNotification'
					" class="notification-info">
					<h3>
					<router-link :to="'/post/'+notification.data.type_id" title>{{notification.data.name}}</router-link> liked your comment in this post<router-link :to="'/post/'+notification.data.type_id" title>post</router-link>
					</h3>
				</div>
				
				</div>

				<div v-else></div>
			</div>
		</div>
    </div>                        
</template>

<script>
export default {
    name: 'Education',
    data() {
        return { 
			notifications: {},
      		userData: JSON.parse(localStorage.getItem("TTNetwork.user"))
        };
    },
	mounted(){
		this.getNotification();
	},
  	methods: {
	getNotification() {
		axios({
			method: "GET",
			url: "/api/get-notification/" + this.userData.id
		}).then(
			result => {
			this.notifications = result.data;
			},
			error => {
			console.error(error);
			}
		);
    }	
  }
}
</script>