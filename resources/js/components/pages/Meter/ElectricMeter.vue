<template>
  <div class="content-header mt-4">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">เซตค่าหน่วยมิเตอร์ค่าไฟ</h1>
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
      <div class="alert alert-success" role="alert" v-if="metersave">บันทึกค่าหน่วยมิเตอร์ไฟฟ้า/มิเตอร์น้ำ สำเร็จ</div>
      <div class="row offset-5 col-md-3 mt-5">
        <label for>
          <i class="fas fa-bolt mr-2"></i>มิเตอร์ค่าไฟ ราคา/หน่วย
        </label>
        <input v-model="electric.electricmeter" type="number" class="form-control" :readonly="disable" />
      </div>
      <div class="row offset-5 col-md-3 mt-5">
        <label for>
          <i class="fas fa-tint mr-2"></i>มิเตอร์ค่าน้ำ ราคา/หน่วย
        </label>
        <input v-model="water.watermeter" type="number" class="form-control" :readonly="disable" />
      </div>
      <div class="row offset-5 col-md-3 mt-3" v-if="disable">
        <button type="button" class="btn btn-warning" @click="Edit"><i class="far fa-edit mr-2"></i>แก้ไข</button>
      </div>
      <div v-else>
        <div class="row offset-5 col-md-3 mt-3">
          <button type="button" class="btn btn-primary mr-2" @click="Save"><i class="far fa-save mr-2"></i>บันทึก</button>
          <button type="button" class="btn btn-danger" @click="cancel"><i class="far fa-times-circle mr-2"></i>ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      water: {
        watermeter: null,
      },
      electric: {
        electricmeter: null,
      },
      disable: true,
      loading: false,
      metersave: false
    };
  },
  created() {
    this.loading = true;
    this.GetElectric();
    this.GetWater();
  },
  methods: {
    GetElectric() {
      axios.get("/api/electric").then((response) => {
        this.electric = {
          electricmeter: response.data.electricmeter,
        };
      });
    },
    GetWater() {
      axios.get("/api/water").then((response) => {
        this.water = {
          watermeter: response.data.watermeter,
        };
        this.loading = false;
      });
    },
    Edit() {
      this.disable = false;
    },
    Save() {
      this.loading = true;
      axios.put("/api/updatewater/1", this.water);
      axios.put("/api/updateelectric/1", this.electric);
      this.disable = true;
      this.loading = false;
      this.metersave = true;
    },
    cancel() {
      this.disable = true;
    },
  },
};
</script>