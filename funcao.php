<?php

function professor($cod_professor) {
    $mysqli = mysqli_connect("localhost", "root", "", "eaish_2");
    $query = "SELECT  professor FROM eaish_2.hora_prof  where cod_professor='$cod_professor';";
    $sql = mysqli_query($mysqli, $query) or die();
    while ($consulta = mysqli_fetch_array($sql)) {
        $professor = $consulta['professor'];
    }
    return $professor;
}

function selectProfessor() {
    $last = '';
    $mysqli = mysqli_connect("localhost", "root", "", "eaish_2");
    $query = "SELECT * FROM `hora_prof` order by professor;";
    $sql = mysqli_query($mysqli, $query) or die();
    while ($consulta = mysqli_fetch_array($sql)) {
        $nome = $consulta['professor'];
        $cod_professor = $consulta['cod_professor'];

        if ($cod_professor != 80000 || $cod_professor != 87773) {
            if ($last != $nome) {
                $last = $nome;
                echo('<option value="' . $cod_professor . '">' . $nome . '</option>');
            }
        }
    }
}

function grade($cod) {
    
    $cod_professor = $cod;
    $N_aula = 0;
    $N_adm = 0;
    $N_pesq = 0;
    $N_ext = 0;
    
    for($a=2;$a<=7;$a++){
    $aula[$a] = [];   
    $adm[$a] = [];    
    $pesq[$a] = [];    
    $ext[$a] = [];
    $modulo[$a]=[];
    }

    $mysqli = mysqli_connect("localhost", "root", "", "eaish_2");
    $query = "SELECT * FROM `hora_prof` WHERE `cod_professor`='$cod_professor';";
    $sql = mysqli_query($mysqli, $query) or die();

    while ($con = mysqli_fetch_array($sql)) {
        $horarios = str_split(trim($con['horario']));
        $cod_disciplina = $con['cod_disciplina'];

        foreach ($horarios as $horario) {
            if (is_numeric($horario)) {
                $index = $horario;
            } elseif ($cod_disciplina == 'XADM') {
                array_push($adm[$index], $horario);
            } elseif ($cod_disciplina == 'XPESQ') {
                array_push($pesq[$index], $horario);
            } elseif ($cod_disciplina == 'XEXT') {
                array_push($ext[$index], $horario);
            } else {
                array_push($aula[$index], $horario);
            }
            array_push($modulo[$index], $horario);
        }
        
    }

    for ($index = 2; $index < 8; $index++) {
        $vetor = $aula[$index];
        $n = count($vetor);

        if ($vetor != []) {
            for ($i = 1; $i < $n; $i++) {
                $cur = $vetor[$i];
                $j = $i - 1;
                while ($j >= 0 && $vetor[$j] > $cur) {
                    $vetor[$j + 1] = $vetor[$j--];
                    $vetor[$j + 1] = $cur;
                }
            }
        }
        $aula[$index] = $vetor;
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
    $x = 0;

    foreach ($horarios as $horario) {

        if ($horario == 'AULA') {
            $linha.="<tr><td>$horario</td>";
        } else {
            $linha.="<tr><td><div class=\"horario_aula\">$horario</div><div class=\"horario_aula\">$horas_aula[$horario]</div></td>";
        }

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
                    
                } elseif (in_array($horario, $aula[$diasNumero[$dia]])) {
                    $linha.="<td>AULA</td>";
                    $N_aula+=1;
                } elseif (in_array($horario, $adm[$diasNumero[$dia]])) {
                    $linha.="<td>ADM</td>";
                    $N_adm+=1;
                } elseif (in_array($horario, $pesq[$diasNumero[$dia]])) {
                    $linha.="<td>PESQ</td>";
                    $N_pesq+=1;
                } elseif (in_array($horario, $ext[$diasNumero[$dia]])) {
                    $linha.="<td>EXT</td>";
                    $N_ext+=1;
                } else {
                  if ($x > 0 && $x < 16) {
                      if (in_array($horarios[$x - 1], $modulo[$diasNumero[$dia]])or in_array($horarios[$x + 1], $modulo[$diasNumero[$dia]])) {
                      $linha.="<td></td>";
                      } else {

                      //if ($x == 1) {
                      //    $linha.="<td></td>";
                      //} else {
                      $linha.="<td><select class=\"form-control\" name=\"$diasNumero[$dia]$horario\">
                      <option></option>
                      <option value=\"ADM\">ADM</option>
                      <option value=\"PES\">PES</option>
                      <option value=\"EXT\">EXT</option>
                      </select></td>";
                      }
                      } else {

                      $linha.="<td></td>";
                      }
                }
            }
        }
        $linha.="</tr>";
        $x++;
    }

    return $linha;
}

