$(function(){
    $.ajax({
        type: 'post',
        url: '/ajax/project.php?action=getInvestorInfo',
        data: {},
        success: function (resData) {
            console.log(resData);
            var resObj = JSON.parse(resData);
            if (resObj['errcode'] === 0) {
                console.log(resObj['data']);
                var account = resObj['data']['account'];
                var token = resObj['data']['token'];
                var balance = resObj['data']['balance'];
                var referal = resObj['data']['referal'];
                $('span.account-value').html(account);
                $('span.token-value').html(parseFloat(token));
                $('span.balance-value').html(parseFloat(balance));
                //$('span.referal').html(account);
            } else if (resObj['errcode'] == 102) {
                $(location).attr('href', '/project.php?page=login');
            }
        }
    })

    $.ajax({
        type: 'post',
        url: '/ajax/project.php?action=getProjInfo',
        data: {},
        success: function (resData) {
            var resObj = JSON.parse(resData);
            console.log(resObj);
            switch (resObj['errcode']) {
                case 0:
                    var projInfo = resObj['data']['projInfo'];
                    var currencyPriceList = resObj['data']['currencyPriceList'];
                    console.log(currencyPriceList);
                    console.log(typeof(currencyPriceList));
                    $("span[key='projTokenName']").html(projInfo['token_name']);
                    currencyPriceList.forEach(function(item){
                        var html = '<option value="' + item['currencyPrice'] + '">' + item['currencySymbol'] + '</option>';
                        $("select[key='currencyPriceList']").append(html);
                        var html = '<a class="btn radius btn-white btn-sm deposit-btn" data="' + item['currencySymbol'] + '">' + item['currencySymbol'] + '</a>';
                        $("div.tag-box[key='currencyPriceList']").append(html);
                    })
                    break;
                default:
                    
            }
        }
    })

    $('button.logout').click(function() {
        $.ajax({
            type: 'post',
            url: '/ajax/project.php?action=logout',
            success: function (resData) {
                var resObj = JSON.parse(resData);
                switch (resObj['errcode']) {
                    case 0:
                        $(location).attr('href', '/project.php?page=login');
                        break;
                    default:
                }
            }
        })
    })

    $('a.deposit-btn').click(function() {
        console.log('success');
        var currencySymbol = $(this).attr('data');
        $.ajax({
            type: 'post',
            url: '/ajax/project.php?action=getWalletAddr',
            data: {
                currencySymbol: currencySymbol
            },
            success: function(resData){
                var resObj = JSON.parse(resData);
                console.log(resObj);
                switch (resObj['errcode']) {
                    case 0:
                        $("p[key='wallet-addr']").html(resObj['data']['address']);
                        jQuery(function(){
                            jQuery("[key='wallet-qrcode']").qrcode(resObj['data']['address']);
                        })
                        break;
                    default:
                }
            }
        })
    })
})
