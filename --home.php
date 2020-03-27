<?php
    // session_start();

    // if(!isset($_SESSION['logado'])){
    //     header("Location: index.php");
    // }

    // // if(isset($_GET['deslogar'])){
    // //     session_destroy();
    // //     header("Location: index.php");
    // // }

    // include_once ('backEnd/conexao.php');
    // require_once ('backEnd/backPolicial.php');
    // $dados = preAtualizar($_SESSION['cod']);

    // foreach ($dados as $row) {
    //     # code...
    //     $nome = $row['nomePolicial'];
    //     $ident = $row['identificaoPolicial'];
    //     $rg = $row['rgPolicial'];
    //     $emailPolicial = $row['tipoSanguineo'];
    //     $foto = $row['fotoPolicial'];
    // }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Administração</title>
    <link rel="stylesheet" href="css/estilo-home.css">
</head>
<body>

    <nav class="espaco-menu">
        <div class="logo-sistema-espaco">
            <img src="img/blitz-texto-branco.png" class="logo-sistema">
        </div>
        <ul class="menu">
            <li class="item-menu"><a href="view/policial/form-perfil.php" class="link-menu-home">PERFIL</a></li>
            <li class="item-menu"> <img src="img/<?php echo $foto?>" class="foto-perfil"> </li>
            <li class="item-menu"> <a href="backEnd/backPolicial.php?option=deslogar" class="link-menu-home"> SAIR </a> </li>
        </ul>
    </nav>
    
      <section class="home">
        <div class="conteudo">
            <div class="h1-espaco">
                <h1 class="bem-vindo">BEM-VINDO(A) <?php echo $nome;?></h1>
            </div>

            <p class='info'>Selecione uma das opções abaixo para começar:</p>

            <div class="btn-group">
                <a href="view/policial/form-policial.php" class="link-btn">
                    <div class="btn-inicio">
                        <div class="icon">
                            <img src="img/policeman-w.png" alt="Policial" class='icon-btn'>
                        </div>

                        <div class="nome-opc">CADASTROS POLICIAIS</div>
                    </div>
                </a>

                <a href="view/veiculo/form-veiculo.php" class="link-btn">
                <div class="btn-inicio">
                        <div class="icon">
                        <img src="img/police-car-w.png" alt="Emergencias" class='icon-btn'>    
                        </div>

                        <div class="nome-opc">CADASTRO DE VEÍCULOS</div>
                    </div>
               </a>

               <a href="view/cidadao/form-cidadao.php" class="link-btn">
                    <div class="btn-inicio">
                        <div class="icon">
                            <img src="img/users-w.png" alt="Usuario" class='icon-btn'>
                        </div>

                        <div class="nome-opc">CIDADÃO</div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</body>
</html>