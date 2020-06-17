<template>
    <div class="col-lg-3 pd-right-none no-pd">
    <div class="right-sidebar">
        <FeaturedPosts />
        <TopJob />
        <MostViewedPeople />
        </div>
    </div>
</template>

<script>
import FeaturedPosts from "@/components/user/RightSidebarComponents/FeaturedPosts";
import TopJob from "@/components/user/RightSidebarComponents/TopJob";
import MostViewedPeople from "@/components/user/RightSidebarComponents/MostViewedPeople";
    export default {
        name: "RightSidebar",
        components: {
            TopJob,
            MostViewedPeople,
            FeaturedPosts
        }
    }
</script>

<style lang="scss" scoped>

</style>