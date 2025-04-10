@props(['title' => '', 'text' => '', 'type' => 'success', 'confirmButton' => true])

@once
    @push('scripts')
    <script>
        window.showAlert = function(type, title, text, confirmButton = true) {
            const options = {
                icon: type,
                title: title,
                text: text,
                customClass: {
                    confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                    cancelButton: 'bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'
                },
                buttonsStyling: false
            };

            if (!confirmButton) {
                options.showConfirmButton = false;
                options.timer = 3000;
                options.timerProgressBar = true;
            }

            Swal.fire(options);
        };

        // Handle flash messages from session
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showAlert('success', 'Success!', '{{ session('success') }}', false);
            @endif

            @if (session('error'))
                showAlert('error', 'Error!', '{{ session('error') }}', true);
            @endif

            @if (session('info'))
                showAlert('info', 'Information', '{{ session('info') }}', false);
            @endif

            @if (session('warning'))
                showAlert('warning', 'Warning', '{{ session('warning') }}', true);
            @endif
        });

        // Handle confirmation dialogs
        window.confirmAction = function(message, confirmText, cancelText, url, method = 'POST') {
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: confirmText || 'Yes, do it!',
                cancelButtonText: cancelText || 'Cancel',
                customClass: {
                    confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2',
                    cancelButton: 'bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'
                },
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = method;
                    form.action = url;
                    form.style.display = 'none';

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    if (method !== 'POST') {
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = method;
                        form.appendChild(methodInput);
                    }

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        };
    </script>
    @endpush
@endonce

@if (isset($slot) && $slot->isNotEmpty())
    <script>
        showAlert('{{ $type }}', '{{ $title }}', '{{ $slot }}', {{ $confirmButton ? 'true' : 'false' }});
    </script>
@endif
