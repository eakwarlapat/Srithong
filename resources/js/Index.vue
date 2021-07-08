<template>
  <div>
    <div v-if="islogin === false">
      <div class="wrapper fadeInDown zero-raduis space-top">
  	  <div id="formContent">
  	    <!-- Tabs Titles -->

  	    <!-- Icon -->
  	    <div class="fadeIn first">
  	      <h2 class="my-5">Login</h2>
  	    </div>

  	    <!-- Login Form -->
  	    <form>
  	      <input type="text" class="fadeIn second zero-raduis" v-model="username" placeholder="UserName">
  	      <input type="password" class="fadeIn third zero-raduis" v-model="password" placeholder="Password">
		      <div id="formFooter">
  	      </div>
  	      <input type="submit" class="fadeIn fourth zero-raduis" value="login" @click="login()">
  	    </form>
  	  </div>
  </div>
    </div>
    <div v-else-if="islogin === true">
      <div v-if="disable !== 'ViewBill'" class="nav-side-menu">
        <div class="brand">หอพัก ศรีทอง</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">
          <ul id="menu-content" class="menu-content collapse out">
            <li>
              <router-link
                :to="{ name: 'home'}"
                :class="[{ 'active': this.$route.name === 'home' }]"
              >
                <i class="fas fa-building mr-2"></i> ข้อมูลห้องพัก&emsp;&emsp;&emsp;&emsp;&emsp;
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'Renter'}"
                :class="[{ 'active': this.$route.name === 'Renter' }]"
              >
                <i class="far fa-circle mr-2"></i> จัดการข้อมูลผู้เช่า&emsp;&emsp;&emsp;&emsp;&emsp;
              </router-link>
            </li>
            <!-- <li>
              <router-link
                :to="{ name: 'User'}"
                :class="[{ 'active': this.$route.name === 'User' }]"
              >
                <i class="fa fa-users fa-lg mr-2"></i> จัดการข้อมูล Users&emsp;&emsp;&emsp;&emsp;
              </router-link>
            </li> -->
            <li>
              <router-link
                :to="{ name: 'ElectricMeter'}"
                :class="[{ 'active': this.$route.name === 'ElectricMeter' }]"
              >
                <i class="fas fa-tachometer-alt"></i> ปรับราคามิเตอร์&emsp;&emsp;&emsp;&emsp;
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'AllReceipt'}"
                :class="[{ 'active': this.$route.name === 'AllReceipt' }]"
              >
                <i class="fas fa-file-invoice-dollar mt-2"></i>จัดการใบเสร็จ&emsp;&emsp;&emsp;&emsp;
              </router-link>
            </li>
          </ul>
        </div>
      </div>
      <div class="container col-md-12" id="main">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import Login from './components/pages/Login'

export default {
  components: {
    Login
  },
  data() {
    return {
      islogin: false,
      disable: this.$route.name,
      username: '',
      password: ''
    };
  },
  created() {},
  methods: {
    login() {
      if (this.username === 'admin' && this.password === 'admin')
      this.islogin = true
    }
  }
};
</script>