
<?php
function getPost(string $key): string {
    return htmlspecialchars(trim($_POST[$key] ?? ''), ENT_QUOTES, 'UTF-8');
}

function formatDate(string $d): string {
    if (!$d) return '';
    $dt = DateTime::createFromFormat('Y-m-d', $d);
    if ($dt) return $dt->format('d/m/Y');
    $dt = DateTime::createFromFormat('Y-m', $d);
    if ($dt) return $dt->format('m/Y');
    return $d;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

$nome = getPost('PHPnome');
$dataNascimentoRaw = getPost('PHPdata-nascimento');
$dataNascimento = formatDate($dataNascimentoRaw);
$nacionalidade = getPost('PHPnacionalidade');
$estadoCivil = getPost('PHPestado-civil');
$cidade = getPost('PHPcidade');
$estado = getPost('PHPestado');
$email = getPost('PHPemail');

$curso = getPost('PHPnome-do-curso');
$instituicao = getPost('PHPinstituicao-de-ensino');
$inicioAcademico = formatDate(getPost('PHPinicioAcademico'));
$terminoAcademico = formatDate(getPost('PHPterminoAcademico'));
$empresa = getPost('PHPnome-da-empresa');
$cargo = getPost('PHPcargo');
$inicioProf = formatDate(getPost('PHPinicioProfissional'));
$terminoProf = formatDate(getPost('PHPterminoProfissional'));
$responsabilidades = nl2br(getPost('PHPresponsabilidades'));
$resumo = nl2br(getPost('PHPresumo-profissional'));
$dataNasc = DateTime::createFromFormat('Y-m-d', $dataNascimentoRaw);

if ($dataNasc === false) {
    $idade = '—';
} else {
    $hoje = new DateTime();
    $idade = $hoje->diff($dataNasc)->y;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Currículo - <?= $nome ?: 'Sem nome' ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section id="curriculoPDF" class="curriculo">
            <header>
                <h1><?= $nome ?></h1>
                <p><?= $cidade ?> - <?= $estado ?> • <?= $email ?></p>
            </header>
            <h2>INFORMAÇÕES PESSOAIS</h2>
            <p><strong>Data de nascimento:</strong> <?= $dataNascimento ?> (<?= $idade ?> anos)</p>
            <p><strong>Nacionalidade:</strong> <?= $nacionalidade ?></p>
            <p><strong>Estado civil:</strong> <?= $estadoCivil ?></p>
            <h2>FORMAÇÃO ACADÊMICA</h2>
            <p><strong>Curso:</strong> <?= $curso ?></p>
            <p><strong>Instituição:</strong> <?= $instituicao ?></p>
            <p><strong>Período:</strong> <?= $inicioAcademico ?> — <?= $terminoAcademico ?></p>
            <h2>EXPERIÊNCIA PROFISSIONAL</h2>
            <p><strong>Empresa:</strong> <?= $empresa ?></p>
            <p><strong>Cargo:</strong> <?= $cargo ?></p>
            <p><strong>Período:</strong> <?= $inicioProf ?> — <?= $terminoProf? $terminoProf : 'Atualmente' ?></p>
            <p><strong>Responsabilidades:</strong><br><?= $responsabilidades ?></p>
            <h2>RESUMO PROFISSIONAL</h2>
            <p><?= $resumo ?></p>
        </section>
        <footer class="rodape">
            <a class="linkVoltar" href="index.html">Voltar</a>
            <button id="gerarPDF" class="botaoGerarPDF">Baixar em PDF</button>
        </footer>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.12.1/html2pdf.bundle.min.js" integrity="sha512-D25Z8/1q2z65ZpJ3NzY6XiPZfwjhbv34OTQHDIZd+KPK+uWCovGt+fMkSzW8ArzCMFUgZt6Cdu7qoXNuy6a2GA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="script.js"></script>
</body>
</html>