document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('#pulsante');
    
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const desc = button.nextElementSibling; // Seleziona il paragrafo successivo al pulsante
            if (desc.style.display === 'block') {
                desc.style.display = 'none'; // Nasconde il paragrafo
            } else {
                desc.style.display = 'block'; // Mostra il paragrafo
            }
        });
    });
});
