import Vue from 'vue'
import Router from 'vue-router'

import Purchase from '@/components/purchase/Purchase.vue'
import Record from '@/components/record/Record.vue'
import ProjInfo from '@/components/projInfo/ProjInfo.vue'
import Profile from '@/components/profile/Profile.vue'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            component: Purchase
        },{
            path: '/record',
            component: Record
        },{
            path: '/projInfo',
            component: ProjInfo
        },{
            path: '/profile',
            component: Profile
        }
    ]
})
