<template>
  <div>
    <LeftSidebar/>

    <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <HeaderBar/>
                <div class="container-fluid" >                
                   <div class="row">
      <div class="col-md-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">
              Post Categories
            </h6>
          </div>

          <div class="card-body">
            <pagination
              :data="postCategories"
              @pagination-change-page="getData"
            ></pagination>
            <table class="table">
              <thead>
                <tr>
                  <td>Title</td>
                  <td>Description</td>
                  <td>Status</td>
                  <td>Options</td>
                </tr>
              </thead>

              <tbody>
                <tr v-for="postCategory in postCategories.data" v-bind:key="postCategory.id">
                  <td>{{ postCategory.title }}</td>
                  <td>{{ postCategory.descr }}</td>
                  <td>{{ postCategory.status }}</td>
                  <td v-if="edit == false">
                    <button
                      @click="editData(postCategory)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(postCategory.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(postCategory)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(postCategory.id)"
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
      <div class="col-md-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">
              Add new
            </h6>
          </div>
          <div class="card-body">
            <form @submit.prevent="addUpdate">
              <div class="form-group">
                <label class="req">Title</label>
                <input
                  type="text"
                  v-model="title"
                  class="form-control"
                  placeholder
                  required
                />
              </div>
              <div class="form-group">
                <label class="req">Description</label>
                <input
                  name="name"
                  type="text"
                  v-model="descr"
                  class="form-control"
                  placeholder
                  required
                />
              </div>
              <div class="form-group">
                <label class="req">Status</label>
                <select class="form-control" v-model="status" required>
                  <option
                    v-for="(status, index) in statuses" :key="status"
                    v-bind:value="index"
                    >{{ status }}</option
                  >
                </select>
              </div>
              <div v-if="edit == false">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
              <div v-else>
                <button type="submit" class="btn btn-primary">Update</button>
                <button @click="clearForm()" class="btn btn-danger">
                  Cancel
                </button>
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
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: 'ControllerPostCategory',
  mixins: [ScriptLoader],
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar
  },
  data() {
    return {
      postCategories: {},
      id: "",
      title: "",
      descr: "",
      status: "",
      statuses: {},
      edit: false
    };
  },

  mounted() {
    this.loadStyleSheets("controller");
    this.loadJsScripts("controller");
    this.getData();
  },

  methods: {
    getData(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

      axios({ method: "GET", url: "/api/post-categories?page=" + page }).then(
        result => {
          console.log(result.data);
          this.postCategories = result.data.postCategories;
          this.statuses = result.data.status;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addUpdate() {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

      if (this.edit == false) {
        axios
          .post("/api/post-categories", {
            title: this.title,
            descr: this.descr,
            status: this.status
          })
          .then(res => {
            this.title = "";
            this.descr = "";
            this.status = "";
            this.getData();
            toast.fire({
              icon: "success",
              title: "Saved!"
            });
          })

          .catch(err => {
            console.log(err);
          });
      } else {
        //update
        axios
          .put(`/api/post-categories/${this.id}`, {
            title: this.title,
            descr: this.descr,
            status: this.status
          })
          .then(res => {
            this.title = "";
            this.descr = "";
            this.status = "";
            this.getData();
            this.edit = false;
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

    editData(postCategory) {
      this.id = postCategory.id;
      this.title = postCategory.title;
      this.descr = postCategory.descr;
      this.status = postCategory.status;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

        axios
          .delete(`/api/post-categories/${id}`)
          .then(res => {
            this.title = "";
            this.getData();
            console.log(res);
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
      this.id = null;
      this.title = "";
      this.descr = null;
      this.status = null;
    }
  }
};
</script>

<style lang="scss" scoped></style>
