<template>
  <div class="content-header col-md-10 mt-4">
    <div class="container-fluid" v-for="(list, index) in billRoomList" :key="index">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">ข้อมูล Bill</h1>
        </div>
      </div>
      <hr />
      <div class="text-center" style="margin-top: 150px" v-if="loading">
        <div class="spinner-border" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div v-else>
        <h2 class="mt-4 text-center">บิลค่าเช่า</h2>
        <hr />
        <h4 class="mt-4 mb-4 text-center">ห้องที่ {{ bill.rooms.room_number }} ประจำเดือน {{ list.month }}</h4>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="20%" scope="col">รายการ</th>
              <th width="40%" scope="col" colspan="2" class="text-center">หน่วยที่ใช้</th>
              <th width="40%" scope="col" class="text-center">รวม</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">ค่าน้ำ</th>
              <td colspan="2" class="text-right">{{ list.water }} หน่วย</td>
              <td class="text-right">{{ list.water }} บาท</td>
            </tr>
            <tr>
              <th scope="row">ค่าไฟ</th>
              <td colspan="2" class="text-right">{{ list.electric }} หน่วย</td>
              <td class="text-right">{{ list.electric }} บาท</td>
            </tr>
            <tr>
              <th scope="row">อินเตอร์เน็ต</th>
              <td colspan="2"></td>
              <td class="text-right">{{ list.internet }} บาท</td>
            </tr>
            <tr>
              <th scope="row">ค่าเช่า</th>
              <td colspan="2"></td>
              <td class="text-right">{{ list.room_price }} บาท</td>
            </tr>
            <tr>
              <th scope="row">รวม</th>
              <td colspan="2"></td>
              <td class="text-right">{{ list.total }} บาท</td>
            </tr>
          </tbody>
        </table>
        <div v-if="hide" class="text-right">
          <button type="button" class="btn btn-primary" @click="Print">Print</button>
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
      hide: true,
      bill: {
        id: null,
        electric: null,
        water: null,
        internet: null,
        month: null,
        room_id: null,
        rooms: {
          price: null,
          room_number: null,
        },
        status: null,
      },
      billList: [],
      billRoomList: [],
      pay: {
        electric: null,
        water: null,
        internet: null,
      },
      electric: null,
      water: null,
      total: null,
    };
  },
  created() {
    this.GetBill();
  },
  methods: {
    GetBill() {
      this.loading = true;
      axios.get(`/api/bill/${this.$route.params.id}`).then((response) => {
        this.bill = response.data.data;
        if (this.bill.internet === 1) {
          this.pay.internet = 200;
        } else {
          this.pay.internet = 0;
        }
      }).then(() => {
         axios.get('/api/allbill').then((response) => {
           this.billList = response.data
           this.billRoomList = this.billList.filter(lists =>  lists.rooms_id === this.bill.rooms.id)
      }) 
      })
      axios
        .get(`/api/electric`)
        .then((response) => {
          this.electric = response.data.electricmeter;
        })
        .then(() => {
          this.pay.electric = this.electric * this.bill.electric;
        });
      axios
        .get(`/api/water`)
        .then((response) => {
          this.water = response.data.watermeter;
        })
        .then(() => {
          this.pay.water = this.water * this.bill.water;
        })
        .then(() => {
          this.total =
            this.pay.water +
            this.pay.electric +
            this.pay.internet +
            this.bill.rooms.price;
          console.log(this.total);
          this.loading = false;
        });
    },
    getAllBill() {
      axios.get('/api/allbill').then((response) => {
        console.log('bill data',response.data)
      }) 
    },
    Print() {
      this.hide = false;
      setTimeout(() =>  window.print(), 100);
    }
  },
};
</script>