
<?php

require 'funcao.php';
session_start();

inserir($_SESSION['cod_professor']);
header('Location:index.php');
?>
