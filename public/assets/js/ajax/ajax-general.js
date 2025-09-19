document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('general-form');
    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        clearErrors();

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = 'Loading...';
        submitBtn.disabled = true;

        try {

            const formData = new FormData(form);
            const url = form.action || window.location.href;

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',

                },
                body: formData
            });

            const contentType = response.headers.get('content-type');

            const data = await response.json();

            if (data.success) {

                showMessage('success', data.message || 'Operation completed successfully!');
                if (data.redirect) {
                    setTimeout(() => window.location.href = data.redirect, 1000);
                }
                form.reset();
            } else {

                if (data.errors) {
                    showErrors(data.errors);
                } else {
                    showMessage('error', data.message || 'Something went wrong');
                }
            }

        } catch (error) {
            showMessage('error', 'Request failed. Please try again.');
            console.error('AJAX error:', error);
        } finally {

            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });

    function clearErrors() {

        document.querySelectorAll('.error-text').forEach(el => el.remove());
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        const existingMessage = document.getElementById('form-status-message');
        if (existingMessage) existingMessage.remove();
    }

    function showErrors(errors) {
        for (const field in errors) {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-text text-danger mt-1 small';
                errorDiv.textContent = errors[field][0];
                input.parentNode.appendChild(errorDiv);
            }
        }
    }

    function showMessage(type, text) {

        const existingMessage = document.getElementById('form-status-message');
        if (existingMessage) existingMessage.remove();

        const messageDiv = document.createElement('div');
        messageDiv.id = 'form-status-message';
        messageDiv.textContent = text;
        messageDiv.style.padding = '12px';
        messageDiv.style.margin = '10px 0';
        messageDiv.style.borderRadius = '4px';

        if (type === 'success') {
            messageDiv.style.backgroundColor = '#d4edda';
            messageDiv.style.color = '#155724';
            messageDiv.style.border = '1px solid #c3e6cb';
        } else {
            messageDiv.style.backgroundColor = '#f8d7da';
            messageDiv.style.color = '#721c24';
            messageDiv.style.border = '1px solid #f5c6cb';
        }

        form.parentNode.insertBefore(messageDiv, form);
    }
});