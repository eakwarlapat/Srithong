<template>
  <div class="content-header mt-4">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">จัดการข้อมูลใบเสร็จ ห้อง {{ room.room_number }}</h1>
        </div>
      </div>
      <hr />
      <div class="text-center" style="margin-top: 150px" v-if="loading">
        <div class="spinner-border" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div v-else>
        <div class="row mt-5 mb-2">
          <div class="offset-2 col-md-3">
            <span class="float-right text-danger">*กรุณากรอกข้อมูลให้ครบ</span>
          </div>
        </div>
        <div class="row mb-3">
          <div class="offset-3 col-md-3">
            <label>ค่าเช่าห้องพัก</label>
            <input v-model="room.price" type="text" class="form-control" readonly />
          </div>
          <div class="col-md-3">
            <label>อินเตอร์เน็ต</label>
            <input v-model="room.internet" type="text" class="form-control" readonly />
          </div>
        </div>
        <div class="row mb-3">
          <div class="offset-3 col-md-3">
            <label>หน่วยค่าไฟที่ใช้</label>
            <input v-model="bill.electric" type="text" class="form-control" :readonly="disable" />
          </div>
          <div class="col-md-3">
            <label>หน่วยค่าน้ำที่ใช้</label>
            <input v-model="bill.water" type="text" class="form-control" :readonly="disable" />
          </div>
        </div>
        <div class="row mb-3">
          <div class="offset-3 col-md-3" v-if="bill.status === 1 && disable === true">
            <label>สถานะการจ่ายเงิน</label>
            <input type="text" class="form-control" value="จ่ายแล้ว" :readonly="disable" />
          </div>
          <div class="offset-3 col-md-3" v-if="bill.status === 2 && disable === true">
            <label>สถานะการจ่ายเงิน</label>
            <input type="text" class="form-control" value="ยังไม่ได้จ่าย" :readonly="disable" />
          </div>
          <div class="offset-3 col-md-3" v-if="bill.status != null && disable === false">
            <label>สถานะการจ่ายเงิน</label>
            <select class="form-control" v-model="bill.status">
              <option value="1">จ่ายแล้ว</option>
              <option value="2">ยังไม่ได้จ่าย</option>
            </select>
          </div>
          <div class="offset-3 col-md-3" v-if="disable === false">
            <label>สถานะการจ่ายเงิน</label>
            <input type="text" class="form-control" value="ยังไม่ได้จ่าย" :readonly="disable" />
          </div>
        </div>

        <div class="row justify-content-center mt-4">
          <button
            v-if="haveData && disable"
            type="button"
            class="btn btn-warning mr-2"
            @click="edit"
          >
            <i class="far fa-save mr-2"></i>Edit
          </button>
          <router-link
            target="_blank"
            class="link"
            :to="{ name: 'ViewBill', params: { id: bill.id }}"
          >
            <button v-if="haveData && disable" type="button" class="btn btn-primary mr-2">
              <i class="far fa-eye mr-2"></i>VIew
            </button>
          </router-link>
          <button
            v-if="haveData && !disable"
            type="button"
            class="btn btn-success mr-2"
            @click="Update"
          >
            <i class="far fa-save mr-2"></i>Update
          </button>
          <button
            v-if="!haveData && !disable"
            type="button"
            class="btn btn-success mr-2"
            @click="createReceipt"
          >
            <i class="far fa-save mr-2"></i>Save
          </button>
          <button v-if="!disable" type="button" class="btn btn-danger mr-2" @click="cancel">
            <i class="far fa-save mr-2"></i>ยกเลิก
          </button>
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
      haveData: false,
      disable: true,
      date: new Date(),
      bill: {
        id: null,
        month: new Date(),
        status: 2,
        electric: null,
        water: null,
        internet: null,
        rooms_id: 1,
      },
      room: {
        id: null,
        room_number: null,
        room_status: null,
        room_type: null,
        price: null,
        internet: null,
      },
      month: [
        "มกราคม",
        "กุมภาพันธ์",
        "มีนาคม",
        "เมษายน",
        "พฤษภาคม",
        "มิถุนายน",
        "กรกฎาคม",
        "สิงหาคม",
        "กันยายน",
        "ตุลาคม",
        "พฤศจิกายน",
        "ธันวาคม",
      ],
    };
  },
  created() {
    this.GetRoom();
  },
  methods: {
    GetRoom() {
      this.loading = true;
      axios.get(`/api/room/${this.$route.params.id}`).then((response) => {
        this.room = response.data.data;
        if (response.data.data.bill) {
          this.bill = {
            id: response.data.data.bill.id,
            date: response.data.data.bill.date,
            status: response.data.data.bill.status,
            electric: response.data.data.bill.electric,
            water: response.data.data.bill.water,
            internet: response.data.data.bill.internet,
            rooms_id: response.data.data.id,
          };
          this.haveData = true;
          this.disable = true;
          this.loading = false;
        } else {
          this.bill = {
            id: null,
            date: null,
            status: null,
            electric: null,
            water: null,
            internet: response.data.data.internet,
            rooms_id: response.data.data.id,
          };
          this.haveData = false;
          this.disable = false;
          this.loading = false;
        }
      });
    },
    createReceipt() {
      this.$swal({
        title: "ต้องการเซฟ หรือไม่?",
        showDenyButton: true,
        confirmButtonText: `Save`,
        denyButtonText: `cancel`,
      }).then((result) => {
        if (result.isConfirmed) {
          const Month = this.date.getMonth();
          this.bill = {
            month: this.month[Month],
            status: this.bill.status ? this.bill.status : 2,
            electric: this.bill.electric,
            water: this.bill.water,
            rooms_id: this.room.id,
            internet: this.bill.internet,
            room_price: this.room.price,
          };
          console.log(this.bill);
          axios.post("/api/addbill", this.bill);
          this.GetRoom();
          this.$swal("เซฟ สำเร็จ", "", "success");
        } else if (result.isDenied) {
          this.$swal("ไม่มีการเซฟ", "", "info");
        }
      });
    },
    edit() {
      this.disable = !this.disable;
    },
    cancel() {
      this.disable = true;
    },
    Update() {
      this.$swal({
        title: "ต้องการอัพเดท หรือไม่?",
        showDenyButton: true,
        confirmButtonText: `Update`,
        denyButtonText: `cancel`,
      }).then((result) => {
        if (result.isConfirmed) {
          const Month = this.date.getMonth();
          this.bill = {
            id: this.bill.id,
            month: this.month[Month],
            status: this.bill.status,
            internet: this.bill.internet,
            electric: this.bill.electric,
            water: this.bill.water,
            rooms_id: this.room.id,
            room_price: this.room.price,
          };
          axios.put(`/api/updatebill/${this.bill.id}`, this.bill);
          // console.log(this.receipt.month);
          this.$swal("อัพเดท สำเร็จ", "", "success");
          this.GetRoom();
        } else if (result.isDenied) {
          this.$swal("ไม่มีการอัพเดท", "", "info");
        }
      });
    },
  },
};
</script>