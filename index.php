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
        <link href="css/app.css" type="text/css" rel="stylesheet">
        <style>
            col {
                width: 200px;
            }
            table, td {
                border-collapse: collapse;
                //border: 1px solid black;
                text-align: center;
                //padding: 5px;
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
                margin-top: 1%;  
            }
            .table select {
                background-color: #550000;
                color: white;
                font-weight: bold;
            }

        </style>



    </head>
    <body>
        <div class="corpo">
            <form action="pesq_exten.php" method="post">
                <table class="table">
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
                    if (isset($_POST['cod'])) {
                        $_SESSION['cod_professor'] = $_POST['cod'];
                    }                    
                    ?>
                    <tr><td colspan="4"><a href="professor.php">ESCOLHA O PROFESSOR</a></td><td colspan="4"></td></tr>
                    <tr><td colspan="2"></td><td colspan="5"><?php echo professor($_SESSION['cod_professor']); ?></td>
                        <td><button  class="btn" type="submit">Enviar</button></td>
                    </tr>
                    <?php echo grade($_SESSION['cod_professor']);?>
                    <tr><td colspan="7"></td>
                        <td><button  class="btn" type="submit">Enviar</button></td>
                    </tr>
                </table>

            </form>

        </div>
        <script type="text/javascript">

        </script>

    </body>
</html>
