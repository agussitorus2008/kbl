<div id="body">
    <div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="fa fa-comments"></i>
    </div>

    <div class="chat-box">
        <div class="chat-box-header">
            Hubungi Kami
            <span class="chat-box-toggle">
                <i class="fa fa-times"></i>
            </span>
        </div>
        <div class="chat-box-body">
            <div class="chat-box-overlay"></div>
            <div class="chat-logs scroll" id="chat_logs" style="height: 300px; padding-top: 10px;">
            </div>
        </div>
        <div class="chat-input">
            <form id="form_chat">
                <input type="text" id="chat-input" placeholder="Send a message..." />
                <a type="submit" class="chat-submit" id="chat-submit" href="javascript:;" onclick="sendMessage()">
                    <i class="fa fa-paper-plane"></i>
                </a>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#chat_logs').slimScroll({
            height: '300px',
            color: '#00f',
            alwaysVisible: false,
            railVisible: true,
            railColor: '#fff',
            railOpacity: 1,
            wheelStep: 10,
            allowPageScroll: false,
            disableFadeOut: true
        });
        $("#chat-circle").click(function() {
            $("#chat-circle").toggle('scale');
            $(".chat-box").toggle('scale');
            load_chat();
        });
        $(".chat-box-toggle").click(function() {
            $("#chat-circle").toggle('scale');
            $(".chat-box").toggle('scale');
            $('.chat-logs').html('');
        });
    });

    function sendMessage() {
        var message = $('#chat-input').val();
        $.ajax({
            url: "{{ route('chat.send') }}",
            type: "POST",
            data: {
                message: message,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status == "success") {
                    success_toastr(response.message);
                    $('#chat-input').val('');
                    $('.chat-logs').append(
                        '<div class="chat-msg self">' +
                        '<div class="cm-msg-text">' + message + '</div>' +
                        '</div>'
                    );
                } else {
                    error_toastr(response.message);
                }
                $('#chat-input').val('');
                $('.chat-logs').scrollTop($('.chat-logs')[0].scrollHeight);
            }
        });
    }

    function load_chat() {
        $.get("{{ route('chat.index') }}", function(data) {
            $.each(data, function(index, value) {
                if (value.sent_by == "{{ Auth::user()->id }}") {
                    $('.chat-logs').append(
                        '<div class="chat-msg self">' +
                        '<div class="cm-msg-text">' + value.message + '</div>' +
                        '</div>'
                    );
                } else {
                    $('.chat-logs').append(
                        '<div class="chat-msg user">' +
                        '<div class="cm-msg-text">' + value.message + '</div>' +
                        '</div>'
                    );
                }
            });
            $('.chat-logs').animate({
                scrollTop: $('.chat-logs')[0].scrollHeight
            }, 2500);
        });
    }
</script>
