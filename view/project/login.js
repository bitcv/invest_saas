$(document).ready(function () {

    // 获取url参数
    function getUrlQuery(name)
    {
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if(r != null) {
            return  unescape(r[2]);
        }
        return null;
    }

    // 自动填充表单账号
    var account = getUrlQuery(account);
    if (account) {
        $("input[name='account']").attr('value', account);
    }

    // 登录表单提交
    $('form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/ajax/project.php?action=login',
            data: $(this).serialize(),
            success: function (resData) {
                console.log(resData);
                var resObj = JSON.parse(resData);
                if (resObj['errcode'] === 0) {
                    $(location).attr('href', '/project.php?page=profile');
                } else if (resObj['errcode'] === 102) {
                    alert('用户名或密码错误');
                }
            }
        })
    })
});
