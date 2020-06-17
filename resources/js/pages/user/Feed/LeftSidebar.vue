<template>
    <div class="col-lg-3 col-md-4 pd-left-none no-pd">
            <div class="main-left-sidebar no-margin">
                <MyProfileCard />
                <Suggestions />
                <LeftSidebarFooter />  
            </div>
            <!--main-left-sidebar end-->
        </div>
</template>

<script>
import MyProfileCard from "@/components/user/LeftSidebarComponents/MyProfileCard";
import Suggestions from "@/components/user/LeftSidebarComponents/Suggestions";
import LeftSidebarFooter from "@/components/user/LeftSidebarComponents/LeftSidebarFooter";
    export default {
        name: "LeftSidebar",
        components: {
            MyProfileCard,
            Suggestions,
            LeftSidebarFooter
        }
    }
</script>

<style lang="scss" scoped>

</style>