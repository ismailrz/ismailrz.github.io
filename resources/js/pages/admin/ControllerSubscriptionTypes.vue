<template>
  <div>
    <LeftSidebar/>

    <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <HeaderBar/>
                <div class="container-fluid" >                
                   <div class="row">
      <div class="col-md-7">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Subscription Types</h6>
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Subscription Type Code</th>
                  <th scope="col">status</th>
                  <th scope="col">Options</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(subscriptionType) in subscriptionTypes" v-bind:key="subscriptionType.id">
                  <td>{{subscriptionType.title}}</td>
                  <td>{{subscriptionType.subscription_type_code}}</td>
                  <td>
                    <span v-if="subscriptionType.status == 10" class="badge badge-success">Active</span>
                    <span v-else class="badge badge-danger">Inactive</span>
                  </td>
                  <td v-if="edit == false">
                    <button @click="editData(subscriptionType)" class="btn btn-primary btn-sm btn-circle">
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(subscriptionType.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(subscriptionType)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(subscriptionType.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Add new</h6>
          </div>
          <div class="card-body">
            <form @submit.prevent="addUpdate" enctype="multipart/form-data">
              <div class="form-group">
                <label class="req">Title</label>
                <input v-model="title" type="text" class="form-control" placeholder required />
              </div>

              <div class="form-group">
                <label class="req">Code</label>
                <input type="text" class="form-control" v-model="subscription_type_code" placeholder required />
              </div>

              <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" v-model="descr" placeholder />
              </div>

              <div class="form-group">
                <label class="req">Status</label>
                <select class="form-control" v-model="status" required>
                  <option v-for="(status, index) in statuses" :key="status" :value="index">{{ status }}</option>
                </select>
              </div>
              <div v-if="edit == false">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
              <div v-else>
                <button type="submit" class="btn btn-primary">Update</button>
                <button @click="clearForm()" class="btn btn-danger">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
            </div>
        </div>

        <FooterBar/>
  </div>
</template>

<script>
import HeaderBar from '@/components/admin/HeaderBar';
import LeftSidebar from '@/components/admin/LeftSidebar';
import FooterBar from '@/components/admin/FooterBar';

export default {
  name: 'ControllerSubscriptionTypes',
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar
  },
  data() {
    return {
      subscriptionTypes: {},
      statuses: {},
      id: "",
      title: "",
      subscription_type_code: "",
      descr: "",
      status: "10",
      edit: false
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

      axios({ method: "GET", url: "/api/subscription-types" }).then(
        result => {
          console.log(result.data);
          this.subscriptionTypes = result.data.subscriptionTypes;
          this.statuses = result.data.status;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addUpdate() {
      if (this.edit == false) {
        axios
          .post("/api/subscription-types", {
            title: this.title,
            subscription_type_code: this.subscription_type_code,
            descr: this.descr,
            status: this.status
          })
          .then(res => {
            this.clearForm();
            this.getData();
            toast.fire({
              icon: "success",
              title: "Saved!"
            });
          })
          .catch(er => {
            console.log(err);
          });
      } else {
        //update
        axios
          .put(`/api/subscription-types/${this.id}`, {
            title: this.title,
            subscription_type_code: this.subscription_type_code,
            descr: this.descr,
            status: this.status
          })
          .then(res => {
            this.clearForm();
            this.getData();
            toast.fire({
              icon: "success",
              title: "Updated!"
            });
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    editData(subscriptionType) {
      this.id = subscriptionType.id;
      this.title = subscriptionType.title;
      this.subscription_type_code = subscriptionType.subscription_type_code;
      this.descr = subscriptionType.descr;
      this.status = subscriptionType.status;
      this.edit = true;
    },
    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/subscription-types/${id}`)
          .then(res => {
            this.id = "";
            this.getData();
            toast.fire({
              icon: "info",
              title: "Deleted!"
            });
          })
          .catch(err => {
            console.log(err);
          });
      }
    },
    clearForm() {
      this.edit = false;
      this.title = "";
      this.subscription_type_code = "";
      this.descr = "";
      this.status = "";
    }
  }
};
</script>

<style lang="scss" scoped>
</style>