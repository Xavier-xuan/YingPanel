require('./bootstrap');

const logoutUrl = '/logout';

$('.logout').on('click', function () {
    axios.post(logoutUrl)
        .then(function () {
            window.location.reload();
        })
});

$('.sidebar-item').on('click', function () {
    href = $(this).attr('href');
    if (!isEmpty(url))
        window.location.href = href;
});