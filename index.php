<?php

$cidades = [
    "Nova York" => "America/New_York",
    "Londres" => "Europe/London",
    "Paris" => "Europe/Paris",
    "Tóquio" => "Asia/Tokyo",
    "Sydney" => "Australia/Sydney"
];

$cidadeSelecionada = $_GET['cidade'] ?? null;
$dataAtual = null;

if ($cidadeSelecionada && isset($cidades[$cidadeSelecionada])) {
    $fuso = new DateTimeZone($cidades[$cidadeSelecionada]);
    $data = new DateTime("now", $fuso);

    $dataAtual = $data->format("d/m/Y");
    $horaAtual = $data->format("H:i:s");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Travel Time</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0077b6, #00b4d8);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .container {
            background-color: white;
            width: 90%;
            max-width: 500px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #0077b6;
            font-size: 36px;
            margin-bottom: 10px;
        }

        .subtitulo {
            color: #666;
            margin-bottom: 30px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #00b4d8;
            border-radius: 8px;
            font-size: 16px;
            background-color: white;
            cursor: pointer;
        }

        .resultado {
            margin-top: 30px;
            padding: 25px;
            background-color: #eafaff;
            border-radius: 12px;
        }

        .resultado h2 {
            color: #0077b6;
            margin-bottom: 15px;
        }

        .data {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .hora {
            font-size: 36px;
            font-weight: bold;
            color: #00b4d8;
        }

        .aviso {
            margin-top: 30px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>✈️ Travel Time</h1>

        <p class="subtitulo">
            Descubra o horário atual em diferentes cidades do mundo.
        </p>

        <form method="GET">

            <label for="cidade">Escolha uma cidade:</label>

            <select name="cidade" id="cidade" onchange="this.form.submit()">

                <option value="">Selecione uma cidade</option>

                <?php foreach ($cidades as $cidade => $fuso): ?>

                    <option
                        value="<?= htmlspecialchars($cidade) ?>"
                        <?= ($cidadeSelecionada === $cidade) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($cidade) ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </form>

        <?php if ($dataAtual): ?>

            <div class="resultado">

                <h2><?= htmlspecialchars($cidadeSelecionada) ?></h2>

                <p class="data">
                    📅 <?= $dataAtual ?>
                </p>

                <p class="hora">
                    🕐 <?= $horaAtual ?>
                </p>

            </div>

        <?php else: ?>

            <p class="aviso">
                Selecione uma cidade para consultar a data e o horário atual.
            </p>

        <?php endif; ?>

    </div>

</body>

</html>
