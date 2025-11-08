const botaoGerarPDF = document.getElementById('gerarPDF');

botaoGerarPDF.addEventListener('click', () => {
    const conteudo = document.getElementById('curriculoPDF');

    const opcoes = {
        margin: [10, 10, 10, 10],
        filename: 'meu_curriculo.pdf',
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
    };

    html2pdf().set(opcoes).from(conteudo).save();
});

