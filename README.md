# crud-php-puro

Crud utilizando PHP puro, CSS, Javascript, AJAX e MySQL Server para gerenciamento do banco de dados.

Para executar abra o terminal na pasta do projeto e execute o comando php -S 0.0.0.0:8000 -t. Mas pode ser pelo apache ou outro webserver que você preferir.

Dentro do projeto existe uma pasta chamada util que possui o arquivo system_dump.sql, esse arquivo cria a tabela e insere alguns registros. O nome do banco é system, crie ele com o comando CREATE DATABASE system; antes de importar o system_dump.sql.

altere o arquivo database_connection.php na linha:
$connect = new PDO("mysql:host=localhost;dbname=system", "seuusuario", "senha");

onde está "seuusuario" coloque o nome do seu usúario do mysql e em "senha" troque para a sua senha. 
Ex:  $connect = new PDO("mysql:host=localhost;dbname=system", "root", "123456");

Feito isso só abrir o browser e executar o projeto de acordo com o diretório que você extraiu o arquivo. O login pra entrar no sistema é root e a senha é root também.

Contribuições são bem-vindas!!
