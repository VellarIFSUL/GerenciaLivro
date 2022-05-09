<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cadastrar Aluno</title>
		<link rel="stylesheet" href="../estilo.css">
	</head>
	<body>
		<header>
			<h1>Cadastro de Aluno</h1>
			<a href="../index.html">Home</a>
		</header>
		<div id="content">
			<form method="post" action="cadaluno.php">
				<label>
					Nome:
					<input type="text" name="nome" required>
				</label>
				<label>
					Email:
					<input type="email" name="email" required>
				</label>
				<label>
					CPF:
					<input type="number" name="cpf" required>
				</label>
				<label>
					Data de Nascimento:
					<input type="date" name="data_nasc" required>
				</label>
				<button type="submit" name="Post" value="1">Registrar</button>
			</form>
		</div>
	</body>
</html>
<?php
    include_once("../conectar.php");
    if(isset($_POST['Post'])){
        $nome=$_POST['nome'];
        $email=$_POST['email'];
        $cpf=$_POST['cpf'];
        $nasc=$_POST['data_nasc'];
        $sql = "INSERT INTO aluno (nome, email, cpf, data_nasc) VALUES ('$nome','$email','$cpf','$nasc')";
        mysqli_query($conexao,$sql);
        mysqli_close($conexao);
        header('Location: ../listas/listaluno.php');
    }
?>