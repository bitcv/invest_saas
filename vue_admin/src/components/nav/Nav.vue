<template>
    <div class="nav container">
        <el-menu
         default-active="2"
         background-color="#545c64"
         text-color="#fff"
         active-text-color="#ffd04b">
            <el-menu-item v-for="(item, index) in itemList" :index="'' + index + 1" :key="index">
                <!--<router-link to="#/purchase">-->
                <a class="router" :href="item.url">
                    <i :class="item.icon"></i>
                    <span slot="title">{{ item.text }}</span>
                <!--</router-link>-->
                </a>
            </el-menu-item>
        </el-menu>
    </div>
</template>

<script>
export default {
    data () {
        return {
            itemList: [{
                icon: 'el-icon-goods',
                url: '#/',
                text: '购买代币'
            }, {
                icon: 'el-icon-document',
                url: '#/record',
                text: '购买记录'
            }, {
                icon: 'el-icon-menu',
                url: '#/projInfo',
                text: '项目信息'
            }, {
                icon: 'el-icon-info',
                url: '#/profile',
                text: '个人信息'
            }]
        }
    }
}
</script>

<style lang="scss" scoped>
.container {
    width: 100%;
    height: 100%;
    .el-menu {
        height: 100%;
        border-right: none;
        .router {
            display: block;
            width: 100%;
            height: 100%;
        }
    }
}
</style>
