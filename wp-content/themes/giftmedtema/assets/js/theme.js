document.addEventListener('DOMContentLoaded', function () {
    const demoForm = document.getElementById('giftmed-demo-form');
    if (demoForm) {
        demoForm.addEventListener('submit', function (event) {
            event.preventDefault();
            alert('Solicitação enviada com sucesso!');
            demoForm.reset();
        });
    }
});
