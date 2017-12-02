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
})(jQuery);
