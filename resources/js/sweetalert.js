// SweetAlert helper functions

// Show alert notification
window.showAlert = function(type, title, text, confirmButton = true) {
    const isDarkMode = document.documentElement.classList.contains('dark');

    const options = {
        icon: type,
        title: title,
        text: text,
        customClass: {
            popup: isDarkMode ? 'swal2-dark-mode' : '',
            confirmButton: 'swal2-confirm-button',
            cancelButton: 'swal2-cancel-button',
            actions: 'swal2-actions-container'
        },
        buttonsStyling: false
    };

    // Auto-close success messages and notifications without confirm buttons
    if (!confirmButton || type === 'success') {
        options.showConfirmButton = false;
        options.timer = 3000;
        options.timerProgressBar = true;
    }

    Swal.fire(options);
};

// Add custom styles for SweetAlert2
document.addEventListener('DOMContentLoaded', function() {
    const styleEl = document.createElement('style');
    styleEl.textContent = `
        /* Dark mode styling */
        .swal2-dark-mode {
            background-color: #303446 !important; /* frappe-base */
            color: #c6d0f5 !important; /* frappe-text */
        }
        .swal2-dark-mode .swal2-title,
        .swal2-dark-mode .swal2-html-container,
        .swal2-dark-mode .swal2-content {
            color: #c6d0f5 !important; /* frappe-text */
        }

        /* Button styling */
        .swal2-confirm-button {
            background-color: #8caaee !important; /* frappe-blue */
            color: white !important;
            border-radius: 0.375rem !important;
            font-weight: 600 !important;
            padding: 0.625rem 1.25rem !important;
            margin: 0.25rem !important;
            border: none !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.2s ease !important;
        }

        .swal2-confirm-button:hover {
            background-color: #85c1dc !important; /* frappe-sapphire */
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
        }

        .swal2-cancel-button {
            background-color: #e78284 !important; /* frappe-red */
            color: white !important;
            border-radius: 0.375rem !important;
            font-weight: 600 !important;
            padding: 0.625rem 1.25rem !important;
            margin: 0.25rem !important;
            border: none !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.2s ease !important;
        }

        .swal2-cancel-button:hover {
            background-color: #ea999c !important; /* frappe-maroon */
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
        }

        /* Actions container */
        .swal2-actions-container {
            display: flex !important;
            justify-content: center !important;
            flex-wrap: wrap !important;
            gap: 0.5rem !important;
        }

        /* Animation */
        .swal2-popup {
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
            animation: swal2-show 0.3s !important;
        }

        /* Mobile optimization */
        @media (max-width: 640px) {
            .swal2-popup {
                width: 90% !important;
                font-size: 0.95rem !important;
                padding: 1.25rem !important;
            }
        }
    `;
    document.head.appendChild(styleEl);

    // Success messages
    if (typeof successMessage !== 'undefined' && successMessage) {
        showAlert('success', 'Success!', successMessage, false);
    }

    // Error messages
    if (typeof errorMessage !== 'undefined' && errorMessage) {
        showAlert('error', 'Error!', errorMessage, true);
    }

    // Warning messages
    if (typeof warningMessage !== 'undefined' && warningMessage) {
        showAlert('warning', 'Warning!', warningMessage, true);
    }

    // Info messages
    if (typeof infoMessage !== 'undefined' && infoMessage) {
        showAlert('info', 'Information', infoMessage, false);
    }
});

// Confirmation dialog for actions (delete, etc.)
window.confirmAction = function(message, confirmText, cancelText, url, method = 'POST') {
    const isDarkMode = document.documentElement.classList.contains('dark');

    Swal.fire({
        title: 'Are you sure?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: confirmText || 'Yes, do it!',
        cancelButtonText: cancelText || 'Cancel',
        buttonsStyling: true,
        reverseButtons: true,
        focusCancel: true,
        background: isDarkMode ? '#303446' : '#ffffff',
        color: isDarkMode ? '#c6d0f5' : '#000000',
        confirmButtonColor: '#8caaee',
        cancelButtonColor: '#e78284'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
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
