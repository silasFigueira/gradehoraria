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
            table, td {
                border-collapse: collapse;
                border: 1px dotted black;
                text-align: center;
                padding: 5px;
            }
            .horario_aula {
                font-size: 0.8em;
            }
            .caixa{
                width: 100%;
            }
            .corpo{

                width: 80%;
                margin-left: auto;
                margin-right: auto;
                margin-top: 5%;  
            }

        </style>



    </head>
    <body>
        <div class="corpo">
            <form action="pesq_exten.php" method="post">
                <table>
                    <colgroup>
                        <col style="width: 150px">
                        <col style="width: 150px">
                        <col style="width: 150px">
                        <col style="width: 150px">
                        <col style="width: 150px">
                        <col style="width: 150px">
                        <col style="width: 150px">
                        <col style="width: 150px">
                        <col style="width: 150px">
                    </colgroup>

                    <?php
                    require 'funcao.php';
                    session_start();
                    if(isset($_POST['cod'])){
                    $_SESSION['cod_professor'] = $_POST['cod'];
                    }
                    echo "Nome do professor: ". professor($_SESSION['cod_professor']);
                    echo grade($_SESSION['cod_professor']);
                    ?>                
                </table>
                <button type="submit">Enviar</button>
            </form>

        </div>
        <script type="text/javascript">

        </script>

    </body>
</html>
