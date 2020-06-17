<template>
    <div>  
		<div class="user-profile-ov">
			<h3>Interest Groups<a href="javascript:void(0);" title="" class="skills-open"></a> </h3>
			<form  @submit.prevent="update_user_interest_groups">
				<ul>
					<li v-for="(interestGroup, index) in interestGroups" v-bind:key="index" >
						<div v-if="index != 0">
								<input type="checkbox" :value="index"   v-model="interestedGroupIds"> {{interestGroup}} 
						</div>
					</li>
				</ul>
				<button type="submit" class="save float-right">Save Change</button>	
			</form>		
		</div>
		
    </div>
</template>
<script>
export default {
    name: 'InterestedGroup',
    data() {
        return { 
                interestGroups:{},
                interestedGroupIds: [],
            };
     },
     mounted() {
		this.get_interest_groups();
		this.get_user_interested_groups();
 	 },

  methods: {     
      	get_interest_groups() {	
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
			axios({ method: "GET", url: "/api/get-interest-groups" }).then(
				result => {
					this.interestGroups = result.data.interestGroups;
					console.log(this.interestGroups);   
				},
				error => {
				console.error(error);
				}
			);
		},
		get_user_interested_groups() {	
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
			axios({ method: "GET", url: "/api/get-user-interested-groups/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id }).then(
				result => {
					this.interestedGroupIds = result.data.userInterestedGroupIds;  
					// console.log(this.interestedGroupIds);
				},
				error => {
				console.error(error);
				}
			);
	    },
  		update_user_interest_groups() {
			axios
			.put("/api/update-user-interest-groups/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
				interestedGroupIds : this.interestedGroupIds,
			})
			.then(res => {
				this.get_user_interested_groups();
				toast.fire({icon: "info", title: "Interested group updated  successfully"});
			})
			.catch(err => {	
				toast.fire({icon: "info", title: "Interested group can't updated"});
				console.log(err);
			});
		},
    }
}
</script>