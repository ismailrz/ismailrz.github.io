
<template>
  <div>
    <Header />
    <main>
      <div class="main-section">
        <div class="container">
          <div class="main-section-data">
            <div class="row">
              <LeftSidebar />
              <div class="col-lg-6 col-md-8 no-pd">
                <div class="main-ws-sec">
                  <div class="post-topbar row mb-3">
                    <div class="col-md-2">
                      <img width="60" v-if="profile_picture"
                        v-bind:src="'/storage/uploads/'+id +'/Users/'+profile_picture" />
                      <img width="60" v-else :src="'/Images/profile/profile_logo.png'" />
                    </div>
                    <div class="col-md-10">
                      <textarea v-model="postData" rows="2" placeholder="Share your thoughts..." class="form-control" required></textarea>
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6 share-buttons">
                          <router-link to="/"><i title="Write an article" class="fa fa-pencil-square-o" aria-hidden="true"></i></router-link>
                          <router-link to="/new-job"><i title="Post a job" class="fa fa-briefcase" aria-hidden="true"></i></router-link>
                          <router-link to="/new-event"><i title="Create an event" class="fa fa-calendar" aria-hidden="true"></i></router-link>
                          <router-link to="/"><i title="Post a ad" class="fa fa-shopping-cart" aria-hidden="true"></i></router-link>
                        </div>
                        <div class="col-md-6">
                          <button
                            @click="submit_post()"
                            class="btn btn-primary btn-sm float-right mt-3"
                          >Post</button>
                          <select class="float-right publish-options" v-model="visibility_status" required>
                            <option v-for="(status, index) in statuses" :key="index" :value="index">
                              {{ status }}
                            </option>
                          </select>
                          <p style="margin-top: 20px; margin-right: 10px; font-size: 13px; font-weight: bold; float: right">Post as ...</p>
                        </div>
                      </div>
                    </div>
                    <!--post-st end-->
                  </div>
                  <!--post-topbar end-->
                  <div class="posts-section">
                    <PostCard :posts="posts" />
                    <!--post-bar end-->
                    <div>
                      <ShowEventLists :showEvents="events" />
                    </div>
                    <div><div><ShowJobList :jobs="jobs" /></div></div>
                    <div class="process-comm">
                      <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                      </div>
                    </div>
                    <!--process-comm end-->
                  </div>
                  <!--posts-section end-->
                </div>
                <!--main-ws-sec end-->
              </div>
              <RightSidebar />
            </div>
          </div>
          <!-- main-section-data end-->
        </div>
      </div>
    </main>
    <Footer />
  </div>
</template>
<style scoped>
</style>
<script>
import Header from "@/components/user/Header";
import Footer from "@/components/user/Footer";
import PostCard from "@/components/user/Post/PostCard";
import LeftSidebar from "@/pages/user/Feed/LeftSidebar";
import RightSidebar from "@/pages/user/Feed/RightSidebar";
import ShowEventLists from "@/components/user/Event/ShowEventLists";
import ShowJobList from "@/components/user/Job/ShowJobList";
import ScriptLoader from "@/mixins/ScriptLoader";

export default {
  name: "Feed",
  mixins: [ScriptLoader],

  components: {
    Header,
    Footer,
    ShowEventLists,
    ShowJobList,
    PostCard,
    LeftSidebar,
    RightSidebar
  },
  data() {
    return {
      posts: {},
      statuses: {},
      events: [],
      jobs: [],
      postData: "",
      visibility_status: "10",
      id: JSON.parse(localStorage.getItem("TTNetwork.user")).id,
      profile_picture: JSON.parse(localStorage.getItem("TTNetwork.user"))
        .profile_picture
    };
  },
  mounted() {
    this.loadStyleSheets("user");
    this.loadJsScripts("user");
    this.get_feeds();
  },

  methods: {
    get_feeds() {
      axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("TTNetwork.jwt");
      axios
        .post("/api/get-feeds", {
          id: this.id,
          page: "1",
          limit: "5"
        })
        .then(result => {
          this.posts = result.data.posts.data;
          this.events = result.data.events.data;
          this.jobs = result.data.jobs.original.jobs.data;
          this.statuses = result.data.statuses;
        });
    },

    submit_post() {
      this.$Progress.start();
      axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("TTNetwork.jwt");
      let id = JSON.parse(localStorage.getItem("TTNetwork.user")).id;
      axios
        .post("/api/submit-post", {
          descr: this.postData,
          visibility_status: this.visibility_status,
          user_id: id
        })
        .then(result => {
          this.postData = "";
          this.get_feeds();
          toast.fire({ icon: "success", title: "Post Published!" });
        });
      this.$Progress.finish();
    }
  }
};
</script>

