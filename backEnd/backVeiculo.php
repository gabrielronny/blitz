<?php

    $option = null;
    $cod = null;

    //Verificando de existe um GET option
    if(isset($_GET['option'])){
        $option = $_GET['option'];
    }
    //Selecionando a função
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

        case 'update':
            atualizar();
        default:
            # code...
            break;
    }
    //Declarando as funções
    function cadastrar(){
        include ('conexao.php');
        

        $modelo = addslashes($_POST['txtModelo']);
        $placa = addslashes($_POST['txtPlaca']);
        $chassi = addslashes($_POST['txtChassi']);
        $status = addslashes($_POST['txtStatus']);
        $cidadao = addslashes($_POST['txtCidadao']);
        
        			
        try {
            $stmt = $pdo->prepare("INSERT INTO tbVeiculo (modeloVeiculo, placaVeiculo, chassiVeiculo, codStatus, codCidadao)
                                        VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $modelo);
            $stmt->bindParam(2, $placa);
            $stmt->bindParam(3, $chassi);
            $stmt->bindParam(4, $status);
            $stmt->bindParam(5, $cidadao);
           

            $stmt->execute();

            if($stmt->rowCount() == 1){
                echo "<script>
                            window.location.href = '../view/veiculo/form-veiculo.php?status=cadastro';
                    </script>";
            }else{
                echo "<script>
                            alert('Ops.. Houve um erro ao cadastrar');
                            window.location.href = 'javascript:history.back()';
                    </script>";
            }
        } catch (PDOException $th) {
            echo 'erro: '.$th->getMessage();
        }
    }

    function listar(){
        include ('conexao.php');

        try{
            $stmt = $pdo->prepare(
                "SELECT codVeiculo, modeloVeiculo, placaVeiculo, 
                    chassiVeiculo, codCidadao, descStatus FROM tbveiculo 
                        INNER JOIN tbstatusveiculo
                            on tbveiculo.codStatus = tbstatusveiculo.codStatus

                
                ");

            $stmt->execute();
            
            $linha = $stmt->fetchAll();
            return $linha;
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }

    }

    function deletar(){
        include ('conexao.php');

        if(isset($_GET['cod'])){
            $cod = addslashes($_GET['cod']);
        }
        try {
            $stmt = $pdo->prepare("DELETE FROM tbveiculo
                                    WHERE codVeiculo = ?");
            $stmt->bindParam(1, $cod);
            $stmt->execute();

            if($stmt->rowCount() == 1){
                echo "<script>
                        window.location.href = '../view/veiculo/form-veiculo.php?status=deletado';
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

    function atualizar(){

        try {
            
            include ('conexao.php');
        
            $stmt = $pdo->prepare("SELECT * FROM tbveiculo WHERE codVeiculo = ? ");
            $stmt->bindParam(1, $cod);

            $stmt->execute();
            $row = $stmt->fetchAll();
            return $row;

        } catch (Exception $e) {
            
            echo("Error: ". $e->getMessage());
        
        }



    }

    
?>