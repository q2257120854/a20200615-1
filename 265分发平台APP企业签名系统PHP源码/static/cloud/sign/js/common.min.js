(function () {
    $(".login-in .notification").on('mouseenter', function () {
        $.getJSON('/notice/lists', {size: 4, async: 1}, function (data) {
            console.info(data);
            $(".login-in .notification .yes .msg-list").html(data.data);
        })
    });
})();