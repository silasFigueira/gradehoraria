<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            col {
                width: 200px;
            }
            td {
                border-collapse: collapse;
                border: 1px dotted black;
                text-align: center;
                padding: 5px;
            }
        </style>



    </head>
    <body>
        <table>
            <colgroup>
                <col style="width: 200px">
                <col style="width: 200px">
                <col style="width: 200px">
                <col style="width: 200px">
                <col style="width: 200px">
                <col style="width: 200px">
                <col style="width: 200px">
                <col style="width: 200px">
                <col style="width: 200px">
            </colgroup>


            <?php

            $horarioDia['47320'] = ['2', '5'];
            $horarioHora['47320'] = ['N', 'O', 'P', 'Q'];

            $horarios = ['AULA', 'A', 'B', 'C', 'E', 'F', 'G', 'H', 'I', 'J', 'L', 'M', 'N', 'O', 'P', 'Q'];
            $horas = ['AULA' => '',
                'A' => '7h',
                'B' => '8h',
                'C' => '9h',
                'D' => '10h',
                'E' => '11h',
                'F' => '12h',
                'G' => '13h',
                'H' => '14h',
                'I' => '15h',
                'J' => '16h',
                'L' => '17h',
                'M' => '18h',
                'N' => '19h',
                'O' => '20h',
                'P' => '21h',
                'Q' => '22h',
            ];
            $dias = ['AULA', 'ADM', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];

            $diasNumero = [
                'Segunda' => '2',
                'Terça' => '3',
                'Quarta' => '4',
                'Quinta' => '5',
                'Sexta' => '6',
                'Sábado' => '7'];
            $linha = '';
            foreach ($horarios as $horario) {
                $linha.="<tr><td>$horario</td>";
                if ($horario == 'AULA') {
                    foreach ($dias as $dia) {
                        if ($dia != "AULA") {
                            $linha.="<td>$dia</td>";
                        }
                    }
                } else {
                    $linha.="<td>$horas[$horario]</td>";

                    foreach ($dias as $dia) {
                        if ($dia == 'AULA') {
                            
                        } elseif ($dia == 'ADM') {
                            
                        } else {
                            if (in_array($diasNumero[$dia], $horarioDia['47320']) and in_array($horario, $horarioHora['47320'])) {
                                $linha.="<td>AULA</td>";
                            } else {
                                $linha.="<td></td>";
                            }
                        }
                    }
                }


                $linha.="</tr>";
            }

            echo $linha;

            ?>
        </table>

    </body>
</html>
