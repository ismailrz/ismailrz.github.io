<template>
    <div>
        <div class="widget widget-jobs">
        <div class="sd-title">
            <h3>Featured Posts</h3>
            <i class="la la-ellipsis-v"></i>
        </div>
        <div v-for="post in posts" :key="post.id" class="jobs-list" style=" border-bottom: 1px solid #f5f5f5;">
            <div class="job-info">
                <div class="col-sm-12">
                    <h3 style="font-weight: bold; margin-bottom: 5px;">{{post.title}}</h3>
                    <p style="line-height: 15px;">{{post.descr}}</p>
                </div>
            </div>
        </div>
        <!--jobs-list end-->
        </div>
        <!--widget-jobs end-->
    </div>
</template>

<script>
    export default {
        name: "FeaturedPosts",
        data(){
            return {
                posts: {}
            }
        },
        mounted(){
            this.get_featured_posts();
        },
        methods: {
            get_featured_posts(){
                axios.defaults.headers.common["Authorization"] =
                    "Bearer " + localStorage.getItem("TTNetwork.jwt");
                axios
                    .post("/api/get-featured-posts")
                    .then(result => {
                    this.posts = result.data;
                    console.log(this.posts);
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>