$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/ajax/project.php?action=register',
            data: $(this).serialize(),
            success: function (resData) {
                console.log('success');
                console.log(resData);
                var resObj = JSON.parse(resData);
                switch (resObj['errcode']) {
                    case 0:
                        $(location).attr('href', '/project.php?page=login&account=' + $("input[name='account']").val());
                        break;
                    case 103:
                        alert('该账号已注册');
                        break;
                    default:
                        alert('Error:' + resObj['errcode']);
                }
            }
        })
    })
});
