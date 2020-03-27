<?php
    session_start();
    include_once ('../../backEnd/conexao.php');
    require_once ('../../backEnd/backPolicial.php');
    require_once ('layout.php');

    $dados = preAtualizar($_SESSION['cod']);
    foreach($dados as $r){
        $foto = $r['fotoPolicial'];
    }
?>

<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Gerênciar Perfil</title>
  </head>
  <body>
    <div class="center-form">
      <div class="form">
        <p>Perfil</p>
        <!-- FORM PERFIL POLICIAL -->
        <form action="../../backEnd/backPolicial.php?option=atualizar&cod=<?php echo $_SESSION['cod'];?>&tela=perfil" class="formulario" method="post">
          <div class="form-row">
            <div class="col">
              
              <div class="photo-form">
                <img src="../../img/<?php echo $foto; ?>" class="icon-btn-foto" id="img">
                <i class="far fa-edit btnActivate" onclick="desabilitar()"></i>
              </div>
              <h5 class="lbPhoto">Foto</h5>
            </div>
            
          </div>

          <div class="form-row">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id='txtFoto' name='txtFoto' disabled>
              <label class="custom-file-label" for="customFile">Atualizar Foto</label>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nomePolicial">Nome</label>
              <input type="text" class="form-control" type="text" id='nomePolicial' name='nomePolicial' disabled>
            </div>
            <div class="form-group col-md-6">
              <label for="identificaoPolicial">Identificação</label>
              <input type="text" class="form-control" type="text" name="identificaoPolicial" id="identificaoPolicial" disabled>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="rgPolicial">RG</label>
        
              <input type="text" name="rgPolicial" id="rgPolicial" class="form-control" disabled>


            </div>
            <div class="form-group col-md-6">
              <label for="emailPolicial">Email</label>
              <input type="email" class="form-control" type="text" name="emailPolicial" id="emailPolicial" disabled>
            </div>
          </div>


          <div class="form-row">
            
            <div class="form-group col-md-6">
              <label for="patentePolicial">Patente</label>
              <select name="patentePolicial" id="patentePolicial" class="custom-select" disabled>
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
              <label for="patentePolicial">Patente</label>
              <select name="tipoSangue" id="tipoSangue" class="custom-select" disabled>
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
          <button id="btnAtualizar" class="btn-form" type="submit" disabled><i class="fas fa-check"></i>Atualizar</button>
        </form>
        <!-- FIM FORM PERFIL POLICIAL -->
      </div>
    </div>
      
  </body>
<?php
    
  $dados = preAtualizar($_SESSION['cod']);

  foreach ($dados as $row) {
    echo 
      "<script>
        document.getElementById('nomePolicial').value = '".$row['nomePolicial']."'
        document.getElementById('identificaoPolicial').value = '".$row['identificaoPolicial']."'
        document.getElementById('rgPolicial').value = '".$row['rgPolicial']."'
        document.getElementById('emailPolicial').value = '".$row['emailPolicial']."'
        document.getElementById('patentePolicial').value = '".$row['codPatente']."'
        document.getElementById('tipoSangue').value = '".$row['tipoSanguineo']."'

      </script>";
  }

  if (isset($_GET['status'])) {
    $status = $_GET['status'];

    switch ($status) {
      case 'alterado':
        echo "<script>

              document.getElementById('titleModal').innerHTML = 'Atualizado'
              document.getElementById('text').innerHTML = 'Atualizado com Sucesso'
              $('#statusModal').modal('show')
            </script>";
        
        break;
    }
  }

?>
</html>