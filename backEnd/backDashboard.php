<?php
    if ( session_status() !== PHP_SESSION_ACTIVE ){
        session_start();
     }

     function dadosBoletim(){
         include ('conexao.php');

         try {
             $stmt = $pdo->query("SELECT count(codBoletim) as dadoVeiculo FROM tbBoletimOcorrencia");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $dadoBoletim = $row['dadoVeiculo'];
            }

            return $dadoBoletim;

         } catch (PDOException $th) {
            echo $th->getMessage();
         }
     }

     function dadosCarro(){
         include ('conexao.php');

         try {
             $stmt = $pdo->query("SELECT count(codVeiculo) as dadoCarro FROM tbVeiculo WHERE codStatus = 4");
             while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                 $dadoCarro = $row['dadoCarro'];
             }

             return $dadoCarro;
         } catch (PDOException $th) {
                echo $th->getMessage();
         }
     }

     function dadosProcesso(){
         include ('conexao.php');

         try {
             $stmt = $pdo->query("SELECT count(codProcesso) as dadoProcesso FROM tbProcesso WHERE codStatusProcesso = 1");
             while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                 $dadoProcesso = $row['dadoProcesso'];
             }

             return $dadoProcesso;
         } catch (PDOException $th) {
            echo $th->getMessage();
         }
     }

     function dadosPrisao(){
         include ('conexao.php');

         try {
             $stmt = $pdo->query("SELECT count(codCidadao) as dadoPrisao FROM tbCidadao WHERE codStatusCidadao = 3");
             while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                 $dadoPrisao = $row['dadoPrisao'];
             }

             return $dadoPrisao;
         } catch (PDOException $th) {
            echo $th->getMessage();
         }
     }

     function dadosGraphicLine(){
         include ('conexao.php');
         $ano = date('Y');
         $mes = "[ ";

         try {
            //  $stmt = $pdo->query("SELECT count(codBoletim) as qtdBoletim FROM tbBoletimOcorrencia WHERE YEAR(dataBoletim) = $ano");
            //  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //     $teste = $row['qtdBoletim'];
            //  }

            for ($i=1; $i <= 12 ; $i++) { 
                $stmt = $pdo->query("SELECT count(codBoletim) as qtdBoletim FROM tbBoletimOcorrencia WHERE YEAR(dataBoletim) = $ano AND MONTH(dataBoletim) = $i");
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $mes .= $row['qtdBoletim'].", ";
                }
            }

            $mes.= "]";

             return $mes;
         } catch (PDOException $th) {
            echo $th->getMessage();
         }
     }

     function dadosGraphicPie(){
         include ('conexao.php');
         $processo = "[ ";
         try {
             for ($i=1; $i <= 2 ; $i++) { 
                 $stmt = $pdo->query("SELECT count(codProcesso) as qtdProcesso FROM tbProcesso WHERE codStatusProcesso = $i");
                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                     $processo .= $row['qtdProcesso'].", ";
                 }
             }

             $processo .= "]";

             return $processo;
         } catch (PDOException $th) {
            echo $th->getMessage();
         }
     }
?>