@foreach ($users as $user)
    <div class="d-flex flex-stack py-4">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-45px symbol-circle">
                <span
                    class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <div class="ms-5">
                <a href="javascript:;" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2"
                    onclick="load_detail('{{ route('backend.chats.show', $user->id) }}')">{{ $user->name }}</a>
                <div class="fw-bold text-muted">
                    {{ $user->email }}
                </div>
            </div>
        </div>
    </div>
    <div class="separator separator-dashed d-none"></div>
@endforeach
