<template>
    <div class="balance">
        <h3 class="box-title">我的钱包</h3>
        <div class="info-container">
            <p v-for="(wallet, index) in walletList">
                <span class="bold">{{ wallet.name }}：</span>
                <span class="num">{{ wallet.balance }}</span> 
                <span class="symbol">{{ wallet.symbol }}</span>
            </p>
            <p class="self">
                <span class="bold">达世币：</span>
                <span class="num">2222352353</span> 
                <span class="symbol">DASH</span>
            </p>
        </div>
        <div class="btn-container">
            <el-button type="primary">账号充值</el-button>
            <el-button type="danger">购买代币</el-button>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            walletList: [{
                name: '比特币',
                symbol: 'BTC',
                balance: 23532.235235,
            }, {
                name: '以太币',
                symbol: 'ETH',
                balance: 23.235325
            }]
        }
    }
}
</script>

<style lang="scss" scoped>
.balance {
    .info-container {
        margin-bottom: 20px;
        p {
            font-size: 16px;
            line-height: 20px;
            .bold {
                font-size: 16px;
                line-height: 24px;
                display: block;
                margin-top: 10px;
                font-weight: bold;
            }
        }
    }
    .btn-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        button {
            margin: 0 0 10px;
            width: 150px;
        }
    }
}
</style>
