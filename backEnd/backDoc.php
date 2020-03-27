<?php

    $option = null;
    $cod = null;

    if(isset($_GET['option'])){
        $option = $_GET['option'];
    }

    switch ($option) {
        case 'cadastroBoletim':
            cadastroBoletim();
            break;

        case 'deletarBoletim':
            deletarBoletim();
            break;

        case 'cadastroProcesso':
            cadastrarProcesso();
            break;
    }

    function cadastroBoletim(){
        include ('conexao.php');

        $rgCidado = addslashes($_POST['rgCidadao']);
        $data = addslashes($_POST['data']);
        $descrBoletim = addslashes($_POST['descrBoletim']);
        $cod = $_SESSION['cod'];

        try {
            $stmt = $pdo->prepare("SELECT codCidadao FROM tbRg
                                        WHERE numeroRg = ?");

            $stmt->bindParam(1, $rgCidado);
            $stmt->execute();

            if($stmt->rowCount() == 1){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $codCidadao = $row['codCidadao'];
                }
                
                $stmt2 = $pdo->prepare("INSERT INTO tbBoletimOcorrencia (codCidadao, codPolicial, dataBoletim, descrBoletim)
                                            VALUES (?, ?, ?, ?)");

                $stmt2->bindParam(1, $codCidadao);
                $stmt2->bindParam(2, $cod);
                $stmt2->bindParam(3, $data);
                $stmt2->bindParam(4, $descrBoletim);

                $stmt2->execute();

                if($stmt2->rowCount() == 1){
                    echo "<script>
                            window.location.href = '../view/cidadao/form-boletim.php?status=cadastro';
                        </script>";
                }else{
                    echo "<script>
                            alert('Erro ao cadastrar');
                            window.location.href = 'javascript:history.back()';
                        </script>";
                }
            }else{
                echo "<script>
                        window.location.href = '../view/cidadao/form-boletim.php?status=rgErrado';
                    </script>";
            }

        } catch (PDOException $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }

    function listarBoletim(){
        include ('conexao.php');
        
        try {
            $stmt = $pdo->prepare("SELECT codBoletim, descrBoletim, tbCidadao.nomeCidadao as cidadao, DATE_FORMAT(dataBoletim, '%d/%m/%Y') as dataBoletim FROM tbBoletimOcorrencia
                                        INNER JOIN tbCidadao
                                            on tbCidadao.codCidadao = tbBoletimOcorrencia.codCidadao");

            $stmt->execute();

            $linha = $stmt->fetchAll();

            return $linha;
        } catch (PDOException $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }

    function deletarBoletim(){
        include ('conexao.php'); 

        if(isset($_GET['cod'])){
            $cod = $_GET['cod'];
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM tbBoletimOcorrencia
                                    WHERE codBoletim = ?");

            $stmt->bindParam(1, $cod);

            $stmt->execute();

            if($stmt->rowCount() == 1){
                echo "<script>
                        window.location.href = '../view/cidadao/form-boletim.php?status=deletado';
                    </script>";
            }else{
                echo "<script>
                        alert('erro ao deletar');
                        window.location.href = 'javascript:history.back()';
                    </script>";
            }
        } catch (PDOException $th) {
            //throw $th;
            echo $th->getMessage();
        }
        
    }

    function cadastrarProcesso(){
        include ('conexao.php');

        $codBoletim = addslashes($_POST['codBoletim']);
        $stsProcesso = addslashes($_POST['stsProcesso']);
        $descrProcesso = addslashes($_POST['descrProcesso']);
        $veredito = addslashes($_POST['veredito']);
        $artigo = $_POST['artigo'];
        $descrPena = addslashes($_POST['descrPena']);
        $tipoPena = addslashes($_POST['tipoPena']);

        try {
            $stmt1 = $pdo->prepare("INSERT INTO tbProcesso (codBoletim, veredito, codStatusProcesso, descrProcesso)
                                        VALUES (?, ?, ?, ?)");
            $stmt1->bindParam(1, $codBoletim);
            $stmt1->bindParam(2, $veredito);
            $stmt1->bindParam(3, $stsProcesso);
            $stmt1->bindParam(4, $descrProcesso);

            $stmt1->execute();

            if ($stmt1->rowCount() == 1) {
                $sql = $pdo->query("SELECT max(codProcesso) as codProcesso FROM tbProcesso");
                $sql->execute();

                while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                    $codProcesso = $row['codProcesso'];
                }

                $count = count($artigo);

                for($i=0; $i < $count; $i++) {
                    $stmt = $pdo->prepare("INSERT INTO tbArtigoProcesso (codProcesso, codArtigo)
                                                VALUES (?, ?)");
                    $stmt->bindParam(1, $codProcesso);
                    $stmt->bindParam(2, $artigo[$i]);
                    $stmt->execute();
                }

                $sql2 = $pdo->prepare("INSERT INTO tbPena (descrPena, codProcesso, codTipoPena)
                                        VALUES (?, ?, ?)");
                $sql2->bindParam(1, $descrPena);
                $sql2->bindParam(2, $codProcesso);
                $sql2->bindParam(3, $tipoPena);
                $sql2->execute();

                if($sql2->rowCount() == 1){
                    echo "<script>
                        window.location.href = '../view/cidadao/form-processo.php?status=cadastro';
                    </script>";
                }

                

            }else{
                echo "<script>
                        alert('Erro ao cadastrar');
                        window.location.href = 'javascript:history.back()';
                    </script>";
            }
        } catch (PDOexception $th) {
            echo $th->getMessage();
        }
    }
?>