<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/app.css" type="text/css" rel="stylesheet">
        <title></title>
                <style>

            .caixa{
                width: 100%;
            }
            .corpo{

                width: 40%;
                margin-left: auto;
                margin-right: auto;
                margin-top: 1%;  
            }
        </style>

    </head>
    <body>
       <div class="corpo">
            <table class="table">
                <colgroup>
                    <col style="width: 150px">
                    <col style="width: 150px">
                </colgroup>

                <form action="index.php" method="post">
                    <tr><td>Escolha o professor </td><td>
                            <select class="form-control" name="cod">            
                                <?php
                                require 'funcao.php';
                                selectProfessor();
                                ?>        
                            </select></td>
                    </tr>
                    <tr><td></td><td><button type="submit">Enviar</button></td></tr>                
                </form>
            </table>
        </div>
    </body>
</html>
