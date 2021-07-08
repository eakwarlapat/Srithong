<template>
  <div class="content-header mt-4">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">แก้ไขข้อมูลห้องพัก ห้อง {{ roomDetail.room_number }}</h1>
        </div>
      </div>
      <hr />
    </div>
    <div class="text-center" style="margin-top: 150px" v-if="loading">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <div v-else>
      <div class="row">
        <div class="offset-2 col-md-2 mb-3">
          <label for="room">หมายเลขห้อง</label>
          <input v-model="roomDetail.room_number" class="form-control" id="room" readonly />
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-4">
          <label for="room">ชื่อผู้เช่า</label>
          <input v-model="renter.cus_name" class="form-control" id="name" readonly />
        </div>
        <div class="col-md-4 mb-3">
          <label for="room">นามสกุลผู้เช่า</label>
          <input v-model="renter.cus_surname" class="form-control" id="surname" readonly />
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-8 mb-3">
          <label for="room">ที่อยู่ผู้เช่า</label>
          <input v-model="renter.cus_add" class="form-control" id="address" readonly />
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-4">
          <label for="type">ประเภทห้อง</label>
          <select v-model="roomDetail.room_type" class="form-control">
            <option value="1">ห้องพัดลม</option>
            <option value="2">ห้องแอร์</option>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label for="status">สถานะห้องเช่า</label>
          <input v-if="roomDetail.room_status === 1" class="form-control" value="ห้องว่าง" readonly />
          <input v-else class="form-control" value="ห้องwไม่ว่าง" readonly />
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-4">
          <label for="internet">สถานะการใช้อินเตอร์เน็ต</label>
          <select class="form-control" v-model="roomDetail.internet">
            <option value="1">ไม่ใช้งานอินเตอร์เน็ต</option>
            <option value="2">ใช้งานอินเตอร์เน็ต</option>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label for="price">ราดาห้องเช่า/เดือน</label>
          <input v-model="roomDetail.price" class="form-control" id="price" />
        </div>
      </div>
      <div class="row justify-content-center mt-4">
        <button type="button" class="btn btn-success" @click="SaveRoomDetail">
          <i class="far fa-save mr-2"></i>Save
        </button>
        <button type="button" class="btn btn-primary ml-4" @click="Cancel">
          <i class="fas fa-redo mr-2"></i>reset
        </button>
        <router-link class="link" :to="{ name: 'home'}">
          <button type="button" class="btn btn-danger ml-4" @click="Cancel">
            <i class="far fa-times-circle mr-2"></i>cancel
          </button>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      roomDetail: {
        id: null,
        room_number: null,
        room_type: null,
        room_status: null,
        internet: null,
        price: null,
      },
      renter: {
        cus_name: null,
        cus_surname: null,
        cus_add: null,
      },
    };
  },
  created() {
    this.GetRoomDetail();
  },
  methods: {
    GetRoomDetail() {
      this.loading = true;
      axios.get(`/api/room/${this.$route.params.id}`).then((response) => {
        if (response.data.data.customer) {
          this.renter = {
            cus_name: response.data.data.customer.cus_name,
            cus_surname: response.data.data.customer.cus_surname,
            cus_add: response.data.data.customer.cus_add,
          };
        } else {
          this.renter = {
            cus_name: "-",
            cus_surname: "-",
            cus_add: "-",
          };
        }
        (this.roomDetail = {
          id: response.data.data.id,
          room_number: response.data.data.room_number,
          room_type: response.data.data.room_type,
          room_status: response.data.data.room_status,
          internet: response.data.data.internet,
          price: response.data.data.price,
        }),
          (this.loading = false);
      });
    },
    Cancel() {
      this.loading = true;
      axios.get(`/api/room/${this.$route.params.id}`).then((response) => {
        this.roomDetail = {
          room_number: response.data.data.room_number,
          cus_name: response.data.data.customer.cus_name,
          cus_surname: response.data.data.customer.cus_surname,
          cus_add: response.data.data.customer.cus_add,
          room_type: response.data.data.room_type,
          room_status: response.data.data.room_status,
          internet: response.data.data.internet,
          price: response.data.data.price,
        };
        this.room = response.data.rooms;
        this.loading = false;
      });
    },
    SaveRoomDetail() {
      this.$swal({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        confirmButtonText: `Save`,
        denyButtonText: `cancel`,
      }).then((result) => {
        if (result.isConfirmed) {
          axios.put(
            `/api/updateroom/${this.$route.params.id}`,
            this.roomDetail
          );
          this.$swal("Saved!", "", "success");
          this.$router.push({ name: "home" });
        } else if (result.isDenied) { 
          this.$swal("Changes are not saved", "", "info");
        }
      });
    },
  },
};
</script>