<template>
  <div>
    <LeftSidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <HeaderBar />
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary float-left">Add new</h6>
                </div>
                <div class="card-body">
                  <CreateOrUpdateJob/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <FooterBar />
  </div>
</template>

<script>
import axios from "axios";
import ScriptLoader from '@/mixins/ScriptLoader';
import HeaderBar from "@/components/admin/HeaderBar";
import LeftSidebar from "@/components/admin/LeftSidebar";
import FooterBar from "@/components/admin/FooterBar";
import CreateOrUpdateJob from '@/components/admin/Job/CreateOrUpdateJob';
export default {
  mixins: [ScriptLoader],
  name: "ControllerJobCreate",
  components: {
    HeaderBar,
    CreateOrUpdateJob,
    LeftSidebar,
    FooterBar
  },

  mounted() {
     this.loadStyleSheets("controller");
     this.loadJsScripts("controller");
  }
}

</script>

<style lang="scss" scoped></style>
