<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS -->
        <link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<nav class="navigation">
			<div class="menu-top-vertical">
				<img class="logo" src=""/>
				<p class="horas" id="horas"></p>
			</div>
		  <ul class="mainmenu">
		    <li><a class="btn-menu" href="../dashboard/index.php" class="btn-menu"><i class="fab fa-houzz"></i>Início</a></li>
		    <li>
		    	<a class="btn-menu"><i class="fas fa-user-tie"></i>Cidadão <i class="fas fa-sort-down"></i></a>
		    	<ul class="submenu">
		      	<li><a href="../cidadao/form-cidadao.php">Cadastrar</a></li>
		        <li><a href="../cidadao/form-boletim.php">Boletim</a></li>
		        <li><a href="../cidadao/form-processo.php">Processo</a></li>
		      </ul>
		    </li>
		    <li><a class="btn-menu"><i class="far fa-user"></i> Policial <i class="fas fa-sort-down"></i></a>
		      <ul class="submenu">
		      	<li><a href="../policial/form-policial.php">Cadastrar</a></li>
		      </ul>
		    </li>
		    <li>
		    	<a class="btn-menu" href="../veiculo/form-veiculo.php" class="btn-menu"><i class="fas fa-car"></i>Veículo</a>
		    </li>
		    <li><a class="btn-menu" href="../../backEnd/backPolicial.php?option=deslogar" class="btn-menu"><i class="fas fa-sign-out-alt"></i>Sair</a></li>
		  </ul>
		</nav>
		
		<script>
            function relogio() {
                var data = new Date();
                var horas = data.getHours();
                var minutos = data.getMinutes();
				var segundos = data.getSeconds();
                
                if(horas< 10){
                	horas  = "0"+horas;
                }
                if(minutos < 10){
                    minutos = "0"+minutos;
                }
                document.getElementById("horas").innerHTML = horas+":"+minutos+":"+segundos;
            }
            window.setInterval("relogio()", 1000);
        </script>
	</body>
</html>