import VueRouter from 'vue-router';
import AllRooms from './components/pages/Room/AllRooms.vue'
import Renter from './components/pages/Renter/Renter.vue'
import Users from './components/pages/User/Users.vue'
import ElectricMeter from './components/pages/Meter/ElectricMeter.vue'
import RoomDetail from './components/pages/Room/RoomDetail.vue'
import RenterDetail from './components/pages/Renter/RenterDetail.vue'
import RenterDetailEdit from './components/pages/Renter/RenterDetailEdit.vue'
import RenterAdd from './components/pages/Renter/RenterAdd.vue'
import RoomDetailEdit from './components/pages/Room/RoomDetailEdit.vue'
import AllReceipt from './components/pages/Receipt/AllReceipt.vue'
import ReceiptDetail from './components/pages/Receipt/ReceiptDetail.vue' 
import ViewBill from './components/pages/Receipt/ViewBill.vue'



export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: AllRooms,
            name: 'home'
        },
        {
            path: '/Renter',
            component: Renter,
            name: 'Renter'
        },
        {
            path: '/Users',
            component: Users,
            name: 'User'
        },
        {
            path: '/Profile',
            component: Users,
            name: 'Profile'
        },
        {
            path: '/ElectricMeter',
            component: ElectricMeter,
            name: 'ElectricMeter'
        },
        {
            path: '/RoomDetail/:id',
            component: RoomDetail,
            name: 'RoomDetail'
        },
        {
            path: '/RoomDetailEdit/:id',
            component: RoomDetailEdit,
            name: 'RoomDetailEdit'
        },
        {
            path: '/RenterDetail/:id',
            component: RenterDetail,
            name: 'RenterDetail'
        },
        {
            path: '/RenterAdd',
            component: RenterAdd,
            name: 'RenterAdd'
        },
        {
            path: '/RenterDetailEdit/:id',
            component: RenterDetailEdit,
            name: 'RenterDetailEdit'
        },
        {
            path: '/AllReceipt',
            component: AllReceipt,
            name: 'AllReceipt'
        },
        {
            path: '/ReceiptDetail/:id',
            component: ReceiptDetail,
            name: 'ReceiptDetail'
        },
        {
            path: '/ViewBill/:id',
            component: ViewBill,
            name: 'ViewBill'
        },
    ]
})