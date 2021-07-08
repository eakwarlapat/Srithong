<template>
  <div class="content-header mt-4">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">เพิ่มข้อมูลผู้เช่า ห้อง {{room_number }}</h1>
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
          <label for="name">ชื่อผู้เช่า</label>
          <input v-model.trim="$v.renter.cus_name.$model" class="form-control" id="name" :class="{'is-invalid': $v.renter.cus_name.$error}" />
          <div v-if="!$v.renter.cus_name.$required" class="invalid-feedback">กรุณากรอก ชื่อผู้เช่า</div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="room">นามสกุลผู้เช่า</label>
          <input v-model.trim="$v.renter.cus_surname.$model" class="form-control" id="surname" :class="{'is-invalid': $v.renter.cus_surname.$error}" />
          <div v-if="!$v.renter.cus_surname.$required" class="invalid-feedback">กรุณากรอก นามสกุลผู้เช่า</div>
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-8 mb-3">
          <label for="room">ที่อยู่ผู้เช่า</label>
          <input v-model.trim="$v.renter.cus_add.$model" class="form-control" id="address" :class="{'is-invalid': $v.renter.cus_add.$error}" />
          <div v-if="!$v.renter.cus_add.$required" class="invalid-feedback">กรุณากรอก ที่อยู่ผู้เช่า</div>
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-4">
          <label for="type">Email</label>
          <input v-model.trim="$v.renter.cus_email.$model" class="form-control" id="type" :class="{'is-invalid': $v.renter.cus_email.$error}" />
          <div v-if="!$v.renter.cus_email.$required" class="invalid-feedback">กรุณากรอก Email</div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="status">เบอร์โทร</label>
          <input v-model.trim="$v.renter.cus_tel.$model" class="form-control" id="status" :class="{'is-invalid': $v.renter.cus_tel.$error}" />
          <div v-if="!$v.renter.cus_tel.$required" class="invalid-feedback">กรุณากรอก เบอร์โทร</div>
        </div>
      </div>
      <div class="row">
        <div class="offset-2 col-md-4">
          <label for="internet">หมายเลขบัตรประจำตัวประชาชน</label>
          <input v-model.trim="$v.renter.personalid.$model" type="number" class="form-control" id="internet" :class="{'is-invalid': $v.renter.personalid.$error}" />
          <!-- <div v-if="$v.renter.personalid.$required" class="invalid-feedback">กรุณากรอก หมายเลขบัตรประจำตัวประชาชน</div> -->
          <div v-if="!$v.renter.personalid.$minLength" class="invalid-feedback">กรุณากรอก หมายเลขบัตรประจำตัวประชาชน ให้ครบ 13 ตำแหน่ง</div>
        </div>
      </div>
      <div class="row">
        <span class="offset-2 wanning">*กรุณากรอกข้อมูลให้ครบทุกช่อง</span>
      </div>
      <div class="row justify-content-center mt-4">
        <button type="button" class="btn btn-success" @click="CheckValidate">
          <i class="fas fa-check mr-2"></i>เพิ่มข้อมูลผู้เช่า
        </button>
        <router-link class="link" :to="{ name: 'home'}">
          <button type="button" class="btn btn-danger ml-3">
            <i class="far fa-times-circle mr-2"></i>ยกเลิก
          </button>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      loading: false,
      renter: {
        cus_name: null,
        cus_surname: null,
        cus_add: null,
        cus_email: null,
        cus_tel: null,
        personalid: null,
        rent_status: 1,
        rooms_id: null,
      },
      room: {
        room_status: null,
        room_type: null,
        price: null,
        internet: null,
      },
      room_number: null,
    };
  },
  created() {
    this.renter.rooms_id = sessionStorage.getItem("RoomId");
    this.room_number = sessionStorage.getItem("RoomNum");
    this.GetRoomById();
  },
  validations: {
    renter: {
      cus_name: {
        required,
      },
      cus_surname: {
        required,
      },
      cus_add: {
        required,
      },
      cus_email: {
        required,
      },
      cus_tel: {
        required,
      },
      personalid: {
        required,
        minLength: minLength(13),
      },
    },
  },
  methods: {
    CheckValidate() {
      if (this.$v.$invalid) {
        this.$v.renter.$touch();
      } else {
        this.$swal({
          title: "ต้องการเพิ่มผู้เช่าใช่ หรือ ไม่?",
          showDenyButton: true,
          confirmButtonText: `ใช่`,
          denyButtonText: `ไม่ใช่`,
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post("/api/addcostomer", this.renter);
            this.room = {
              room_status: 2,
              room_type: this.room.room_type,
              price: this.room.price,
              internet: this.room.internet,
            };
            axios.put(`/api/updateroom/${this.renter.rooms_id}`, this.room);
            sessionStorage.removeItem("RoomId");
            sessionStorage.removeItem("RoomNum");
            this.$swal("เพิ่มผู้เช่าเรียบร้อย!", "", "success");
            this.$router.push({ name: "home" });
          } else if (result.isDenied) {
            this.$swal("ยกเลิกการเพิ่มผู้เช่า", "", "info");
          }
        });
      }
    },
    GetRoomById() {
      this.loading = true;
      axios.get(`/api/room/${this.renter.rooms_id}`).then((response) => {
        this.room = {
          room_status: response.data.data.room_status,
          room_type: response.data.data.room_type,
          price: response.data.data.price,
          internet: response.data.data.internet,
        };
        this.loading = false;
      });
    },
  },
};
</script>

<style scoped>
.wanning {
  color: red;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>