<template>
    <div class="calculator">
        <h3 class="box-title">汇率计算器</h3>
        <p>使用计算器可以方便的规划充值和购买金额。您可以输入您想购买的代币计算出支付的数字货币，也可以输入计划花费的数字货币得到可以购买到的代币数量。</p>
        <div class="sub-container">
            <div class="half-box left-box row-1 input-box">
                <el-input v-model="input" placeholder="请输入内容">
                    <template slot="append">BASH</template>
                </el-input>
            </div>
            <div class="icon-center"><span><=></span></div>
            <div class="half-box right-box row-1 output-box">
                <el-input placeholder="请输入内容" v-model="output" class="input-with-select">
                    <el-select v-model="value" slot="append" placeholder="请选择">
                        <el-option v-for="(currency, index) in currencyList" :label="currency.symbol" :value="currency.price" :key="index"></el-option>
                    </el-select>
                </el-input>
            </div>
            <div class="half-box left-box row-2 bonus-box">
                <div class="half-box-title">
                    额外奖励(8%)：
                </div>
                <div class="half-box-content">
                    23523.235236246342
                </div>
            </div>
            <div class="half-box right-box row-2 result-box">
                <div class="half-box-title">
                    一共可获得代币数：
                </div>
                <div class="half-box-content">
                    23534645754643.345346346
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            input: '',
            output: '',
            value: '',
            currencyList: [{
                symbol: 'BTC',
                price: '2.3'
            }, {
                symbol: 'ETH',
                price: '4.1'
            }]
        }
    },
    mounted: function () {
        this.value = this.currencyList[0]['price'];
    }
}
</script>

<style lang="scss" scoped>
.calculator {
    .sub-container {
        background-color: #409EFF;
        position: relative;
        margin: 20px -20px -20px -20px;
        .icon-center {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F56C6C;
            color: #fff;
            width: 40px;
            height: 40px;
            font-size: 18px;
            border-radius: 50%;
            left: calc(50% - 20px);
            top: 30px;
            span {
                position: relative;
                bottom: 1.5px;
            }
        }
        .half-box {
            box-sizing: border-box;
            width: 50%;
            padding: 30px;
            float: left;
            &.left-box {
                border-right: 1px solid #DCDFE6;
            }
            &.row-2 {
                background-color: #67C23A;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 10px;
                border-top: 1px solid #DCDFE6;
                color: #FFF;
            }
            .half-box-title {
                font-size: 14px;
                line-height: 15px;
            }
            .half-box-content {
                font-size: 22px;
                font-weight: bold;
                line-height: 30px;
            }
        }
        .clear {
            clear: both;
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
