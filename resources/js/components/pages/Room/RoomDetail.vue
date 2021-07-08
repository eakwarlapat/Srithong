<template>
  <div class="content-header mt-4">
    <div class="container-fluid">
      <div class="row mb-4 justify-content-between">
        <div class="col-md-6">
          <h1 class="m-0">ข้อมูลห้องพัก ห้อง {{ roomDetail.room_number }}</h1>
        </div>
        <div v-if="renter.rent_status === 1" class="col-md-4">
          <button class="btn btn-danger" @click="Leave">
            <i class="fas fa-sign-out-alt mr-2"></i>ลบข้อมูลผู้เช่า (กรณีย้ายออก)
          </button>
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
          <input v-if="roomDetail.room_type === 1" class="form-control" value="ห้องพัดลม" readonly />
          <input v-else class="form-control" value="ห้องแอร์" readonly />
        </div>
        <div class="col-md-4 mb-3">
          <label for="status">สถานะห้องเช่า</label>
          <input v-if="roomDetail.room_status === 1" class="form-control" value="ห้องว่าง" readonly />
          <input v-else class="form-control" value="ห้องไม่ว่าง" readonly />
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-4">
          <label for="internet">สถานะการใช้อินเตอร์เน็ต</label>
          <input
            v-if="roomDetail.internet === 1"
            class="form-control"
            value="ใช้งานอินเตอร์เน็ต"
            readonly
          />
          <input v-else class="form-control" value="ไม่ใช้งานอินเตอร์เน็ต" readonly />
        </div>
        <div class="col-md-4 mb-3">
          <label for="price">ราดาห้องเช่า/เดือน</label>
          <input v-model="roomDetail.price" class="form-control" id="price" readonly />
        </div>
      </div>
      <div class="row justify-content-center mt-4">
        <router-link class="link" :to="{ name: 'RoomDetailEdit', params: { id: roomDetail.id } }">
          <button type="button" class="btn btn-warning">
            <i class="fas fa-building mr-2"></i>แก้ไขข้อมูลห้องเช่า
          </button>
        </router-link>
        <router-link
          v-if="roomDetail.room_status === 2"
          class="link"
          :to="{ name: 'RenterDetailEdit', params: { id: renter.id } }"
        >
          <button type="button" class="btn btn-warning ml-3">
            <i class="far fa-circle mr-2"></i>แก้ไขข้อมูลผู้เช่า
          </button>
        </router-link>
        <router-link class="link" :to="{ name: 'RenterAdd'}">
          <button
            v-if="roomDetail.room_status === 1"
            type="button"
            class="btn btn-success ml-3"
            @click="SetRoomId"
          >
            <i class="far fa-circle mr-2"></i>เพิ่มข้อมูลผู้เช่า
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
      test: false,
      roomDetail: {
        id: null,
        room_number: null,
        room_type: null,
        room_status: null,
        internet: null,
        price: null,
      },
      renter: {
        id: null,
        cus_name: null,
        cus_surname: null,
        cus_tel: null,
        cus_email: null,
        personalid: null,
        cus_add: null,
        rent_status: null,
        rooms_id: null,
      },
    };
  },
  created() {
    this.GetRoomDeTail();
  },
  methods: {
    GetRoomDeTail() {
      this.loading = true;
      axios.get(`/api/room/${this.$route.params.id}`).then((response) => {
        if (response.data.data.customer) {
          this.renter = {
            id: response.data.data.customer.id,
            cus_name: response.data.data.customer.cus_name,
            cus_surname: response.data.data.customer.cus_surname,
            cus_tel: response.data.data.customer.cus_tel,
            cus_email: response.data.data.customer.cus_email,
            personalid: response.data.data.customer.personalid,
            cus_add: response.data.data.customer.cus_add,
            rent_status: response.data.data.customer.rent_status,
            rooms_id: response.data.data.customer.rooms_id,
          };
        } else {
          this.renter = {
            cus_name: "-",
            cus_surname: "-",
            cus_add: "-",
            rent_status: 2,
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
    SetRoomId() {
      sessionStorage.setItem("RoomNum", this.roomDetail.room_number);
      sessionStorage.setItem("RoomId", this.roomDetail.id);
    },
    Leave() {
      this.$swal({
        title: "ต้องการย้ายออกผู้เช่า?",
        text: "(หากย้ายออกจะกลายเป็นห้องว่าง)",
        showDenyButton: true,
        confirmButtonText: `ตกลง`,
        denyButtonText: `ยกเลิก`,
      }).then((result) => {
        if (result.isConfirmed) {
          this.roomDetail = {
            id: this.roomDetail.id,
            room_number: this.roomDetail.room_number,
            room_type: this.roomDetail.room_type,
            room_status: 1,
            internet: this.roomDetail.internet,
            price: this.roomDetail.price,
          };
          axios.put(`/api/updateroom/${this.roomDetail.id}`, this.roomDetail);
          this.renter = {
            id: this.renter.id,
            cus_name: this.renter.cus_name,
            cus_surname: this.renter.cus_surname,
            cus_tel: this.renter.cus_tel,
            cus_email: this.renter.cus_email,
            personalid: this.renter.personalid,
            cus_add: this.renter.cus_add,
            rent_status: 2,
            rooms_id: null,
          };
          axios.put(`/api/updatecostomer/${this.renter.id}`, this.renter);
          this.$swal("ย้ายออกสำเร็จ!", "", "success");
          this.$router.push({ name: "home" });
        } else if (result.isDenied) {
          this.$swal("ยกเลิการย้ายออก", "", "info");
        }
      });
    },
  },
};
</script>