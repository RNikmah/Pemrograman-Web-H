let hasil = document.getElementById('result');
let angka1 = '';
let angka2 = '';
let operasi = '';

document.querySelectorAll('.button').forEach(button => {
    button.addEventListener('click', () => {
        const value = button.textContent;

        if (button.classList.contains('ac')) {
            angka1 = '';
            angka2 = '';
            operasi = '';
            hasil.textContent = '0';
            return;
        }

        if (button.classList.contains('equal')) {
            if (angka1 && angka2 && operasi) {
                angka1 = calculate(angka2, angka1, operasi);
                hasil.textContent = angka1;
                angka2 = '';
                operasi = '';
            }
            return;
        }

        if (['+', '-', '×', '÷'].includes(value)) {
            if (angka1) {
                angka2 = angka1;
                angka1 = '';
                operasi = value;
            }
            return;
        }

        angka1 += value;
        hasil.textContent = angka1;
    });
});

function calculate(a, b, operator) {
    const num1 = parseFloat(a);
    const num2 = parseFloat(b);
    if (operator === '+') return (num1 + num2).toString();
    if (operator === '-') return (num1 - num2).toString();
    if (operator === '×') return (num1 * num2).toString();
    if (operator === '÷') return (num1 / num2).toString();
    return b;
}
