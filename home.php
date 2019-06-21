<?php
	session_start();

	if((!isset ($_SESSION['login'])) and (!isset ($_SESSION['senha'])))
    {
      session_destroy();
      header('location:index.php');
    }
    
    $logado = $_SESSION['login'];
?>

<html>  
    <head>  
        <title>Listagem de Usuários</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">  
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
    </head>  
    <body>  
        <div class="container">
			<br />
			<a href="logout.php" class="btn btn-danger">Sair</a>
			<h3 align="center">Listagem de Usuários</a></h3><br />
			<br />

			<div class="form-group">
			  <label for="nomebuscar">Nome:</label>
			  <input type="text" class="form-control" name="nomebuscar" id="nomebuscar" placeholder="Digite seu nome">
			</div>
			<div class="form-group">
			<label for="estadobuscar">Status:</label>
            <select class="form-control" id="estadobuscar" name="estadobuscar">
				<option value="todos">Todos</option>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
             </select>
            </div>
			<div style="margin-bottom:20px;">
				<button type="button" name="buscar" id="buscar" class="btn btn-info">buscar</button>
				<button type="button" name="add" id="add" class="btn btn-success">Novo</button>
				<button type="button" name="limpar" id="limpar" class="btn btn-warning" onclick="limpa()">Limpar</button>
			</div>
			<div class="table-responsive" id="user_data">
				
			</div>
			<br />
		</div>
		
		<div id="user_dialog" title="Preencha os dados">
			<form method="post" id="user_form">
				<div class="form-group">
					<label>Nome</label>
					<input type="text" name="nome" id="nome" class="form-control" />
					<span id="error_first_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Login</label>
					<input type="text" name=login id="login" class="form-control" />
					<span id="error_last_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Senha</label>
					<input type="password" name="senha" id="senha" class="form-control" />
					<span id="error_last_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Confirmar Senha</label>
					<input type="password" name="conf_senha" id="conf_senha" class="form-control" />
					<span id="error_last_name" class="text-danger"></span>
				</div>
				<div class="form-group">
				<label for="estado">Status:</label>
					<select class="form-control" id="estado" name="estado">
						<option value="ativo" selected>Ativo</option>
						<option value="inativo">Inativo</option>
					</select>
				</div>
				<div class="form-group">
					<input type="hidden" name="action" id="action" value="insert" />
					<button type="button" name="limparform" id="limparform" class="btn btn-warning" onclick="limpaModal()">Limpar</button>
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
				</div>
			</form>
		</div>
		
		<div id="action_alert" title="Action">
			
		</div>
		
		<div id="delete_confirmation" title="Confirmação">
		<p>Gostaria de apagar?</p>
		</div>

		<script type="text/javascript">
			// Limpar campos preenchidos
			function limpa() {
				document.getElementById('nomebuscar').value="";
				document.getElementById('estadobuscar').value="";
			}
			function limpaModal() {
				document.getElementById('nome').value="";
				document.getElementById('login').value="";
				document.getElementById('senha').value="";
				document.getElementById('conf_senha').value="";
				document.getElementById('estado').value="";
			}
		</script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.min.js"></script>  
		<script src="assets/js/jquery-ui.js"></script>
		<script src="assets/js/main.js"></script>
    </body>  
</html>