<?php

//fetch.php

include("database_connection.php");

$nome = $_POST['nomebuscar'];
$estado = $_POST['estadobuscar'];

if($estado=='todos') {
	$query = "SELECT * FROM tbl_usuario";
} else {
	$query = "SELECT * FROM tbl_usuario WHERE nome LIKE '%$nome%' AND estado = '$estado'";
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
<table class="table table-striped table-bordered">
	<tr>
		<th>Nome</th>
		<th>Login</th>
		<th>Senha</th>
		<th>Status</th>
		<th>Editar</th>
		<th>Deletar</th>
	</tr>
';
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td width="40%">'.$row["nome"].'</td>
			<td width="40%">'.$row["login"].'</td>
			<td width="40%">'.$row["senha"].'</td>
			<td width="40%">'.$row["estado"].'</td>
			<td width="10%">
				<button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$row["id"].'">Editar</button>
			</td>
			<td width="10%">
				<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Deletar</button>
			</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">Dados não encontrados</td>
	</tr>
	';
}
$output .= '</table>';
echo $output;
?>