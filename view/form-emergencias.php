<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerênciar Emergências</title>

    <link rel="stylesheet" href="../css/estilo-tela-adm.css">
    <link rel="stylesheet" href="../css/estilo-formularios.css">
</head>
<body>
    
    <nav class="espaco-menu">
        <div class="espaco-foto">
            <img src="../img/logo_sem_borda.png"class="foto">
        </div>

        <hr class="divisa">

        <div class="pos-menu">
            <ul class="menu">
                <li class="item-menu"> <a href="form-policial.php" class="link-menu">POLICIAIS</a> </li>
                <li class="item-menu" style='display:none'> <a href="form-emergencias.php" class="link-menu">EMERGÊNCIAS</a> </li>
                <li class="item-menu"> <a href="form-troca-senha.php" class="link-menu">TROCA DE SENHA POLICIAL</a> </li>
                <li class="item-menu"> <a href="form-perfil.php" class="link-menu">PERFIL</a> </li>
                <li class="item-menu log"> <a href="../index.php" class="link-menu">LOGOUT</a> </li>
            </ul>
        </div>
    </nav>

    <section class='conteudo'>
        <h3 class="titulo-form">Emergências</h3>

        <div class="espaco-form">
            <form action="" class="formulario">

                <div class="espaco-campo-form">
                   <div class="pos-flex">
                        <label for="txtNome" class='label-form'>*Nome:</label>
                        <input type="text" id='txtNome' name='txtNome' class='campo-form' placeholder='Ex: Eduardo Silva'>
                   </div>
                </div>

                <div class="espaco-campo-form">
                   <div class="pos-flex">
                        <label for="txtIdentificacao" class='label-form'>*Nº Identificação:</label>
                        <input type="text" id='txtIdentificacao' name='txtIdentificacao'  class="campo-form" placeholder='Ex: 222.222.222-22'>
                   </div>
                </div>

                <div class="espaco-campo-form">
                    <div class="pos-flex">
                        <label for="txtRg" class='label-form'>*RG:</label>
                        <input type="text" name="txtRg" id="txtRG" class="campo-form" placeholder='Ex: 22.222.222-22'>
                    </div>
                </div>

                <div class="espaco-campo-form">
                   <div class="pos-flex">
                        <label for="txtEmail" class='label-form'>*Email:</label>
                        <input type="text" name="txtEmail" id="txtEmail" class="campo-form" placeholder='Ex: exemplo@gmail.com'>
                   </div>
                </div>

                <div class="espaco-campo-form">
                   <div class="pos-flex">
                        <label for="txtPatente" class='label-form'>*Patente:</label>
                        <select name="txtPatente" id="txtPatente" class='select-form'>
                            <option value="0" selected>Selecionar...</option>
                        </select>
                   </div>
                </div>

                <div class="espaco-campo-form">
                   <div class="pos-flex">
                        <label for="txtTipoSangue" class='label-form'>*Tipo Sanguíneo:</label>
                        <select name="txtTipoSangue" id="txtTipoSangue" class='select-form'>
                            <option value="0" selected>Selecionar...</option>
                        </select>
                   </div>
                </div>

                <div class="espaco-campo-form">
                    <div class="pos-flex">
                        <label for="btn-senha" class='label-form'>*Senha:</label>
                        <button class="btn-gerar-senha" id='btn-senha'>Gerar Senha</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>