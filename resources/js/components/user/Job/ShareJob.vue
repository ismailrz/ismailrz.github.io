<template>
    <div>
        <div class="post-bar"> 
            <div class="row">
                <router-link :to="'/job-details/'+job.id">               
                      <p class="h4 text-justify font-weight-bold text-primary"> {{job.title}}</p>                     
                </router-link>               
            </div>
            <div class="row">
                <p class="text-justify card-text">{{job.organization_name}} <router-link :to="'/job-details/'+job.id">
                    &nbsp; view more 
               </router-link></p>               
            </div>
        </div> 
    </div>
</template>
<script>
export default {
    name: 'ShareJob',
    props: {
     job: Object,
    },   
}
</script>