const form = document.getElementById('form_pdf');

form.addEventListener('submit', function (e) {
    setTimeout(() => {
        form.reset();
    }, 500);
});