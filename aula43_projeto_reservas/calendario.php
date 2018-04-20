<table border="1" width="100%">
    <thead>
        <tr>
            <th>Dom</th>
            <th>Seg</th>
            <th>Ter</th>
            <th>Qua</th>
            <th>Qui</th>
            <th>Sex</th>
            <th>Sab</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($l=0; $l<$linhas; $l++): ?>
        <tr>
            <?php for ($q=0; $q<7; $q++): ?>
            <?php
            $t = strtotime(($q+($l*7))." days",strtotime($data_inicio));
            $w = date('Y-m-d', $t);
            ?>
            <td>
            <?php
                echo date('d/m', $t)."<br/><br/>";
                $w = strtotime($w);
                foreach($lista as $item) {
                    $data_reserva_inicio = strtotime($item['data_inicio']);
                    $data_reserva_fim = strtotime($item['data_fim']);
                    
                    
                    if (($w >= $data_reserva_inicio) && ($w <= $data_reserva_fim)) {
                        echo $item['pessoa']."( ".$item['id_carro']." )"."<br/>";
                    }
                }
            ?>
            </td>
            <?php endfor; ?>
        </tr>
        <?php
        endfor;
        ?>
    </tbody>
</table>