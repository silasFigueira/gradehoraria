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
            $cod_professor = '49718';


            $horarioDia[$cod_professor] = [];
            $horarioHora[$cod_professor] = [];

            $modulo['2'] = [];
            $modulo['3'] = [];
            $modulo['4'] = [];
            $modulo['5'] = [];
            $modulo['6'] = [];
            $modulo['7'] = [];

            $mysqli = mysqli_connect("localhost", "root", "", "eaish");
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
            print_r($modulo['2']);
            echo "<br>";
            print_r($modulo['3']);
            echo "<br>";
            print_r($modulo['4']);
            echo "<br>";
            print_r($modulo['5']);
            echo "<br>";
            print_r($modulo['6']);
            echo "<br>";
            print_r($modulo['6']);
            echo "<br>";


            /**
              foreach ($horarios as $horario) {
              if (is_numeric($horario)) { {
              if (!in_array($horario, $horarioDia[$cod_professor])) {
              array_push($horarioDia[$cod_professor], $horario);
              }
              }
              } else {
              if (!in_array($horario, $horarioHora[$cod_professor])) {
              array_push($horarioHora[$cod_professor], $horario);
              }
              }
              }
             * 
             */

//            $horarioDia['$cod_professor;'] = ['2', '5'];
//            $horarioHora['$cod_professor;'] = ['N', 'O', 'P', 'Q'];

            print_r($horarioDia[$cod_professor]);
            print_r($horarioHora[$cod_professor]);

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
            $dias = ['AULA', 'ADM', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];

            $diasNumero = [
                'Segunda' => 2,
                'Terça' => 3,
                'Quarta' => 4,
                'Quinta' => 5,
                'Sexta' => 6,
                'Sábado' => 7];
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
                            if (in_array($horario,$modulo[$diasNumero[$dia]] )) {
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
