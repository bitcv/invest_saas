$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/ajax/bitcv.php?action=apply',
            cache: false,
            data: new FormData($('form')[0]),
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                resObj = JSON.parse(data);
                if (resObj['errcode'] === 0) {
                    console.log(resObj['data']);
                    //$(location).attr('href', resObj['data']['projUrl']);
                } else {
                    alert('错误码:' + resObj['errcode']);
                }
            }
        })
    })
});
