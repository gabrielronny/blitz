<?php
    include_once ('../../backEnd/conexao.php');
    require_once ('../../backEnd/backPolicial.php');
    require_once ('layout.php');

    
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerênciar Policiais</title>
  <body>
       <div class="center-form">
        <div class="form">
          <p>Policial</p>
          <!-- FORM POLICIAL -->
          <form action="../../backEnd/backPolicial.php?option=cadastrar" method="post" enctype="multipart/form-data">
            <br>
            <div class="form-row">
              <div class="col">
                <label for="txtFoto">Adicione uma foto</label>
                <input type="file" class="form-control" type="text" id='txtFoto' name='txtFoto' >
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtNome">Nome</label>
                <input type="text" class="form-control" type="text" id='txtNome' name='txtNome' >
              </div>
              <div class="form-group col-md-6">
                <label for="txtIdentificacao">Identificação</label>
                <input type="text" class="form-control" type="text" name="txtIdentificacao" id="txtIdentificacao" >
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtRG">RG</label>
          
                <input type="text" name="txtRG" id="txtRG" minlength="8" maxlength="10" class="form-control" >


              </div>
              <div class="form-group col-md-6">
                <label for="txtEmail">Email</label>
                <input type="email" class="form-control" type="text" name="txtEmail" id="emailPolicial" >
              </div>
            </div>


            <div class="form-row">
              
              <div class="form-group col-md-6">
                <label for="txtPatente">Patente</label>
                <select name="txtPatente" id="txtPatente" class="custom-select" >
                  <?php
                    $conexao = $pdo->query("SELECT codPatente, descPatente FROM tbPatente");
                    $conexao->execute();

                    while($row = $conexao->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$row['codPatente']."'>".$row['descPatente']."</option>";
                    }

                    $conexao = null;
                  ?>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="txtTipoSangue">Tipo sanguíneo</label>
                <select name="txtTipoSangue" id="txtTipoSangue" class="custom-select" >
                  <option value="ab+" selected>AB+</option>
                  <option value="ab-">AB-</option>
                  <option value="a+">A+</option>
                  <option value="a-">A-</option>
                  <option value="b+">B+</option>
                  <option value="b-">B-</option>
                  <option value="o+">O+</option>
                  <option value="o-">O-</option>
                </select>
              </div>
            </div>
            <button class="btn-form" type="submit"><i class="fas fa-check"></i>Cadastrar</button>

          </form>
           <!-- FIM FORM POLICIAL -->
          <!-- <button class="listBtn" onclick="showLista()"><i class="fas fa-clipboard-list"></i> Listar</button> -->
          <div id="lista">
            <table id='table' class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <th>Nome</th>
                  <th>Identificação</th>
                  <th>Patente</th>
                  <th>E-mail</th>
                  <th class='icons'>Editar</th>
                  <th class='icons'>Excluir</th>
              </thead>
            

              <?php
                  $lista = listar();
                  echo "<tbody>";

                  foreach ($lista as $linha) {

                    if($linha['codPolicial'] != $_SESSION['cod']){
                      echo "
                        <tr>
                          <td>".$linha['nomePolicial']."</td>
                          <td>".$linha['identificaoPolicial']."</td>
                          <td>".$linha['patente']."</td>
                          <td>".$linha['emailPolicial']."</td>
                          <td class = 'icons'><a href = '?option=update&cod=".$linha['codPolicial']."' class = 'icons'><i class='fas fa-pencil-alt hover'></i></a></td>
                          <td class = 'icons'><a href = '../../backEnd/backPolicial.php?option=deletar&cod=".$linha['codPolicial']."' class = 'icons'><i class='fas fa-trash-alt'></i></a></td>
                        </tr>
                      ";
                    }
                  }
                  
                  echo "</tbody>";
              ?>
            </table>

          </div>
        </div>
      </div>
      <!--MODAL-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Atualizar Policial</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="../../backEnd/backPolicial.php?option=atualizar&cod=<?php echo $_GET['cod']?>&tela=cadastro" method="post" >
              <div class="modal-body">
                 <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nomePolicial">Nome</label>
                    <input type="text" class="form-control" type="text" id='nomePolicial' name='nomePolicial' >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="identificaoPolicial">Identificação</label>
                    <input type="text" class="form-control" type="text" name="identificaoPolicial" id="identificaoPolicial" >
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="rgPolicial">RG</label>
                    <input type="text" name="rgPolicial" id="rgPolicial" minlength="8" maxlength="10" class="form-control" >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="emailPolicial">Email</label>
                    
                    <input type="text" name="emailPolicial" id="emailPolicial" class="form-control">
                  </div>
                </div>
                <div class="form-row">
                
                  <div class="form-group col-md-6">
                    <label for="patentePolicial">Patente</label>
                    <select name="patentePolicial" id="patentePolicial" class="custom-select" >
                      <?php
                        $conexao = $pdo->query("SELECT codPatente, descPatente FROM tbPatente");
                        $conexao->execute();

                        while($row = $conexao->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='".$row['codPatente']."'>".$row['descPatente']."</option>";
                        }

                        $conexao = null;
                      ?>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="tipoSangue">Tipo sanguíneo</label>
                    <select name="tipoSangue" id="tipoSangue" class="custom-select" >
                      <option value="ab+" selected>AB+</option>
                      <option value="ab-">AB-</option>
                      <option value="a+">A+</option>
                      <option value="a-">A-</option>
                      <option value="b+">B+</option>
                      <option value="b-">B-</option>
                      <option value="o+">O+</option>
                      <option value="o-">O-</option>
                    </select>
                  </div>
                </div>



              </div>
              <div class="modal-footer">
                <button class="listBtn" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Fechar</button>
                <button class="btn-form" type="submit" ><i class="fas fa-check"></i>Fazer Alterações</button>
              </div>
            </form>
      
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
    <script src="../js/jsPolicial.js"></script> -->
    <?php
        
        if(isset($_GET['option']) == 'update'){
            $lista = preAtualizar($_GET['cod']);

          foreach($lista as $row){
              echo "<script>
                var nome = '".$row['nomePolicial']."'
                var identificao = '".$row['identificaoPolicial']."'
                var rg = '".$row['rgPolicial']."'
                var email = '".$row['emailPolicial']."'
                var patente = '".$row['codPatente']."'
                var tipoSangue = '".$row['tipoSanguineo']."'
                

                document.getElementById('nomePolicial').value = nome
                document.getElementById('identificaoPolicial').value = identificao
                document.getElementById('rgPolicial').value = rg
                document.getElementById('emailPolicial').value = email
                document.getElementById('patentePolicial').value = patente
                document.getElementById('tipoSangue').value = tipoSangue

                $('#exampleModal').modal('show');
              </script>";
            }
        } 
        
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
            
            case 'arqErrado':
              echo "<script>
    
                    document.getElementById('titleModal').innerHTML = 'Ops..'
                    document.getElementById('text').innerHTML = 'Arquivo de foto enviado não permitido, verifique se ele tem estas extensões: .jpg, .jpeg, .png'
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