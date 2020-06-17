<template>
    <div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <!-- <div class="card card-default">
                    <div class="card-header">Admin Register</div>
                    <div class="card-body">
                        <form  @submit.prevent="AdminRegistration">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" v-model="name" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" @change="check_email_exist"  required>
                                </div>
                                <div v-if="emailTaken && email">
									<p class="text-danger">Email Exists!!</p>
							    </div>  
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control" v-model="phone" @change="check_phone_exist"  required>
                                </div>
                                <div v-if="phoneTaken && phone">
									<p class="text-danger">phone Exists!!</p>
								</div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" v-model="confirm_password" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div v-if="!loading" class="col-md-6 offset-md-4">
                                    <button v-if="!phoneTaken && !emailTaken " type="submit" class="btn btn-primary" > Register </button>
                                    
                                    <button v-else class="btn btn-primary" disabled> Register</button>

                                </div>
                                <div v-else class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" disabled > Register </button>
                                </div>
                                <router-link class="text-primary" to="/controller-login">Login now!</router-link>
                            </div>
                        </form>
                    </div>
                </div> -->
                   <div class="card">
                    <article class="card-body">
                        <router-link to="/controller-login" class="float-right btn btn-outline-primary">Sign in</router-link>
                        <h4 class="card-title mb-4 mt-1">Sign up</h4>
                        <hr>
                        <form @submit.prevent="AdminRegistration">
                            <div class="form-group">
                                <input id="name" type="text" class="form-control" v-model="name" placeholder="Fullname" required>
                            </div>
                            <div class="form-group">
                                <input name="" class="form-control" placeholder="Email or Username" v-model="email" type="email">
                                <div v-if="emailTaken && email">
									<p class="text-danger">Email exists!</p>
							    </div>
                            </div>
                            <div class="form-group">
                                <input id="phone" type="tel" class="form-control" v-model="phone" @change="check_phone_exist" placeholder="Phone"  required>
                                <div v-if="phoneTaken && phone">
									<p class="text-danger">Phone no. exits!</p>
								</div>
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control" v-model="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" v-model="confirm_password" placeholder="Confirm Password" required>
                            </div> <!-- form-group// -->                                     
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" v-if="!loading">
                                        <button v-if="!phoneTaken && !emailTaken " type="submit" class="btn btn-primary btn-block" > Register </button>
                                        <button v-else class="btn btn-primary btn-block" disabled> Register</button>
                                    </div> <!-- form-group// -->
                                    <div v-else class="form-group">
                                        <button class="btn btn-primary btn-block" disabled > Register </button>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <router-link class="small" to="/controller-login">Already registered? Sign in.</router-link>
                                </div>                                            
                            </div> <!-- .row// -->                                                                  
                        </form>
                    </article>
                    </div> 
            </div>
        </div>

        <!-- <FooterBar/> -->
    </div>
</template>

<script>
import FooterBar from '@/components/admin/FooterBar';

export default {
    name: 'ControllerSignup',
    props : ['nextUrl'],
    components: {
        FooterBar
    },
    data(){
        return {
            name : "",
            email : "",
            phone: "",
            password : "",
            confirm_password : "",
       
            emailTaken: false,
            phoneTaken: false,
            loading: false
        }
    },
    methods : {
        check_email_exist(){
            axios.get('api/check-email-exist/'+this.email)
                .then((response) => {
                    if (response.data.response == "error"){
                        this.emailTaken=true;
                    }
                    if(response.data.response == 'success'){
                        this.emailTaken = false;
                    }
                });
        },
        check_phone_exist(){
            axios.get('api/check-phone-exist/'+this.phone)
                .then((response) => {
                    if (response.data.response == "error"){
                        this.phoneTaken=true;
                    }
                    if(response.data.response == 'success'){
                        this.phoneTaken = false;
                    }
                });
        },
        AdminRegistration(e) {
            e.preventDefault()
            if (this.password !== this.confirm_password || this.password.length <= 0) {
                this.password = ""
                this.confirm_password = ""
                return alert('Passwords do not match')
            }
            this.loading = true;
            let name = this.name
            let email = this.email
            let phone = this.phone
            let password = this.password
            let confirm_password = this.confirm_password
            axios.post('api/controller-register', {name, email,phone, password, confirm_password}).then(response => {               
                let data = response.data
                localStorage.setItem('TTNetwork.user', JSON.stringify(data.user))
                localStorage.setItem('TTNetwork.jwt', data.token)
                if (localStorage.getItem('TTNetwork.jwt') != null) {
                    this.$emit('loggedIn')
                    let nextUrl = this.$route.params.nextUrl
                    this.$router.push((nextUrl != null ? nextUrl : '/send-verification-email'))
                }
            })
        }
    }
}
</script>