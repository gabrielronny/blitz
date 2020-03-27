<?php

    include_once ('../../backEnd/conexao.php');
    require_once ('../../backEnd/backPolicial.php');
    require_once ('layout.php');

    if(!isset($_SESSION['logado'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Troca de Senha Policial</title>
</head>
<body>
    
    <section class='conteudo'>
        <h3 class="titulo-form">Troca de Senha</h3>

        <div class="espaco-form">
            <form action="../../backEnd/backPolicial.php?option=trocarSenha" method="post" class="formulario">

                <div class="espaco-campo-form">
                   <div class="pos-flex">
                        <label for="txtIdentificacao" class='label-form'>*Nº Identificação:</label>
                        <input type="text" id='txtIdentificacao' name='txtIdentificacao'  class="campo-form" placeholder='Ex: 222.222.222-22'>
                   </div>
                </div>

                <div class="espaco-campo-form">
                   <div class="pos-flex">
                        <label for="txtEmail" class='label-form'>*Email:</label>
                        <input type="text" name="txtEmail" id="txtEmail" class="campo-form" placeholder='Ex: exemplo@gmail.com'>
                   </div>
                </div>

                <div class="espaco-btn-cadastro">
                    <button class="btn-cadastro">Gerar Senha</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>