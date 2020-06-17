<template>
  <div>
    <header>
      <div class="container">
        <div class="header-data">
          <div class="logo">
            <p class="h4 text-light">TTN</p>
          </div>
          <div class="search-bar">
            <form @submit.prevent="keyword()" class="">
              <input @blur="hidden" v-model="search" type="text" autocomplete="off" name="search" placeholder="Search..." />
              <!-- <Loader v-if="shouldShowLoader" />  -->
              <ul class="auto-search-results" v-if="searchResults && !hide">
                <router-link v-for="user in searchResults" :key="user.id" :to="'/user-profile/'+user.id"><li>
                  <div class="row">
                    <div class="col-2">
                      <div style="width: 30px" v-if="user.profile_picture">
                    <img :src="'/storage/uploads/' +user.id +'/Users/' + user.profile_picture" />
                  </div>
                  <div style="width: 30px" v-else>
                    <img :src="'/Images/profile/profile_logo.png'" />
                  </div>
                    </div>
                    <div class="col-10 mt-2">{{user.name}}</div>
                  </div>
                </li></router-link>
              </ul>
              <button type="submit">
                <i class="fa fa-search"></i>
              </button>
            </form>
          </div>
          <nav>
            <ul>
              <li>
                <router-link to="/feed">
                  <span>
                    <img src="/images/icon1.png" alt />
                  </span>
                  Home
                </router-link>
                <!-- <router-link v-else to="/">
										<span><img src="/images/icon1.png" alt=""></span>
											Home
                </router-link>-->
              </li>
              <li>
                <router-link to="/events">
                  <a>  <span> <img src="/images/icon3.png" alt />  </span>  Events </a>
                </router-link>
              </li>
              <li>
                <router-link to="/jobs">
                  <a>  <span> <img src="/images/icon5.png" alt /> </span> Jobs  </a>
                </router-link>
              </li>
              <li>
                <router-link :to="{name: 'UserProfile', params: { id: userData.id}}">
                  <a>  <span> <img src="/images/icon4.png" alt />  </span>  Profiles  </a>
                </router-link>
              </li>
              <li>
                <router-link to="/forum">
                  <span>
                    <img src="/images/f.jpg" style="width: 13px;" alt />
                  </span>
                  Forums
                </router-link>
              </li>
              <li>
                <a href="#" title class="not-box-openm">
                  <span>
                    <img src="/images/icon6.png" alt />
                  </span>
                  Messages
                </a>
                <div class="notification-box msg" id="message">
                  <div class="nt-title">
                    <h4>Setting</h4>
                    <a href="#" title>Clear all</a>
                  </div>
                  <div class="nott-list">
                    <div class="notfication-details">
                      <div class="noty-user-img">
                        <img src="/images/resources/ny-img1.png" alt />
                      </div>
                      <div class="notification-info">
                        <router-link to="/messages">
                          <h3>
                            <a href="messages.html" title>Jassica William</a>
                          </h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
                          <span>2 min ago</span>
                        </router-link>
                      </div>
                    </div>
                    <div class="notfication-details">
                      <div class="noty-user-img">
                        <img src="/images/resources/ny-img2.png" alt />
                      </div>
                      <div class="notification-info">
                        <h3>
                          <a href="messages.html" title>Jassica William</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet.</p>
                        <span>2 min ago</span>
                      </div>
                    </div>
                    <div class="notfication-details">
                      <div class="noty-user-img">
                        <img src="/images/resources/ny-img3.png" alt />
                      </div>
                      <div class="notification-info">
                        <h3>
                          <a href="messages.html" title>Jassica William</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore et dolore magna aliqua.</p>
                        <span>2 min ago</span>
                      </div>
                    </div>
                    <div class="view-all-nots">
                      <a href="messages.html" title>View All Messsages</a>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <a @click.once="getNotification" href="javascript:void(0);" title class="not-box-open">
                  <span>
                    <i class="fa fa-bell" aria-hidden="true"></i><span v-show="notificationCount > 0" style="padding: 1px 4px" class="badge badge-danger">{{ notificationCount }}</span>
                  </span> 
                  Notifications
                </a>
                <div class="notification-box noti" id="notification">
                  <div class="nt-title">
                    <h4>Setting</h4>
                    <a href="#" title>Clear all</a>
                  </div>
                  <div class="nott-list">
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
                    <div class="view-all-nots">
                      <router-link :to="'/profile-setting/'+userData.id+''" title>View All Notification</router-link>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </nav>
          <div class="menu-btn">
            <a href="#" title>
              <i class="fa fa-bars"></i>
            </a>
          </div>
          <div class="user-account">
            <div class="user-info">
              <div v-if="userData.profile_picture">
                <img
                  class="rounded-circle"
                  v-bind:src="'/storage/uploads/'+userData.id+'/Users/'+userData.profile_picture"
                  width="40px"
                />
              </div>
              <div v-else>
                <img
                  class="rounded-circle"
                  v-bind:src="'/images/profile/profile_logo.png'"
                  width="40px"
                />
              </div>
              <a href="#" title>{{userData.name}}</a>
              <i class="la la-sort-down"></i>
            </div>
            <div class="user-account-settingss">
              <h3>Setting</h3>
              <ul class="us-links">
                <li>
                  <a href="/profile-account" title>Account Setting</a>
                </li>
                <li>
                  <a href="#" title>Terms & Conditions</a>
                </li>
              </ul>
              <h3 class="tc">
                <a href="#" @click.prevent="logout">Logout</a>
              </h3>
            </div>
          </div>
        </div>
      </div>
    </header>
  </div>
