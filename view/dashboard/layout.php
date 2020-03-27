<?php
  include_once('../panel.php');
    

  session_start();

  if(!isset($_SESSION['logado'])){
      header("Location: ../../ index.php");
  }

  // if(isset($_GET['deslogar'])){
  //     session_destroy();
  //     header("Location: index.php");
  // }

  require_once ('../../backEnd/backPolicial.php');
  require_once ('../../backEnd/backDashboard.php');
  $dados = preAtualizar($_SESSION['cod']);

  foreach ($dados as $row) {
     
      $nome = $row['nomePolicial'];
      $ident = $row['identificaoPolicial'];
      $rg = $row['rgPolicial'];
      $emailPolicial = $row['tipoSanguineo'];
      $foto = $row['fotoPolicial'];
  }

  $dadoBoletim = dadosBoletim();
  $dadoCarro = dadosCarro();
  $dadoProcesso = dadosProcesso();
  $dadoPrisao = dadosPrisao();
  $dadoGraphicLine = dadosGraphicLine();
  $dadoGraphicPie = dadosGraphicPie();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <!--CSS-->
        <link rel="stylesheet" href="../../css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css"/>
        <link rel="stylesheet" href="../../css/chartjs.css">
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>
        
        <!--Scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        
        <script src="https://kit.fontawesome.com/f3846a3688.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/chart.js"></script>
        

    </body>
</html>