<template>
    <div class="recharge">
        <h3 class="box-title">账号充值</h3>
        <el-radio v-for="(currency, index) in currencyList" :key="index" v-model="curSymbol" :label="currency.symbol" border>{{ currency.name }}</el-radio>
        <div class="container">
            <div class="addr-container">
                <h4 class="para-title">转账至以下地址：</h4>
                <el-input value="请输入内容" v-model="address" disabled>
                    <el-button slot="append">复制地址</el-button>
                </el-input>
            </div>
            <div class="img-container">
                <h4 class="para-title">扫描二维码支付：</h4>
                <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1517142464&di=2a1358db34786856639155fbe99d6670&imgtype=jpg&er=1&src=http%3A%2F%2Fn1.itc.cn%2Fimg8%2Fwb%2Frecom%2F2015%2F11%2F29%2F144879762079423179.gif" alt="">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            address: 'KEJLNGLKJHDOIGJVSLKJOEIU)#*(UFDKFJ)',
            curSymbol: '',
            currencyList: [{
                name: '比特币',
                symbol: 'BTC',
            }, {
                name: '以太币',
                symbol: 'ETH',
            }]
        }
    }
}
</script>

<style lang="scss" scoped>
.recharge {
    .el-radio.is-bordered {
        margin: 5px;
    }
    .container {
        box-sizing: border-box;
        width: 100%;
        height: 100%;
        margin-top: 20px;
        background-color: rgba(242, 242, 242, 0.5);
        padding: 30px;
        .addr-container {
            box-sizing: border-box;
            width: 100%;
            height: 100px;
        }
        .img-container {
            box-sizing: border-box;
            width: 100%;
            text-align: center;
            img {
                width: 250px;
                height: 250px;
            }
        }
    }
}
</style>
