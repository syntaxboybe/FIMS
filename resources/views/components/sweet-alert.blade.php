@props(['title' => '', 'text' => '', 'type' => 'success', 'confirmButton' => true])

@once
    @push('scripts')
    <script>
        // Make sure our implementation takes priority
        window.showAlert = function(type, title, text, confirmButton = true) {
            const isDarkMode = document.documentElement.classList.contains('dark');

            const options = {
                icon: type,
                title: title,
                text: text,
                buttonsStyling: true,
                background: isDarkMode ? '#303446' : '#ffffff',
                color: isDarkMode ? '#c6d0f5' : '#000000',
                confirmButtonColor: '#8caaee',
                cancelButtonColor: '#e78284'
            };

            // Success messages should always auto-close
            if (type === 'success' || !confirmButton) {
                options.showConfirmButton = false;
                options.timer = 3000;
                options.timerProgressBar = true;
            }

            Swal.fire(options);
        };

        // Apply dark mode styling to any active SweetAlert when theme changes
        document.addEventListener('theme-changed', function(e) {
            const isDarkMode = e.detail.theme === 'dark';
            const currentPopup = document.querySelector('.swal2-container .swal2-popup');

            if (currentPopup) {
                currentPopup.style.background = isDarkMode ? '#303446' : '#ffffff';
                currentPopup.style.color = isDarkMode ? '#c6d0f5' : '#000000';
            }
        });

        // Process flash messages when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Process flash messages with priority for success messages
            setTimeout(function() {
                @if (session('success'))
                    showAlert('success', 'Success', "{{ session('success') }}", false);
                @elseif (session('error'))
                    showAlert('error', 'Error', "{{ session('error') }}", true);
                @elseif (session('warning'))
                    showAlert('warning', 'Warning', "{{ session('warning') }}", true);
                @elseif (session('info'))
                    showAlert('info', 'Information', "{{ session('info') }}", true);
                @endif
            }, 100);
        });

        // Function to handle confirmation dialogs
        window.confirmAction = function(message, confirmText, cancelText, actionUrl, method = 'POST') {
            const isDarkMode = document.documentElement.classList.contains('dark');

            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: confirmText,
                cancelButtonText: cancelText,
                buttonsStyling: true,
                reverseButtons: true,
                background: isDarkMode ? '#303446' : '#ffffff',
                color: isDarkMode ? '#c6d0f5' : '#000000',
                confirmButtonColor: '#8caaee',
                cancelButtonColor: '#e78284'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = actionUrl;
                    form.style.display = 'none';

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

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
