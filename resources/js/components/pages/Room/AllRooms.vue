<template>
  <div>
    <div class="container-fluid mt-4">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">ข้อมูลห้องพัก</h1>
        </div>
      </div>
      <hr />
      <ul class="pagination justify-content-center mt-4">
        <li class="page-item" v-for="page in pagination.last_page" :key="page" :class="{active: pagination.current_page === page}">
          <a class="page-link" href="#" @click="fetchData(pagination.path_page + page)">
            ชั้น {{ page }}
            <span class="sr-only">(current)</span>
          </a>
        </li>
      </ul>
      <div class="text-center" style="margin-top: 150px" v-if="loading">
        <div class="spinner-border" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div class="row" v-else>
        <div v-for="(room, index) in rooms" :key="index" class="col-md-3 mt-4 d-flex align-items-stretch">
          <div class="card w-100">
            <router-link class="link" :to="{ name: 'RoomDetail', params: { id: room.id } }">
              <h5 class="card-header bg-secondary text-white">ห้อง {{ room.room_number }}</h5>
            </router-link>
            <div class="card-body">
              <p class="card-text" v-if="room.customer === null">ชื่อผู้เช่า: -</p>
              <p class="card-text" v-else>ชื่อผู้เช่า: {{ room.customer.cus_name }}</p>
              <p class="card-text" v-if="room.room_type === 2">ประเภท: ห้องแอร์</p>
              <p class="card-text" v-else>ประเภท: พัดลม</p>
              <p class="card-text" v-if="room.room_status === 1">
                สถานะ
                <span class="badge badge-pill badge-success">ว่าง</span>
              </p>
              <p class="card-text" v-else>
                สถานะ
                <span class="badge badge-pill badge-danger">ไม่ว่าง</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      rooms: null,
      pagination: {
        current_page: null,
        path_page: null,
        last_page: null,
      },
      page: null,
    };
  },
  created() {
    this.loading = true;
    this.GetRoom();
  },
  methods: {
    GetRoom() {
      axios.get("api/allroom").then((response) => {
        (this.rooms = response.data.data), this.GetPaginate(response);
        this.loading = false;
      });
    },
    fetchData(pagi) {
      this.loading = true;
      axios.get(pagi).then((response) => {
        (this.rooms = response.data.data), this.GetPaginate(response);
        this.loading = false;
      });
    },
    GetPaginate(response) {
      this.pagination = {
        current_page: response.data.meta.current_page,
        path_page: response.data.meta.path + "?page=",
        last_page: response.data.meta.last_page,
      };
    },
  },
};
</script>

<style scoped>
h5:hover {
  border-left: 3px solid #d19b3d;
  background-color: #3490dc !important;
}

.link {
  text-decoration: none;
}
</style>