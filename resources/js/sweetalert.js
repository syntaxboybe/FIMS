// SweetAlert helper functions

// Show alert notification
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

// Handle session flash messages
document.addEventListener('DOMContentLoaded', function() {
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
    Swal.fire({
        title: 'Are you sure?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: confirmText || 'Yes, do it!',
        cancelButtonText: cancelText || 'Cancel',
        customClass: {
            confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2',
            cancelButton: 'bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'
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
