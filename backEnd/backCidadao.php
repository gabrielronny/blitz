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

            $nome = addslashes($_POST['txNome']);
            $cpf = addslashes($_POST['txCpf']);
            $cep = addslashes($_POST['txCep']);
            $logradouro = addslashes($_POST['txLogradouro']);
            $complemento = addslashes($_POST['txComplemento']);
            $numero = addslashes($_POST['txNumero']);
            $bairro = addslashes($_POST['txBairro']);
            $cidade = addslashes($_POST['txCidade']);

            $orgao = addslashes($_POST['txOrgao']);
            $dtEmissao = addslashes($_POST['txDataEmissao']);
            $numRG = addslashes($_POST['txNumRG']);    
            $status = addslashes($_POST['txtStatus']);
            $dtNasc= addslashes($_POST['txDataNasc']);       

            try {
                $stmt = $pdo->prepare("INSERT INTO tbCidadao (nomeCidadao, cpfCidadao, logradouro, complemento, numero, bairro, cep, cidade, fotoCidadao, codStatusCidadao)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $cpf);
                $stmt->bindParam(3, $logradouro);
                $stmt->bindParam(4, $complemento);
                $stmt->bindParam(5, $numero);
                $stmt->bindParam(6, $bairro);
                $stmt->bindParam(7, $cep);
                $stmt->bindParam(8, $cidade);
                $stmt->bindParam(9, $newName);
                $stmt->bindParam(10, $status);
                $stmt->execute();



                $queryCode = $pdo->query("SELECT MAX(codCidadao) FROM tbCidadao");

                while($row =  $queryCode->fetch(PDO::FETCH_ASSOC)){

                    $cod = $row['MAX(codCidadao)'];

                    $insertRG = $pdo->prepare("
                        INSERT INTO tbRg(orgaoEmissor, dataEmissao, numeroRg, codCidadao, dataNascimento )
                            VALUES (?, ?, ?, ?, ?)

                        ");

                    $insertRG->bindParam(1, $orgao);
                    $insertRG->bindParam(2, $dtEmissao);
                    $insertRG->bindParam(3, $numRG);
                    $insertRG->bindParam(4, $cod);
                    $insertRG->bindParam(5, $dtNasc);

                    $insertRG->execute();
                }

    
                
                if($stmt->rowCount() == 1){
                    echo "<script>
                                window.location.href = '../view/cidadao/form-cidadao.php?status=cadastro';
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
                    window.location.href = '../view/cidadao/form-cidadao.php?status=arqErrado';
                </script>";
        }
        

        
    }
    function listar(){
    	include ('conexao.php');

        try{
            $stmt = $pdo->prepare("SELECT * FROM tbCidadao
						
						INNER JOIN tbRg 
							on tbCidadao.codCidadao = tbRg.codCidadao
                                WHERE tbCidadao.codStatusCidadao != 4

            	");

            $stmt->execute();
            $linha = $stmt->fetchAll();
            return $linha;
        }catch(PDOException $th){
            echo $th->getMessage();
        }
    }

    function preAtualizar($cod){
        include ('conexao.php');

        try{
            $stmt = $pdo->prepare("SELECT * FROM tbCidadao 

					
						WHERE codCidadao = ? 


					");
            $stmt->bindParam(1, $cod);
            $stmt->execute();
            
            $linha = $stmt->fetchAll();

            return $linha;

            $pdo = null;
        }catch(PDOException $th){
            echo "Erro: ".$th->getMessage();
        }
    }

    function atualizar(){
        include ('conexao.php');

        if(isset($_GET['cod'])){
            $cod = addslashes($_GET['cod']);
        }

        $nome = addslashes($_POST['nomeCidadao']);
        $cpf = addslashes($_POST['cpfCidadao']);
        $cep = addslashes($_POST['cepCidadao']);
        $logradouro = addslashes($_POST['logCidadao']);
        $complemento = addslashes($_POST['compleCidadao']);
        $numero = addslashes($_POST['numCidadao']);
        $bairro = addslashes($_POST['bairroCidadao']);
        $cidade = addslashes($_POST['cidadeCidadao']);
       // $rg = addslashes($_POST['rgCidadao']);



        try {
            $stmt = $pdo->prepare("
            	UPDATE tbCidadao
                    SET nomeCidadao = ?, cpfCidadao = ?, logradouro = ?, complemento = ?, numero = ?,
                        bairro = ?, cep = ?, cidade = ?
                            WHERE codCidadao = ?");
           

            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $cpf);
            $stmt->bindParam(3, $logradouro);
            $stmt->bindParam(4, $complemento);
            $stmt->bindParam(5, $numero);
            $stmt->bindParam(6, $bairro);
            $stmt->bindParam(7, $cep);
            $stmt->bindParam(8, $cidade);
            $stmt->bindParam(9, $cod);

            $stmt->execute();

            if($stmt->rowCount() == 1){
                echo "<script>
                            window.location.href = '../view/cidadao/form-cidadao.php?status=alterado';
                    </script>";
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

    function deletar(){
        include ('conexao.php');

        if(isset($_GET['cod'])){
            $cod = addslashes($_GET['cod']);
        }

        try {
            // $stmt = $pdo->prepare("DELETE FROM tbRG 
			// 				WHERE codCidadao = ?");

            // $stmt->bindParam(1, $cod);
            // $stmt->execute();
            
            // $stmt = $pdo->prepare("DELETE FROM tbCidadao
            //                         WHERE codCidadao = ?");
            // $stmt->bindParam(1, $cod);
            // $stmt->execute();

            $stmt = $pdo->prepare("UPDATE tbCidadao SET codStatusCidadao = 4 WHERE codCidadao = ?");
            $stmt->bindParam(1, $cod);
            $stmt->execute();

            


            if($stmt->rowCount() == 1){
                echo "<script>
                        window.location.href = '../view/cidadao/form-cidadao.php?status=deletado';
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