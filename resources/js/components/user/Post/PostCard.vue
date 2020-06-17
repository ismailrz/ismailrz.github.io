<template>
   <div>
            <div v-for="post in posts" :key="post.id" class="post-bar">
                      <div class="post_topbar">
                        <span v-if="post.is_article == 1" class="badge badge-pill badge-success float-right">Premium Article</span>
                        <div class="usy-dt">
                          <img
                            width="60"
                            v-if="post.user.profile_picture"
                            v-bind:src="
                                '/storage/uploads/' +
                                  post.user.id +
                                  '/Users/' +
                                  post.user.profile_picture
                              "
                              />

                          <img width="60" v-else v-bind:src="'/Images/profile/profile_logo.png'" />

                          <div class="usy-name">
                            <h3>{{post.user.name}}</h3>
                            <span>
                              <img width="13px" src="images/clock.png" alt />{{post.created_at | formatDate}} 
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="job_descp">
                        <h3>{{post.title}}</h3>

                        <p>
                          {{post.descr}}
                          <router-link :to="`/article/${post.id}`" title>view more</router-link>
                        </p>
                      </div>
                      <PostCardFooter :post="post" />
            </div>
    </div>
</template>

<script>
import PostCardFooter from "@/components/user/Post/PostCardFooter";
export default {
      name: "PostCard",
      props: {
        posts: {}
      },
      components: {
        PostCardFooter
      }
}
</script>

<style lang="scss" scoped>

</style>