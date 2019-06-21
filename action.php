<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO tbl_usuario (nome,login, senha) VALUES ('".$_POST["nome"]."', '".$_POST["login"]."', '".$_POST["senha"]."')
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Dados inseridos</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "SELECT * FROM tbl_usuario WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['nome'] = $row['nome'];
			$output['login'] = $row['login'];
			$output['senha'] = $row['senha'];
			$output['estado'] = $row['estado'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		($_POST["estado"] == NULL)? $estado ='ativo': $estado=$_POST["estado"];
		
		$query = "
		UPDATE tbl_usuario 
		SET nome = '".$_POST["nome"]."', 
		login = '".$_POST["login"]."',
		senha = '".$_POST["senha"]."',
		estado = '".$estado."'   
		WHERE id = '".$_POST["hidden_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Dados atualizados</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "UPDATE tbl_usuario SET estado = 'inativo' WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Usuário excluído</p>';
	}
}

?>