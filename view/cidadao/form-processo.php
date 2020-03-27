<?php
    session_start();
    require ('layout.php');
    include ('../../backEnd/conexao.php');
    require ('../../backEnd/backDoc.php');
    if(!isset($_SESSION['logado'])){
        header("Location: ../../index.php");
    }
?>

<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Processo Page</title>
  </head>
  <body>
    <div class="center-form">
      <div class="form">
        <p>Processo</p>
        <!-- FORM PROCESSO -->
        <form action="../../backEnd/backDoc.php?option=cadastroProcesso" method="post">

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="codBoletim">Código do boletim</label>
              <select id='codBoletim' name='codBoletim' class="custom-select" required>
                <?php
                  $sql = $pdo->query("SELECT codBoletim FROM tbBoletimOcorrencia");
                  $sql->execute();

                  while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='".$row['codBoletim']."'>".$row['codBoletim']."</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="stsProcesso">Status</label>
              <select name="stsProcesso" id="stsProcesso" class="custom-select" required>
                <?php
                  $conexao = $pdo->query("SELECT codStatusProcesso, descrStatus FROM tbStatusProcesso");
                  $conexao->execute();

                  while($row = $conexao->fetch(PDO::FETCH_ASSOC)){
                      echo "<option value='".$row['codStatusProcesso']."'>".$row['descrStatus']."</option>";
                  }
                
                ?>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="col">
              <label for="descrProcesso">Descricão do processo</label>
              <textarea class="form-control" id='descrProcesso' name='descrProcesso' required></textarea>
            </div>
          </div>



          <div class="form-row">
          <div class="form-group col-md-6 listaDiv" id="divArtigo">
              <label for="artigo">Artigo</label><br>
              <select name="artigo[]" id="artigo" class="custom-select artigoBtn" required>
                <?php
                  $conexao2 = $pdo->query("SELECT descrArtigo, numArtigo, codArtigoPenal FROM tbArtigoPenal");
                  $conexao2->execute();

                  while($row = $conexao2->fetch(PDO::FETCH_ASSOC)){
                      echo "<option value='".$row['codArtigoPenal']."'>".$row['numArtigo']." - ".$row['descrArtigo']."</option>";
                  }
                ?>
              </select>
              <button type="button" class="btn btn-success" onclick="clonaArtigo()">+</button>

            </div>
            <div class="form-group col-md-6">
              <label for="veredito">Veredito</label>
              <input type="text" class="form-control" type="text" id='veredito' name='veredito' required>
            </div>
            <div id="destino"></div>
          </div>

          <div class="form-row">
            <div class="col">
              <label for="descrPena">Descricão da pena</label>
              <textarea class="form-control" name="descrPena" id="descrPena" required></textarea>
            </div>
          </div>


          <div class="form-row">
            <label for="tipoPena">Tipo da pena</label>
            <select name="tipoPena" id="tipoPena"  class="custom-select" required>
              <?php
                $conexao = $pdo->query("SELECT codTipoPena, descrTipoPena FROM tbTipoPena");
                $conexao->execute();

                while($row = $conexao->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='".$row['codTipoPena']."'>".$row['descrTipoPena']."</option>";
                }
              ?>
            </select>
          </div>
          <br>
          <button class="btn-form" type="submit"><i class="fas fa-check"></i>Cadastrar</button>

        </form>
        <!-- FIM FORM PROCESSO -->
        
      </div>

    </div>
      
      <?php
         if (isset($_GET['status'])) {
          $status = $_GET['status'];
  
          switch ($status) {
            case 'cadastro':
              echo "<script>
    
                    document.getElementById('titleModal').innerHTML = 'Cadastrado'
                    document.getElementById('text').innerHTML = 'Cadastrado com Sucesso'
                    $('#statusModal').modal('show')
                  </script>";
              
              break;
          }
        } 
      ?>
  </body>
</html>