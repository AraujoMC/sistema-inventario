document.getElementById('formLogin').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value;

    if (email === '' || senha === '') {
        e.preventDefault();
        alert('Preenche email e senha.');
        return;
    }

    if (senha.length < 6) {
        e.preventDefault();
        alert('A senha deve ter pelo menos 6 caracteres.');
    }
});