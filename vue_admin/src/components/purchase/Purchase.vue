<template>
    <div class="purchase">
        <h1 class="page-title">购买代币</h1>
        <div class="content-container">
            <div class="main-container">
                <calculator></calculator>
                <recharge></recharge>
                <payment></payment>
            </div>
            <div class="right-container">
                <balance></balance>
            </div>
        </div>
    </div>
</template>

<script>
import calculator from './Calculator.vue';
import recharge from './Recharge.vue';
import payment from './payment.vue';
import balance from './balance.vue';

export default {
    data () {
        return {

        }
    },
    components: {
        calculator,
        recharge,
        payment,
        balance
    }
}
</script>

<style lang="scss" scoped>
.purchase {
    background: rgba(236, 236, 236, 0.4);
    padding: 30px 40px;
    .content-container {
        display: flex;
        align-items: flex-start;
        .main-container {
            width: 800px;
            min-width: 400px;
            margin-right: 50px;
            .calculator,.recharge, .payment {
                width: 100%;
                box-sizing: border-box;
                margin-bottom: 30px;
                border-radius: 5px;
                background-color: #fff;
                border: 1px solid #DCDFE6;
                padding: 20px;
            }
        }
        .right-container {
            width: 300px;
            color: green;
            flex-shrink: 0;
            .balance {
                width: 100%;
                box-sizing: border-box;
                border-radius: 5px;
                background-color: #fff;
                border: 1px solid #DCDFE6;
                padding: 20px;
            }
        }
    }
}
</style>
