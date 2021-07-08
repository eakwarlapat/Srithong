<template>
  <div class="content-header mt-4">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">จัดการข้อมูลใบเสร็จ</h1>
        </div>
      </div>
      <hr />
      <div class="text-center" style="margin-top: 150px" v-if="loading">
        <div class="spinner-border" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div v-else>
        <table class="table table-bordered mt-5">
          <thead class="thead-dark">
            <tr>
              <th width="7%" scope="col" class="text-center">หมายเลขห้อง</th>
              <th width="10%" scope="col">ชื่อ</th>
              <th width="10%" scope="col">นามสกุล</th>
              <th width="7%" scope="col">เบอร์โทร</th>
              <th width="5%" scope="col">สถานะ</th>
              <th width="5%" scope="col">ประเภท</th>
              <th width="8%" scope="col">ราคาห้องเช่า/เดือน</th>
              <th width="7%" scope="col">สถานะการจ่ายเงิน</th>
              <th width="10%" scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(room, index) in rooms" :key="index">
              <td class="text-center">{{ room.room_number }}</td>
              <td>{{ room.customer.cus_name }}</td>
              <td>{{ room.customer.cus_surname }}</td>
              <td>{{ room.customer.cus_tel }}</td>
              <td v-if="room.room_status === 1">ห้องว่าง</td>
              <td v-else>ห้องไม่ว่าง</td>
              <td v-if="room.room_type === 1">พัดลม</td>
              <td v-else>แอร์</td>
              <td>{{room.price}}</td>
              <td v-if="room.bill === null">
                <i class="fas fa-times text-danger mr-2"></i>บิลยังไม่ได้สร้าง
              </td>
              <td v-else-if="room.bill.status === 1">
                <i class="fas fa-circle text-success mr-2"></i>จ่ายเงินแล้ว
              </td>
              <td v-else-if="room.bill.status === 2">
                <i class="fas fa-circle text-danger mr-2"></i>ยังไม่ได้จ่าย
              </td>
              <td class="text-center">
                <router-link class="link" :to="{ name: 'ReceiptDetail', params: { id: room.id }}">
                  <button type="button" class="btn btn-primary btn-sm">
                    <i class="fas fa-file-invoice-dollar mt-2"></i>
                  </button>
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
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
    };
  },
  created() {
    this.GetAllRoom();
  },
  methods: {
    GetAllRoom() {
      (this.loading = true),
        axios.get("/api/allrooms").then((response) => {
          this.rooms = response.data.data.filter(
            (element) => element.room_status === 2
          );
          this.loading = false;
        });
    },
  },
};
</script>