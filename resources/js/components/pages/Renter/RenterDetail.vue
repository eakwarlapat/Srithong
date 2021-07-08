<template>
  <div class="content-header mt-4">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">ข้อมูลห้องผู้เช่า</h1>
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
        <div class="offset-2 col-md-4">
          <label for="room">ชื่อผู้เช่า</label>
          <input v-model="renters.cus_name" class="form-control" id="name" readonly />
        </div>
        <div class="col-md-4 mb-3">
          <label for="room">นามสกุลผู้เช่า</label>
          <input v-model="renters.cus_surname" class="form-control" id="surname" readonly />
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-8 mb-3">
          <label for="room">ที่อยู่ผู้เช่า</label>
          <input v-model="renters.cus_add" class="form-control" id="address" readonly />
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-4">
          <label for="type">Email</label>
          <input v-model="renters.cus_email" class="form-control" id="type" readonly />
        </div>
        <div class="col-md-4 mb-3">
          <label for="status">เบอร์โทร</label>
          <input v-model="renters.cus_tel" class="form-control" id="status" readonly />
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-4">
          <label for="internet">หมายเลขบัตรประจำตัวประชาชน</label>
          <input v-model="renters.personalid" class="form-control" id="internet" readonly />
        </div>
        <div class="col-md-4 mb-3">
          <label for="price">อาศัยอยู่ห้อง</label>
          <input v-if="room.room_number" v-model="room.room_number" class="form-control" id="price" readonly />
          <input v-else value="-" class="form-control" id="price" readonly />
        </div>
      </div>
      <div class="row justify-content-center mt-4">
        <router-link class="link" :to="{ name: 'RenterDetailEdit', params: { id: renters.id } }">
          <button type="button" class="btn btn-warning ml-3">
            <i class="far fa-circle mr-2"></i>แก้ไขข้อมูลผู้เช่า
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
      renters: {
        id: null,
        cus_name: null,
        cus_surname: null,
        cus_email: null,
        cus_add: null,
        cus_tel: null,
        personalid: null,
      },
      room: {
        room_number: null,
      },
    };
  },
  created() {
    this.loading = true;
    axios.get(`/api/customer-by/${this.$route.params.id}`).then((response) => {
      this.renters = response.data;
      if (response.data.rooms) {
        this.room = {
          room_number: response.data.rooms.room_number,
        };
      } else {
        this.room = {
          room_number: null,
        };
      }

      this.loading = false;
    });
  },
};
</script>