<template>
  <div class="content-header mt-4">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">ข้อมูลผู้เช่า</h1>
        </div>
      </div>
      <hr />
      <div class="text-center" style="margin-top: 150px" v-if="loading">
        <div class="spinner-border" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div v-else>
        <div v-if="customers">
          <table class="table table-bordered mt-5">
            <thead class="thead-dark">
              <tr>
                <th width="2%" scope="col" class="text-center">#</th>
                <th width="20%" scope="col">ชื่อผู้เช่า</th>
                <th width="20%" scope="col">นามสกุลผู้เช่า</th>
                <th width="7%" scope="col">เบอร์โทร</th>
                <th width="10%" scope="col" class="text-center">สถานะการอาศัย</th>
                <th width="3%" scope="col" class="text-center">ห้อง</th>
                <th width="10%" scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(customer, index) in customers" :key="index">
                <td class="text-center">{{ index + 1}}</td>
                <td>{{ customer.cus_name }}</td>
                <td>{{ customer.cus_surname }}</td>
                <td>{{ customer.cus_tel }}</td>
                <td v-if="customer.rent_status === 1">
                  <i class="fas fa-circle mr-2 text-success"></i>อาศัยอยู่
                </td>
                <td v-else>
                  <i class="fas fa-circle mr-2 text-danger"></i>ย้ายออก
                </td>
                <td v-if="customer.room === null" class="text-center"> - </td>
                <td v-else class="text-center">{{ customer.room.room_number }}</td>
                <td class="text-center">
                  <router-link class="link" :to="{ name: 'RenterDetail', params: { id: customer.id } }">
                    <button type="button" class="btn btn-primary btn-sm">
                      <i class="far fa-eye"></i>
                    </button>
                  </router-link>
                  <router-link v-if="customer.rent_status === 1" class="link" :to="{ name: 'RenterDetailEdit', params: { id: customer.id } }">
                    <button type="button" class="btn btn-warning btn-sm">
                      <i class="far fa-edit"></i>
                    </button>
                  </router-link>
                </td>
              </tr>
            </tbody>
          </table>
          <ul class="pagination justify-content-center mt-4">
            <li class="page-item" v-for="page in pagination.last_page" :key="page" :class="{active: pagination.current_page === page}">
              <a class="page-link" href="#" @click="fetchData(pagination.path_page + page)">
                {{ page }}
                <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
        </div>

        <div v-else class="text-center mt-5">
          <span>ยังไม่มีข้อมูลผู้เช่า</span>
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
      customers: {
        id: null,
        cus_name: null,
        cus_surname: null,
        cus_tel: null,
        room: {
          room_number: null,
        },
      },

      pagination: {
        current_page: null,
        path_page: null,
        last_page: null,
      },
    };
  },
  created() {
    this.loading = true;
    axios.get("api/allcustomer").then((response) => {
      (this.customers = response.data.data),
        (this.pagination = {
          current_page: response.data.meta.current_page,
          path_page: response.data.meta.path + "?page=",
          last_page: response.data.meta.last_page,
        });
      this.loading = false;
      console.log(this.customers)
    });
  },
  methods: {
    fetchData(pagi) {
      this.loading = true;
      axios.get(pagi).then((response) => {
        (this.customers = response.data.data),
          (this.pagination = {
            current_page: response.data.meta.current_page,
            path_page: response.data.meta.path + "?page=",
            last_page: response.data.meta.last_page,
          });
        this.loading = false;
      });
    },
  },
};
</script>

<style scoped>
.link {
  text-decoration: none;
}

.fa-eye {
  color: white;
}
</style>