<?php
    session_start();
    include("database_connection.php");
    
    $erro = '';
    # VALIDAÇÃO DE ACESSO (LOGIN)
    if(isset($_POST['entrar']))
    {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $query = "SELECT * FROM tbl_usuario WHERE login='$login' and senha='$senha' and estado='ativo'";
        $statement = $connect->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetch();

        if($result['login']!=$login and $result['senha']!=$senha)
        {
            $erro = "Usuário ou senha inválidos!";
        }
        elseif($result['login']==$login and $result['senha']==$senha)
        {
            $_SESSION['login']=$result['login'];
            $_SESSION['senha']=$result['senha'];
            header("location:home.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>

<body>
    <header>
        <div class="topnav">
            <a class="active" href="#login">Login</a>
        </div>
    </header>

    <form method="POST">

        <div class="imgcontainer">
            <img src="assets/imgs/img_avatar2.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="login">Login*:</label>
            <input type="text" id="login" name="login" min="5" max="10" required autofocus
            placeholder="Seu nome de usuário">

            <label for="senha">Senha*:</label>
            <input type="password" id="senha" name="senha" min="5" max="10" required placeholder="12345">
            <div class="erro">
                <?php
                    echo $erro;
                ?>
            </div>
            <button type="submit" id="entrar" name="entrar">Login</button>
        </div>

    </form>

    <footer>
        <div>
            <p>Desenvolvido por Carlos Eduardo Soares</p>
        </div>
    </footer>
</body>

</html>