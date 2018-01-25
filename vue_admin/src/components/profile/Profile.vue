<template>
    <div class="profile">
        <h1 class="page-title">个人信息</h1>
        <div class="content-container">
            <el-table
             :data="tableData"
             style="width: 100%">
                <el-table-column
             prop="date"
             width="180">
                </el-table-column>
                <el-table-column
             prop="name"
             width="180">
                </el-table-column>
                <el-table-column
             prop="address"
             :formatter="formatter">
                </el-table-column>
                <el-table-column
             prop="tag"
             width="100">
                    <template slot-scope="scope">
                        <el-tag
                              :type="scope.row.tag === '家' ? 'primary' : 'success'"
                              close-transition>{{scope.row.tag}}</el-tag>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            tableData: [{
                date: '2016-05-02',
                name: '王小虎',
                address: '上海市普陀区金沙江路 1518 弄',
                tag: '家'
            }, {
                date: '2016-05-04',
                name: '王小虎',
                address: '上海市普陀区金沙江路 1517 弄',
                tag: '公司'
            }, {
                date: '2016-05-01',
                name: '王小虎',
                address: '上海市普陀区金沙江路 1519 弄',
                tag: '家'
            }, {
                date: '2016-05-03',
                name: '王小虎',
                address: '上海市普陀区金沙江路 1516 弄',
                tag: '公司'
            }]
        }
    }
}
</script>

<style lang="scss" scoped>
.profile {
    background: rgba(236, 236, 236, 0.4);
    padding: 30px 40px;
}
</style>
