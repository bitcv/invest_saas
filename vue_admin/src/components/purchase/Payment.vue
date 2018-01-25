<template>
    <div class="payment">
        <h3 class="box-title">购买代币</h3>
        <p>付款前，请确保账户余额充足</p>
        <div class="form-container">
            <el-tabs type="border-card">
                <el-tab-pane label="按支付金额生成订单">
                    <el-form ref="form" :model="form" :rules="ruleList" label-width="80px">
                        <el-form-item label="支付方式">
                              <el-radio v-model="radio" label="1">比特币</el-radio>
                              <el-radio v-model="radio" label="2">以太币</el-radio>
                        </el-form-item>
                        <el-form-item label="支付金额" prop="buy">
                            <el-input v-model="form.name">
                                <template slot="append">BTC</template>
                            </el-input>
                        </el-form-item>
                        <el-form-item class="sub-item">
                            <el-checkbox v-model="checked">使用账户所有余额</el-checkbox>
                        </el-form-item>
                        <el-form-item class="btn-item">
                            <el-button type="primary" @click="onSubmit">提交订单</el-button>
                            <el-button>重置</el-button>
                        </el-form-item>
                    </el-form>
                </el-tab-pane>
                <el-tab-pane label="按购买数量生成订单">
                    <el-form ref="form" :model="form" :rules="ruleList" label-width="80px">
                        <el-form-item label="购买数目" prop="buy">
                            <el-input v-model="form.name">
                                <template slot="append">BASH</template>
                            </el-input>
                        </el-form-item>
                        <el-form-item class="btn-item">
                            <el-button type="primary" @click="onSubmit">提交订单</el-button>
                            <el-button>重置</el-button>
                        </el-form-item>
                    </el-form>
                </el-tab-pane>
            </el-tabs>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            checked: false,
            input: '',
            form: {
                name: '',
                region: '',
                date1: '',
                date2: '',
                delivery: false,
                type: [],
                resource: '',
                desc: ''
            },
            ruleList: {
                'pay': [
                    {required: true, message: '请输入金额', trigger: 'blur'}
                ],
                'buy': [
                    {required: true, message: '请输入金额', trigger: 'blur'}
                ]
            },
            currencyList: [{
                symbol: 'BTC',
                price: '2.3'
            }, {
                symbol: 'ETH',
                price: '4.1'
            }]
        }
    },
    methods: {
        onSubmit() {
            console.log('submit!');
        }
    }
}
</script>

<style lang="scss" scoped>
.payment {
    .form-container {
        margin-top: 30px;
        .sub-item {
            margin-top: -18px;
        }
        .btn-item {
            display: flex;
            justify-content: center;
            margin-right: 100px;
        }
    }
}
</style>

<style>
.el-select .el-input {
    width: 80px;
}
.input-with-select .el-input-group__prepend {
    background-color: #fff;
}
</style>
