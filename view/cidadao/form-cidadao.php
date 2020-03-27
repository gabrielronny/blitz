<?php
    include_once ('../../backEnd/conexao.php');
    require_once ('../../backEnd/backCidadao.php');
    require_once ('layout.php');
    if(!isset($_SESSION['logado'])){
        header("Location: ../../index.php");
    }
    
?>
<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Cidadão Page</title>
  </head>
  <body>
    <div class="center-form">
        <div class="form">
          <p>Cidadadão</p>
          <!-- FORM CIDADAO -->
          <form action="../../backEnd/backCidadao.php?option=cadastrar" method="post" class="formulario" enctype="multipart/form-data">
            
            <br>
            <div class="form-row">
              <div class="col">
                <label for="txtFoto">Adicione uma foto</label>
                <input type="file" class="form-control" type="text" id='txtFoto' name='txtFoto' >
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txNome">Nome</label>
                <input type="text" class="form-control" type="text" id='txNome' name='txNome' placeholder='Ex: Pedro Ricardo' required>
              </div>
              <div class="form-group col-md-6">
                <label for="txCpf">CPF</label>
                <input type="text" class="form-control" type="text"  maxlength="15" name="txCpf" id="txCpf" placeholder='Ex: 999.999.999-99' required>
              </div>
            </div>

            <br>
            <p>Endereço</p>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txCep">CEP</label>
                <input type="text" class="form-control" type="text"  maxlength="11" name="txCep" id="txCep" placeholder='Ex: 9999-999' required>
              </div>
              <div class="form-group col-md-6">
                <label for="txLogradouro">Logradouro</label>
                <input type="text" class="form-control" type="text" name="txLogradouro" id="txLogradouro" maxlength="100" placeholder='Ex: R. Gianette' required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txComplemento">Complemento</label>
                <input type="text" class="form-control" type="text" maxlength="100" name="txComplemento" id="txComplemento">
              </div>
              <div class="form-group col-md-6">
                <label for="txNumero">Numero</label>
                <input type="text" class="form-control" type="text"name="txNumero" id="txNumero" placeholder="EX: 150 F" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txBairro">Bairro</label>
                <input type="text" class="form-control" type="text" maxlength="100" name="txBairro" id="txBairro" placeholder="Ex: JD. Oliveira" requred>
              </div>
              <div class="form-group col-md-6">
                <label for="txCidade">Cidade</label>
                <input type="text" class="form-control" type="text" name="txCidade" id="txCidade" placeholder="Ex: São Paulo" required>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <label for="txtFoto">Status</label>
                  <select name="txtStatus" id="txtStatus" class="custom-select" required>
                  <?php
                    $sql = $pdo->query("SELECT codStatusCidadao, descrStatus FROM tbStatusCidadao WHERE codStatusCidadao != 4");
                    $sql->execute();
                    while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                      echo "<option value='".$row['codStatusCidadao']."'>".$row['descrStatus']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>

            <br>
            <p>RG</p>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txNome">Orgão Emissor</label>
                <input type="text" class="form-control" type="text" maxlength="100" name="txOrgao" id="txOrgao" placeholder='Ex: Secretaria..' requred>
              </div>
              <div class="form-group col-md-6">
                <label for="txDataEmissao">Data de emissão</label>
                <input type="date" class="form-control" type="date" name="txDataEmissao" id="txDataEmissao" required>
              </div>
            </div>


            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txDataNasc">Data de nascimento</label>
                <input type="date" class="form-control" type="date" name="txDataNasc" id="txDataNasc" required>
              </div>
              <div class="form-group col-md-6">
                <label for="txtFoto">Numero do rg</label>
                <input type="text" class="form-control" minlength="8" maxlength="9" name="txNumRG" id="txNumRG" type="text" placeholder='Ex: 99.999.999-X' required>
              </div>
            </div>
            <br>
            <button class="btn-form" type="submit"><i class="fas fa-check"></i>Cadastrar</button>
          </form>
          <!-- FIM FORM CIDADAO -->
          <!-- <button class="listBtn" onclick="showLista()"><i class="fas fa-clipboard-list"></i> Listar</button> -->
          <div id="lista">
            <table id='table' class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <th>Nome</th>
                  <th>RG</th>
                  <th>CPF</th>
                  <th class='icons'>Editar</th>
                  <th class='icons'>Excluir</th>
              </thead>
        
              <?php
                  $lista = listar();
                  echo "<tbody>";
                  foreach ($lista as $linha) {
                      echo "
                          <tr>
                              <td>".$linha['nomeCidadao']."</td>
                              <td>".$linha['numeroRg']."</td>
                              <td>".$linha['cpfCidadao']."</td> 
                              <td class = 'icons'>
                                <a href = '?option=update&cod=".$linha['codCidadao']."' class = 'icons'><i class='fas fa-pencil-alt'></i></a>
                              </td>
                              <td class = 'icons'><a href = '../../backEnd/backCidadao.php?option=deletar&cod=".$linha['codCidadao']."' class = 'icons'><i class='fas fa-trash-alt'></i></a></td>
                          </tr>";
                  }
                  echo "</tbody>";
              ?>
            </table>
          </div>
        </div>
        
      </div>

      <!--MODAL-->
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atualizar Cidadão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <div class="espaco">

                <form action="../../backEnd/backCidadao.php?option=atualizar&cod=<?php echo $_GET['cod']?>" method="post" class="formulario">

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="txNome">Nome</label>
                        <input type="text" class="form-control" type="text" id='nomeCidadao' name='nomeCidadao'>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="txCpf">CPF</label>
                        <input type="text" class="form-control" type="text"  maxlength="15" name="cpfCidadao" id="cpfCidadao">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="txCep">CEP</label>
                        <input type="text" class="form-control" type="text"  maxlength="11" name="cepCidadao" id="cepCidadao">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="txLogradouro">Logradouro</label>
                        <input type="text" class="form-control" type="text" name="logCidadao" id="logCidadao" maxlength="100"  >
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="txComplemento">Complemento</label>
                        <input type="text" class="form-control" type="text" maxlength="100" name="compleCidadao" id="compleCidadao">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="txNumero">Numero</label>
                        <input type="text" class="form-control" type="text"name="numCidadao" id="numCidadao">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="txBairro">Bairro</label>
                        <input type="text" class="form-control" type="text" maxlength="100" name="bairroCidadao" id="bairroCidadao" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="txCidade">Cidade</label>
                        <input type="text" class="form-control" type="text" name="cidadeCidadao" id="cidadeCidadao">
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
      </div>
      <script type="text/javascript">
        function showLista()
        {
          const lista = document.getElementById('lista');
          lista.style.display = "block";
        }
    </script>

    <?php
        
      if(isset($_GET['option']) == 'update'){
        $lista = preAtualizar($_GET['cod']);
        foreach($lista as $row){
            echo "
              <script>
                  var nome = '".$row['nomeCidadao']."'
                  var cpf = '".$row['cpfCidadao']."'
                  
                  var logradouro = '".$row['logradouro']."'
                  var complemento = '".$row['complemento']."'
                  var numero = '".$row['numero']."'
                  var bairro = '".$row['bairro']."'
                  var cep = '".$row['cep']."'
                  var cidade = '".$row['cidade']."'

                  document.getElementById('nomeCidadao').value = nome
                  
                  document.getElementById('cpfCidadao').value = cpf
                  document.getElementById('cepCidadao').value = cep

                  document.getElementById('logCidadao').value = logradouro
                  document.getElementById('compleCidadao').value = complemento
                  document.getElementById('numCidadao').value = numero
                  document.getElementById('bairroCidadao').value = bairro
                  document.getElementById('cidadeCidadao').value = cidade

                  

                  $('#modalEdit').modal('show');
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