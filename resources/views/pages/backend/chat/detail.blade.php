<div class="card" id="kt_chat_messenger">
    <div class="card-header" id="kt_chat_messenger_header">
        <div class="card-title">
            <div class="d-flex justify-content-center flex-column me-3">
                <a href="javascript:;" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1"
                    id="user_name">
                    {{ $user->name }}
                </a>
            </div>
        </div>
        <div class="card-toolbar">
            {{-- Close chat --}}
            <a href="javascript:;" class="btn btn-icon btn-sm btn-hover-light-primary" data-toggle="tooltip"
                data-placement="left" title="Close chat" id="close_chat" onclick="closeChat()">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path opacity="0.3"
                            d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z"
                            fill="currentColor" />
                        <path
                            d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z"
                            fill="currentColor" />
                    </svg>
                </span>
            </a>
        </div>
    </div>
    <div class="card-body" id="kt_chat_messenger_body">
        <div class="scroll" id="chat_logs" style="height: 300px;">
            @if ($chats != null)
                @if ($chats->sent_by == 1)
                    <div class="d-flex justify-content-end mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column align-items-end">
                            <!--begin::User-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Details-->
                                <div class="ms-3">
                                    <span class="text-muted fs-7 mb-1">{{ $chats->created_at->diffForHumans() }}</span>
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::User-->
                            <!--begin::Text-->
                            <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end"
                                data-kt-element="message-text">
                                {{ $chats->message }}
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                @else
                    <div class="d-flex justify-content-start mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column align-items-start">
                            <!--begin::User-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Details-->
                                <div class="ms-3">
                                    <span class="text-muted fs-7 mb-1">{{ $chats->created_at->diffForHumans() }}</span>
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::User-->
                            <!--begin::Text-->
                            <div class="p-5 rounded bg-light-success text-dark fw-bold mw-lg-400px text-start"
                                data-kt-element="message-text">
                                {{ $chats->message }}
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                @endif
                @foreach ($chats->children as $chat)
                    @if ($chat->sent_by == 1)
                        <div class="d-flex justify-content-end mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-end">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                                    <div class="ms-3">
                                        <span
                                            class="text-muted fs-7 mb-1">{{ $chat->created_at->diffForHumans() }}</span>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end"
                                    data-kt-element="message-text">
                                    {{ $chat->message }}
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @else
                        <div class="d-flex justify-content-start mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-start">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                                    <div class="ms-3">
                                        <span
                                            class="text-muted fs-7 mb-1">{{ $chat->created_at->diffForHumans() }}</span>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-success text-dark fw-bold mw-lg-400px text-start"
                                    data-kt-element="message-text">
                                    {{ $chat->message }}
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @endif
                @endforeach
            @else
                <div class="d-flex flex-column-fluid message p-3">
                    <div class="message-wrapper">
                        <div class="arrow"></div>
                        <div class="text-wrapper">
                            <div class="text">No chats yet</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="card-footer pt-4" id="send_chat">
        <textarea class="form-control form-control-flush mb-3" rows="1" placeholder="Type a message..."
            data-kt-autosize="true" name="message" id="message"></textarea>
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center me-2">
            </div>
            <a class="btn btn-primary" href="javascript:;" data-kt-element="send" onclick="send_chat()">
                <i class="fas fa-paper-plane"></i>
            </a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#chat_logs').scrollTop($('#chat_logs')[0].scrollHeight);
    });

    function send_chat() {
        var message = $('#message').val();
        $.ajax({
            url: "{{ route('backend.chats.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                message: message,
                sent_to: "{{ $user->id }}"
            },
            success: function(response) {
                if (response.status == 'success') {
                    success_toastr(response.message);
                    $('#message').val('');
                    $('#chat_logs').append(
                        '<div class="d-flex justify-content-end mb-10"><div class="d-flex flex-column align-items-end"><div class="d-flex align-items-center mb-2"><div class="ms-3"><span class="text-muted fs-7 mb-1">' +
                        response.time +
                        '</span></div></div><div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text">' +
                        response.content + '</div></div></div>');
                    $('#chat_logs').scrollTop($('#chat_logs')[0].scrollHeight);
                } else {
                    error_toastr(response.message);
                }
            }
        });
    }

    function closeChat() {
        $('#kt_chat_container').hide();
        $('#kt_chat_messenger').hide();
        $('#kt_chat_messenger_header').hide();
        $('#kt_chat_messenger_body').empty();
        $('#kt_chat_messenger_footer').hide();
        $('#send_chat').hide();
    }
</script>
