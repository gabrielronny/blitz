<?php
    session_start();
    include_once ('layout.php');
    require_once ('../../backEnd/backDoc.php');
    if(!isset($_SESSION['logado'])){
        header("Location: ../../index.php");
    }
?>
<html >
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boletim Page</title>
  </head>
  <body>

      <div class="center-form">
        <div class="form">
          <p>Boletim</p>
          <a href="../../relatoriosPDF/relatorioBoletim.php"><button type="button" class="btn-form"><i class="fas fa-file-pdf icon"></i>Relatório</button></a>
          <br><br><br><br>
          <!-- FORM BOLETIM -->
          <form action="../../backEnd/backDoc.php?option=cadastroBoletim" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="cpfCidadao">RG do cidadão</label>
                <input type="text" minlength="8" maxlength="9" class="form-control" id='rgCidadao' name='rgCidadao'>
              </div>
              <div class="form-group col-md-6">
                <label for="txNumero">Data do ocorrido</label>
                <input type="date" class="form-control"  name="data" id="dataBoletim" required>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="descrBoletim">Descricão do ocorrido</label>
                <textarea class="form-control" id='descrBoletim' name='descrBoletim' required></textarea>
              </div>
            </div>
            <br>
            <button class="btn-form" type="submit"><i class="fas fa-check"></i>Cadastrar</button>
          </form>
         
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
          
          case 'rgErrado':
            echo "<script>
  
                  document.getElementById('titleModal').innerHTML = 'Ops..'
                  document.getElementById('text').innerHTML = 'Verifique o RG'
                  $('#statusModal').modal('show')
                </script>";
            
            break;
  
          case 'alterado':
            echo "<script>
  
                  document.getElementById('titleModal').innerHTML = 'Atualizado'
                  document.getElementById('text').innerHTML = 'Atualizado com Sucesso'
                  $('#statusModal').modal('show')
                </script>";
            
            break;

          case 'deletado':
            echo "<script>
  
                  document.getElementById('titleModal').innerHTML = 'Deletado'
                  document.getElementById('text').innerHTML = 'Deletado com Sucesso'
                  $('#statusModal').modal('show')
                </script>";
            
            break;
        }
      }

      ?>
  </body>
</html>