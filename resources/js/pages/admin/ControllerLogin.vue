<template>
    <div>
         <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <!-- <div class="card card-default">
                    <div class="card-header">Admin Login</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" v-model="email" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" v-model="password" required>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="admin_login">
                                        Login
                                    </button>
                                  <router-link class="text-default btn btn-default btn-sm" to="/controller-signup">Create one!</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                     <div v-if="!validUser" class="card-footer" >
                            <p class="text-danger text-center">
                                Incorrect Email and/or Password!
                            </p>
                            <p class="text-center">Please enter valid email and/or password.</p>
                     </div>
                     <div v-if="Inactive" class="card-footer" >
                            <p class="text-danger text-center">
                                Your account does not active
                            </p>
                            <p class="text-center">Please wait  for verified by another admin or contact with admin.</p>
                     </div>
                </div> -->
                <div class="card">
                <article class="card-body">
                    <router-link to="/controller-signup" class="float-right btn btn-outline-primary">Sign up</router-link>
                    <h4 class="card-title mb-4 mt-1">Sign in</h4>
                    <hr>
                    <form>
                        <div class="form-group">
                            <input name="" class="form-control" placeholder="Email or Username" v-model="email" type="email">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <input class="form-control" placeholder="******" v-model="password" type="password">
                        </div> <!-- form-group// -->                                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" @click="admin_login"> Login  </button>
                                </div> <!-- form-group// -->
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="small" href="#">Forgot password?</a>
                            </div>                                            
                        </div> <!-- .row// -->                                                                  
                    </form>
                </article>
                <div v-if="!validUser" class="card-footer" >
                            <p class="text-danger text-center">
                                Incorrect Email and/or Password!
                            </p>
                            <p class="text-center">Please enter valid email and/or password.</p>
                     </div>
                     <div v-if="Inactive" class="card-footer" >
                            <p class="text-danger text-center">
                                Your account is not active!
                            </p>
                            <p class="text-center">Please wait for approval by another admin or contact with an admin.</p>
                     </div>
                </div> <!-- card.// -->
            </div>
         </div>
         <!-- <FooterBar/> -->
    </div>
</template>

<script>
import FooterBar from '@/components/admin/FooterBar';

export default {
    name: 'ControllerLogin',
    components: {
        FooterBar
    },
    data() {
            return {
                email: "",
                password: "",

                validUser: true,
                Inactive: false,
                loading: false,
            }
        },
        methods: {
            admin_login(e) {
                e.preventDefault()
                 if (this.password.length > 0) {
                    let email = this.email;
                    let password = this.password;
                    axios.post("api/controller-login", { email, password }).then(response => {
                    this.loading = true;
                    this.validUser = true;
                    let user = response.data.user;
                    let role_id = user.role_id;
                    let status = user.status;
                    localStorage.setItem("TTNetwork.user", JSON.stringify(user));
                    localStorage.setItem("TTNetwork.jwt", response.data.token);
                    if (localStorage.getItem("TTNetwork.jwt") != null) {
                        this.$emit("loggedIn");
                        if (this.$route.params.nextUrl != null) {
                            this.$router.push(this.$route.params.nextUrl);
                        } else {
                            this.$router.push(role_id == 1 && status == 10? "/controller-dashboard" : null);
                        }
                    }
                    }).catch((error) => {
                        console.log(error);
                        if (error.response.data.err == 'invalidAdmin') {
                            this.validUser = false;
                            this.Inactive = false; 
                        } else if(error.response.data.err == 'inActive') {
                          this.Inactive = true;
                          this.validUser = true;
                        }
                    });
                }
            }
        }
    }
</script>