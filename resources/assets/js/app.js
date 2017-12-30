require('./bootstrap');

const logoutUrl = '/logout';

$(function () {
    // 退出登录按钮
    $('.logout').on('click', function () {
        axios.post(logoutUrl)
            .then(function () {
                window.location.reload();
            })
    });

// 侧边栏跳转
    $('.sidebar-item').on('click', function () {
        let href = $(this).attr('href');
        if (href !== null && href !== undefined)
            window.location.href = href;
    });

    $('button[del-host]').on('click', function () {
        let url = "/admin/host/delete/" + $(this).attr('del-host');
        axios.post(url)
             .then(function (response) {
                 window.location.reload();
             })
    })

    // 到期时间时间选择器初始化
    $('input[name=expire]').datetimepicker({
        format: "YYYY-MM-DD"
    })
});
