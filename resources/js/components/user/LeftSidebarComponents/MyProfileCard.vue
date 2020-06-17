<template>
    <div>
        <div class="user-data full-width">
            <div class="user-profile">
                <div class="username-dt">
                    <div class="usr-pic">
                        <img
                        v-if="user_profile.profile_picture"
                        v-bind:src="
                            '/storage/uploads/' +
                            user_profile.id +
                            '/Users/' +
                            user_profile.profile_picture
                        "
                        />
                        <img v-else :src="'/Images/profile/profile_logo.png'" />
                    </div>
                </div>
                <!--username-dt end-->
                <div class="user-specs">
                    <h3>{{user_profile.name}}</h3>
                    <span>Web Developer</span>
                </div>
            </div>
            <!--user-profile end-->
            <ul class="user-fw-status">
                <li>
                    <h4>Following</h4>
                    <span>34</span>
                </li>
                <li>
                    <h4>Followers</h4>
                    <span>155</span>
                </li>
                <li>
                <a href="my-profile.html" title>View Profile</a>
                </li>
            </ul>
            </div>
            <!--user-data end-->
    </div>
</template>

<script>
    export default {
        name: "MyProfileCard",
        data() {
            return {
                user_profile: JSON.parse(localStorage.getItem("TTNetwork.user"))
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>