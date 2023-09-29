    $(document).ready(function () {
    $('.card-item-message').on('click', function () {
        let message = $(this).data('message');
        let user = $(this).data('user');
        $('#chat_user').html(user['name']);
        $('#chat_message').html(message['chat_message']);
        renderMessage(url, message['to_user_id']);
    })
})

    function renderMessage(from, to) {
    let url = urlchat
    fetch(url + '/' + from + '/' + to, {
    method: 'GET',
})
    .then(response => {
    if (response.status == 200) {
    return response.text();
}
})
    .then((response) => {

    $('#chat_message').empty().append(response);
})
    .catch(error => {
});
}

    function renderDefault() {
    let listMessage = $('.card-item-message');
    let messageDefault = $(listMessage[0]).data('message');
    renderMessage(url, messageDefault['to_user_id']);
}

    renderDefault();
