<?php
    if ( session_status() !== PHP_SESSION_ACTIVE ){
       session_start();
    }   

    $option = null;
    $cod = null;

    if(isset($_GET['option'])){
        $option = $_GET['option'];
    }

    switch ($option) {
        case 'cadastrar':
            cadastrar();
            break;

        case 'logar':
            loginPolicial();
            break;
        
        case 'deletar':
            deletar();
            break;

        case 'atualizar':
            atualizar();
            break;

        case 'deslogar':
            deslogar();
            break;

        case 'trocarSenha':
            trocarSenha();
            break;
        
    }

    function cadastrar(){
        include ('conexao.php');
        
        $formatoFoto = array("png", "jpeg", "jpg");
        $extensao = pathinfo($_FILES['txtFoto']['name'], PATHINFO_EXTENSION);

        if(in_array($extensao, $formatoFoto)){
            $pasta = "../img/";
            $tmp = $_FILES['txtFoto']['tmp_name'];
            $newName = uniqid().".$extensao";

            move_uploaded_file($tmp, $pasta.$newName);

            $nome = addslashes($_POST['txtNome']);
            //$foto = addslashes($_POST['txtFoto']);
            $document = addslashes($_POST['txtIdentificacao']);
            $rg = addslashes($_POST['txtRG']);
            $email = addslashes($_POST['txtEmail']);
            $patente = addslashes($_POST['txtPatente']);
            $sangue = addslashes($_POST['txtTipoSangue']);
            $senha  = gerarSenha(8, true, true, true);
    
            try {
                $stmt = $pdo->prepare("INSERT INTO tbPolicial (nomePolicial, identificaoPolicial, rgPolicial, codPatente, tipoSanguineo, senhaPolicial, emailPolicial, fotoPolicial)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $document);
                $stmt->bindParam(3, $rg);
                $stmt->bindParam(4, $patente);
                $stmt->bindParam(5, $sangue);
                $stmt->bindParam(6, $senha);
                $stmt->bindParam(7, $email);
                $stmt->bindParam(8, $newName);
    
                $stmt->execute();
    
                if($stmt->rowCount() == 1){

                    enviarEmail($nome, $email, $senha);

                    echo "<script>
                                window.location.href = '../view/policial/form-policial.php?status=cadastro';
                        </script>";
                }else{
                    echo "<script>
                                alert('Erro ao cadastrar');
                                window.location.href = 'javascript:history.back()';
                        </script>";
                }
            } catch (PDOException $th) {
                echo 'erro: '.$th->getMessage();
            }

        }else{
            echo "<script>
                    window.location.href = '../view/policial/form-policial.php?status=arqErrado';
                </script>";
        }

       
    }

    function listar(){
        include ('conexao.php');

        try{
            $stmt = $pdo->prepare("SELECT codPolicial, nomePolicial, identificaoPolicial, tbPatente.descPatente as patente, emailPolicial FROM tbPolicial
                                    INNER JOIN tbPatente
                                        on tbPatente.codPatente = tbPolicial.codPatente");

            $stmt->execute();
            // $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $linha = $stmt->fetchAll();
            return $linha;
        }catch(PDOException $th){
            echo $th->getMessage();
        }

    }

    function deletar(){
        include ('conexao.php');

        if(isset($_GET['cod'])){
            $cod = addslashes($_GET['cod']);
        }else{
            echo "<script>
                        alert('erro de dados);
                        window.location.href = 'javascript:history.back()';
                    </script>";
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM tbPolicial
                                    WHERE codPolicial = ?");
            $stmt->bindParam(1, $cod);
            $stmt->execute();

            if($stmt->rowCount() == 1){
                echo "<script>
                        window.location.href = '../view/policial/form-policial.php?status=deletado';
                    </script>";
            }else{
                echo "<script>
                        alert('não foi possível deletar');
                        window.location.href = 'javascript:history.back()';
                    </script>";
            }
        } catch (PDOException $th) {
            echo "Erro: ".$th->getMessage();
        }
    }

    function preAtualizar($cod){
        include ('conexao.php');

        try{
            $stmt = $pdo->prepare("SELECT nomePolicial, identificaoPolicial, rgPolicial, emailPolicial, codPatente, tipoSanguineo, fotoPolicial FROM tbPolicial
                                        WHERE codPolicial = ?");
            $stmt->bindParam(1, $cod);
            $stmt->execute();
            $linha = $stmt->fetchAll();

            return $linha;
        }catch(PDOException $th){
            echo "Erro: ".$th->getMessage();
        }
    }

    function atualizar(){
        include ('conexao.php');

        if(isset($_GET['cod'])){
            $cod = addslashes($_GET['cod']);
        }

        if(isset($_GET['tela'])){
            $tela = $_GET['tela'];
        }


        $nome = addslashes($_POST['nomePolicial']);
        $identificao = addslashes($_POST['identificaoPolicial']);
        $rg = addslashes($_POST['rgPolicial']);
        $email = addslashes($_POST['emailPolicial']);
        $patente = addslashes($_POST['patentePolicial']);
        $tipoSangue = addslashes($_POST['tipoSangue']);

        try {
            $stmt = $pdo->prepare("UPDATE tbPolicial
                                    SET nomePolicial = ?, identificaoPolicial = ?, rgPolicial = ?, emailPolicial = ?, codPatente = ?, tipoSanguineo = ?
                                    WHERE codPolicial = ?");
            
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $identificao);
            $stmt->bindParam(3, $rg);
            $stmt->bindParam(4, $email);
            $stmt->bindParam(5, $patente);
            $stmt->bindParam(6, $tipoSangue);
            $stmt->bindParam(7, $cod);

            $stmt->execute();

            if($stmt->rowCount() == 1){

                if($tela == 'cadastro'){
                    echo "<script>
                            window.location.href = '../view/policial/form-policial.php?status=alterado';
                    </script>";
                }

                if ($tela == 'perfil') {
                    echo "<script>
                            window.location.href = '../view/policial/form-perfil.php?status=alterado';
                    </script>";
                }
                
            }else{
                echo "<script>
                            alert('Erro ao alterar');
                            window.location.href = 'javascript:history.back()';
                    </script>";
            }
        } catch (PDOException $th) {
            echo 'erro '.$th->getMessage();
        }
    }

    function loginPolicial(){
        include ('conexao.php');

        $login = addslashes($_POST['identificacaoUser']);
        $senha = addslashes($_POST['passwordUser']);

        try {
            $stmt = $pdo->prepare("SELECT codPolicial FROM tbPolicial
                                        WHERE identificaoPolicial = ? AND senhaPolicial = ?");
            $stmt->bindParam(1, $login);
            $stmt->bindParam(2, $senha);
            $stmt->execute();

            if($stmt->rowCount() == 1){

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $cod = $row['codPolicial'];
                }

                session_start();
                $_SESSION['logado'] = true;
                $_SESSION['cod'] = $cod;

                
                header("Location: ../view/dashboard/index.php");
            }else{
                header("Location: ../index.php?aviso=erro");
            }
            
        } catch (PDOException $th) {
            echo 'erro: '.$th->getMessage();
        }
    }

    function trocarSenha(){
        include ('conexao.php');

        $identificaoPolicial = addslashes($_POST['txtIdentificacao']);
        $emailPolicial = addslashes($_POST['txtEmail']);

        try {
            $stmt = $pdo->prepare("SELECT codPolicial, nomePolicial FROM tbPolicial
                                        WHERE identificaoPolicial = ? AND emailPolicial = ?");

            $stmt->bindParam(1, $identificaoPolicial);
            $stmt->bindParam(2, $emailPolicial);
            $stmt->execute();

            if($stmt->rowCount() == 1){
                $senha = gerarSenha(8, true, true, true);

                //cadastrar a nova senha no banco
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $id = $row['codPolicial'];
                    $nome = $row['nomePolicial'];
                }
                $stmt2 = $pdo->prepare("UPDATE tbPolicial
                                            SET senhaPolicial = ?
                                            WHERE codPolicial = ?");
                $stmt2->bindParam(1, $senha);
                $stmt2->bindParam(2, $id);
                $stmt2->execute();

                if($stmt2->rowCount() == 1){
                //enviar a senha no email

                    enviarEmail($nome, $emailPolicial, $senha);

                    echo "<script>
                            alert('Alterado com Sucesso')
                            window.location.href = 'javascript:history.back()'
                        </script>";
                }else{
                    echo "<script>
                            alert('erro ao alterar a senha')
                            window.location.href = 'javascript:history.back()'
                        </script>";
                }
            }else{
                echo "<script>
                    alert('Identificação ou email errados')
                    window.location.href = 'javascript:history.back()'
                </script>";
            }
        } catch (PDOException $th) {
            echo 'erro '.$th->getMessage();
        }
    }

    function gerarSenha($tamanho, $maiuscula, $minuscula, $numero){
        $ma = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $mi = "abcdefghijklmnopqrstuvwxyz";
        $num = "0123456789";
        $senha = "";

        if($maiuscula){
            $senha .= str_shuffle($ma);
        }

        if($minuscula){
            $senha .= str_shuffle($mi);
        }

        if($numero){
            $senha .= str_shuffle($num);
        }

        return substr(str_shuffle($senha), 0, $tamanho);
    }

    function deslogar(){
        session_destroy();
        header("Location: ../index.php");
    }

    function enviarEmail($nomePolicial, $emailPolicial, $senha)
    {
        require("../PHPMailer/src/PHPMailer.php");
        require("../PHPMailer/src/SMTP.php");
    
        
            if(filter_var($emailPolicial, FILTER_VALIDATE_EMAIL)){
                
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP(); 
                $mail->SMTPDebug = 1; 
                $mail->SMTPAuth = true; 
                $mail->SMTPSecure = 'ssl'; 
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465; 
                $mail->IsHTML(true);
                $mail->Username = "backend.lunar@gmail.com";
                $mail->Password = "lunarEtecEnterprise2019";
                $mail->SetFrom("backend.lunar@gmail.com");
                $mail->Subject = "Senha de login";
                $mail->Body = "Obrigado Policial {$nomePolicial}, sua Senha para o login é: {$senha} ";
                $mail->AddAddress($emailPolicial);
                
            }
        
    }
?>