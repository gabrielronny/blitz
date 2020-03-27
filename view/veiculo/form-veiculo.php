<?php
    include_once ('../../backEnd/conexao.php');
    require_once ('../../backEnd/backVeiculo.php');
    include_once ('layout.php');
?>
<html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Gerênciar Veículos</title>
  </head>
  <body>

    <div class="center-form">
      <div class="form">
        <p>Veículo</p>
        <!-- FORM VEÍCULO -->
        <form action="../../backEnd/backVeiculo.php?option=cadastrar" method="post">


          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtModelo">Modelo</label>
              <input type="text" class="form-control" id="txtModelo" name="txtModelo" placeholder="Ex: Ford KA" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Placa</label>
              <input type="text" class="form-control" id="txtPlaca" minlength="7" maxlength="7" name="txtPlaca" placeholder="Ex: CXS9587" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtModelo">Chassi: </label>
              <input type="text" class="form-control" id="txtChassi"  minlength="17" maxlength="17" name="txtChassi" placeholder="9BG116GW04C400001" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Status</label>
              <select name="txtStatus" id="txtStatus" class="custom-select" required>
                <?php
                  $conexao = $pdo->query("SELECT codStatus, descStatus FROM tbstatusveiculo");
                  $conexao->execute();

                  while($row = $conexao->fetch(PDO::FETCH_ASSOC)){
                      echo "<option value='".$row['codStatus']."'>".$row['descStatus']."</option>";
                  }

                  $conexao = null;
                ?>
              </select>
            </div>
          </div>


          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputPassword4">Cidadão</label>
              <select name="txtCidadao" id="txtCidadao" class="custom-select" required>
                <?php
                  $conexao = $pdo->query("SELECT codCidadao, nomeCidadao FROM tbcidadao WHERE codStatusCidadao != 4");
                  $conexao->execute();

                  while($row = $conexao->fetch(PDO::FETCH_ASSOC)){
                      echo "<option value='".$row['codCidadao']."'>".$row['nomeCidadao']."</option>";
                  }

                  $conexao = null;
                ?>
              </select>
            </div>
            
          </div>
          <button class="btn-form" type="submit"><i class="fas fa-save"></i>Cadastrar</button>
          
        </form>
        <!-- FIM FORM VEÍCULO -->
        <div id="lista">
          <table id='table' class="table table-hover" style="width:100%">
              <thead>
                  <th>Modelo</th>
                  <th>Placa</th>
                  <th>Chassi</th>
                  <th>Status</th>
                  <th class='icons'>Excluir</th>
                  <!-- <th class='icons'>Editar</th> -->
              </thead>
                

              <?php
                $lista = listar();
                echo "<tbody>";
                foreach ($lista as $linha) {
                  echo "
                      <tr>
                          <td>".$linha['modeloVeiculo']."</td>
                          <td>".$linha['placaVeiculo']."</td>
                          <td>".$linha['chassiVeiculo']."</td>
                          <td>".$linha['descStatus']."</td>
                          <td class = 'icons'>

                            <a class='btnActionForm' href = '../../backEnd/backVeiculo.php?option=deletar&cod=".$linha['codVeiculo']." class = 'icons'><i class='fas fa-trash'></i></a>
                          </td>


                          <!--<td class = 'icons'>
                            <a class='btnActionForm' href = '?option=update&cod=".$linha['codVeiculo']."' class = 'icons'><i class='fas fa-pencil-alt'></i></a>
                            </td>-->
                      </tr>";
                  }
                echo "</tbody>";
              ?>
          </table>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function showLista()
      {
        const lista = document.getElementById('lista');
        lista.style.display = "block";
      }
    </script>

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