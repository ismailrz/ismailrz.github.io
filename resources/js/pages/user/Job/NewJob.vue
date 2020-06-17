<template>
  	<div>
        <div class="wrapper">
            <Header/>
            <main>
                <div class="main-section">
                    <div class="container">
                        <div class="main-section-data">
                            <div class="row">
                                <div class="col-lg-3">
                                    <JobLeftSidebar/>
                                </div>
                                <div class="col-lg-6">
                                    <div class="acc-setting">
                                    <CreateOrUpdateJob/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <JobRightSidebar/>
                                </div>
                            </div>
                        </div><!-- main-section-data end-->
                    </div> 
                </div>
            </main>
        </div>
        <Footer/>	  
	</div>
</template>
<script>
import Header from '@/components/user/Header';
import Footer from '@/components/user/Footer';
import JobLeftSidebar from '@/components/user/Job/JobLeftSidebar';
import JobRightSidebar from '@/components/user/Job/JobRightSidebar';
import CreateOrUpdateJob from '@/components/user/Job/CreateOrUpdateJob';
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
    name: 'NewJob',
    mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        CreateOrUpdateJob,
        JobLeftSidebar,
        JobRightSidebar,
    },
    mounted() {
        this.loadStyleSheets("user");
        this.loadJsScripts("user");
    },
};
</script>