function inserir($cod_professor) {
    $adm_sql = '';
    $pesq_sql = '';
    $ext_sql = '';

    $adm['2'] = [];
    $adm['3'] = [];
    $adm['4'] = [];
    $adm['5'] = [];
    $adm['6'] = [];
    $adm['7'] = [];

    $pesq['2'] = [];
    $pesq['3'] = [];
    $pesq['4'] = [];
    $pesq['5'] = [];
    $pesq['6'] = [];
    $pesq['7'] = [];

    $ext['2'] = [];
    $ext['3'] = [];
    $ext['4'] = [];
    $ext['5'] = [];
    $ext['6'] = [];
    $ext['7'] = [];

    $dias = ['2', '3', '4', '5', '6', '7'];
    $horarios = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'L', 'M', 'N', 'O', 'P', 'Q'];
    $last = '';
    foreach ($dias as $dia) {
        foreach ($horarios as $horario) {
            if (isset($_POST[$dia . $horario])) {
                if ($_POST[$dia . $horario] != '') {

                    if ($_POST[$dia . $horario] == 'ADM') {
                        array_push($adm[$dia], $horario);
                    } elseif ($_POST[$dia . $horario] == 'PES') {
                        array_push($pesq[$dia], $horario);
                    } else {
                        array_push($ext[$dia], $horario);
                    }
                }
            }
        }
    }
    for ($a = 2; $a <= 7; $a++) {
        if ($adm[$a] != []) {
            $adm_sql.=$a;
            foreach ($adm[$a] as $x) {
                $adm_sql.=$x;
            }
            $adm_sql.=" ";
        }
        if ($pesq[$a] != []) {
            $pesq_sql.=$a;
            foreach ($pesq[$a] as $x) {
                $pesq_sql.=$x;
            }
            $pesq_sql.=" ";
        }
        if ($ext[$a] != []) {
            $ext_sql.=$a;
            foreach ($ext[$a] as $x) {
                $ext_sql.=$x;
            }
            $ext_sql.=" ";
        }
    }


    $professor = professor($cod_professor);

    $mysqli = mysqli_connect("localhost", "root", "", "eaish_2");
    $query = "INSERT INTO `hora_prof` ( `periodo`, `cod_disciplina`, `materia`,  `cod_professor`, `professor`, `horario`) "
            . "VALUES ('20172', 'XADM', 'ADMNISTRACAO', '$cod_professor', '$professor', '$adm_sql');";
    $sql = mysqli_query($mysqli, $query) or die();

    $query = "INSERT INTO `hora_prof` ( `periodo`, `cod_disciplina`, `materia`,  `cod_professor`, `professor`, `horario`) "
            . "VALUES ('20172', 'XPESQ', 'PESQUISA', '$cod_professor', '$professor', '$pesq_sql');";
    $sql = mysqli_query($mysqli, $query) or die();

    $query = "INSERT INTO `hora_prof` ( `periodo`, `cod_disciplina`, `materia`,  `cod_professor`, `professor`, `horario`) "
            . "VALUES ('20172', 'XEXT', 'EXTENSAO', '$cod_professor', '$professor', '$ext_sql');";
    $sql = mysqli_query($mysqli, $query) or die();
}
