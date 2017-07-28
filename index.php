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
            .horario_aula {
                font-size: 0.5em;
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
            $cod_professor = '49718';
            $modulo['2'] = [];
            $modulo['3'] = [];
            $modulo['4'] = [];
            $modulo['5'] = [];
            $modulo['6'] = [];
            $modulo['7'] = [];

            $mysqli = mysqli_connect("localhost", "root", "", "eaish_2");
            $query = "SELECT * FROM `hora_prof` WHERE `cod_professor`='$cod_professor';";
            $sql = mysqli_query($mysqli, $query) or die();
            while ($con = mysqli_fetch_array($sql)) {
                $horarios = str_split(trim($con['horario']));
                foreach ($horarios as $horario) {
                    if (is_numeric($horario)) {
                        $index = $horario;
                    } else {
                        if ($horario != "")
                            array_push($modulo[$index], $horario);
                    }
                }
            }

            $horarios = ['AULA', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'L', 'M', 'N', 'O', 'P', 'Q'];
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

            $horas_aula = ['AULA' => '',
                'A' => '7;30-8:20',
                'B' => '8:20-9:10',
                'C' => '9:20-10:10',
                'D' => '10:10-11:00',
                'E' => '11:10-12:00',
                'F' => '12:00-12:50',
                'G' => '13:00-13:50',
                'H' => '13:50-14:40',
                'I' => '14:50-15:40',
                'J' => '15:40-16:30',
                'L' => '16:40-17:30',
                'M' => '17:30-18:20',
                'N' => '18:30-19:20',
                'O' => '19:20-20:10',
                'P' => '20:20-21:10',
                'Q' => '21:10-22:00',
            ];
            $dias = ['AULA', 'ADM', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];

            $diasNumero = [
                'Segunda' => 2,
                'Terça' => 3,
                'Quarta' => 4,
                'Quinta' => 5,
                'Sexta' => 6,
                'Sábado' => 7];
            $linha = '';
            //CONSTRUÇÃO TABELA
            
            foreach ($horarios as $horario) {
                $linha.="<tr><td><div class=\"horario_aula\">$horario</div><div class=\"horario_aula\">$horas_aula[$horario]</div></td>";
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
                            if (in_array($horario, $modulo[$diasNumero[$dia]])) {
                                $linha.="<td>AULA</td>";
                            } else {
                                
                                $linha.="<td></td>";
                                
                                /**
                                  $linha.="<td><select name=\"$diasNumero[$dia]$horario\">
                                  <option></option>
                                  <option value=\"ADM\">ADM</option>
                                  <option value=\"PES\">PES</option>
                                  <option value=\"EXT\">EXT</option>
                                  </select></td>";
                                 * 
                                 */
                                
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