</template>

<script>
// import ScriptLoader from '@/mixins/ScriptLoader';
import Loader from '@/components/Loader';

export default {
  name: "Header",
  // mixins: [ScriptLoader],
  components: {
    Loader
  },

  data() {
    return {
      name: "",
      profile_picture: "",
      notifications: {},
      searchResults: {},
      notificationCount: "",
      search: "",
      hide: false,
      awaitingSearch: false,
      shouldShowLoader: false,
      base_url: base_url,
      userData: JSON.parse(localStorage.getItem("TTNetwork.user"))
    };
  },
  mounted() {
		// this.loadJsScripts("user");
    this.check_notifications();
  },
  watch: {
    search: function(val) {

        if (!this.awaitingSearch) {
          setTimeout(() => {
          this.searchResults = null;
          this.hide = false;
          if(this.search.length >= 2){
            this.shouldShowLoader = true;
              axios.defaults.headers.common["Authorization"] =
              "Bearer " + localStorage.getItem("TTNetwork.jwt");
              axios.post(`/api/search`, { 
                  fromUserId: this.userData.id, 
                  keyword: this.search, 
                  table_name: "users" })
                .then(result => {
                  this.searchResults = result.data.result.users;
                  this.myConnections = result.data.myConnections;
                  this.shouldShowLoader = false;
                });
            }
            this.awaitingSearch = false;
          }, 1000);
        }
        this.awaitingSearch = true;
      }
  },
  methods: {
    
    keyword() {
      let keyword = this.search;
      this.$router.push("/search/" + keyword);
      location.reload();
    },
    check_notifications(){
      axios({
        method: "GET",
        url: "/api/check-notification/" + this.userData.id
      }).then(
        result => {
          this.notificationCount = result.data;
        },
        error => {
          console.error(error);
        }
      );
    },
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
    },
    acceptConnection(notification) {
      axios
        .post(`/api/accept-connection`, {
          from: notification.data.id,
          to: notification.notifiable_id
        })
        .then(res => {
          console.log("User Connected");
        })
        .catch(err => {
          console.log(err);
        });
    },
    blockConnection(notification) {
      axios
        .post(`/api/block-connection`, {
          from: notification.data.id,
          to: notification.notifiable_id
        })
        .then(res => {
          console.log("User Block");
        })
        .catch(err => {
          console.log(err);
        });
    },
    logout(){
      axios.get('api/logout').then(response => {
          localStorage.removeItem("TTNetwork.jwt");

          // remove any other authenticated user data you put in local storage

          // Assuming that you set this earlier for subsequent Ajax request at some point like so:
          // axios.defaults.headers.common['Authorization'] = 'Bearer ' + auth_token ;
          delete axios.defaults.headers.common['Authorization'];

          // If using 'vue-router' redirect to login page
          this.$router.go('/login');
        })
        .catch(error => {
          // If the api request failed then you still might want to remove
          // the same data from localStorage anyways
          // perhaps this code should go in a finally method instead of then and catch
          // methods to avoid duplication.
          localStorage.removeItem("TTNetwork.user");
          delete axios.defaults.headers.common['Authorization'];
          this.$router.push('/sign-in');
        }); 
      },
      hidden(){
          if (!this.awaitingSearch) {
            setTimeout(() => {
              this.hide = true;
              this.awaitingSearch = false;
            }, 500); // 1 sec delay
          }
          this.awaitingSearch = true;
      }      
    }
};
</script>