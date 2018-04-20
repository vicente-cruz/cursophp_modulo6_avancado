<?php
require "config.php";
require "classes/reservas.class.php";

// Injeção de dependência
$reservas = new Reservas($pdo);
?>
<h1>Reservas</h1>


<a href="reservar.php">Adicionar Reserva</a><br/><br/>


<form method="GET">
    <select name="ano">
        <?php for ($q = date('Y'); $q >= 2000; $q--): ?>
        <option><?php echo $q; ?></option>
        <?php endfor; ?>
    </select>
    <select name="mes">
        <option>01</option>
        <option>02</option>
        <option>03</option>
        <option>04</option>
        <option>05</option>
        <option>06</option>
        <option>07</option>
        <option>08</option>
        <option>09</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
    </select>
    <input type="submit" value="Mostrar" />
</form>
<?php
if (empty($_GET['ano'])) {
    exit;
}

$data = $_GET['ano'].'-'.$_GET['mes'];

// Dia da semana que cai o dia 1
$dia1 = date('w',strtotime($data.'-01'));
echo "PRIMEIRO DIA:".$dia1."<br/>";

// Total dias de um mês.
$dias = date('t',strtotime($data));
echo "TOTAL DIAS:".$dias."<br/>";

// Busca quantidade de 'linhas' que o mês possui.
$linhas = ceil(($dia1+$dias) / 7);
echo "LINHAS:".$linhas."<br/>";

$dia1 = -$dia1;

// Dia do inicio da primeira linha do calendario
$data_inicio = date('Y-m-d', strtotime($dia1.' days', strtotime($data)));
echo "DATA INICIO 1ª LINHA CALENDARIO: ".$data_inicio."<br/>";

// Ultimo dia do calendario
$data_fim = date('Y-m-d', strtotime(( ($dia1 + ($linhas*7) -1).' days'),strtotime($data)));
echo "DATA FIM ULTIMA LINHA CALENDARIO: ".$data_fim."<br/>";

$lista = $reservas->getReservas($data_inicio, $data_fim);

/*
 * foreach ($lista as $item) {
    $data_inicio = date("d/m/Y", strtotime($item['data_inicio']));
    $data_fim = date("d/m/Y", strtotime($item['data_fim']));
    echo $item['pessoa'].' reservou o carro '.$item['id_carro'].' entre '.$data_inicio.' e '.$data_fim.'<br/>';
}
 */
?>
<hr/>
<?php
require 'calendario.php';
?>