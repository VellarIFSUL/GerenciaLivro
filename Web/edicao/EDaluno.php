<?php
    include_once("../conectar.php");
    //Checagem de como se chegou a pagina
    if (isset($_POST['Edit'])) {
        //caso botão edit
        $title='Editar';
    }elseif(isset($_POST['Delete'])){
        //caso botao deletar
        $title='Deletar';
    }elseif(isset($_POST['Edited'])){
        //caso formulario proprio de edição
        $matriculaUP=$_POST['Edited'];
        $nomeUP=$_POST['nome'];
        $emailUP=$_POST['email'];
        $cpfUP=$_POST['cpf'];
        $nascUP=$_POST['nasc'];
        $sql="UPDATE aluno SET nome = '$nomeUP', email = '$emailUP', cpf = '$cpfUP', data_nasc = '$nascUP'  WHERE matricula = '$matriculaUP' ";
        mysqli_query($conexao,$sql);
    }elseif(isset($_POST['Deleted'])){
        //caso botão de deleção
        $matriculaDEL=$_POST['Deleted'];
        $sql="DELETE FROM aluno WHERE matricula = '$matriculaDEL'";
        mysqli_query($conexao,$sql);
    }else{
        //outros
        $title='Erro';
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../estilo.css">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <?php
            echo "<header><h1>$title</h1><a href='../index.html'>Home</a></header><div id='content'>";
            //formularios apartir das listas
            if (isset($_POST['Edit'])) {
                //caso botão editar
                $editid=$_POST['Edit'];
                $sql = "SELECT * FROM aluno WHERE matricula = $editid";
                $resultado=mysqli_fetch_array(mysqli_query($conexao,$sql));

                $nome=$resultado['nome'];
                $email=$resultado['email'];
                $cpf=$resultado['cpf'];
                $datanasc=$resultado['data_nasc'];
                echo "<form action'EDaluno.php' method='post'>";
                echo "<label>Nome:<input type='text' name='nome' placeholder='$nome' required></label>";
                echo "<label>Email:<input type='email' name='email' placeholder='$email' required></label>";
                echo "<label>CPF:<input type='number' name='cpf' placeholder='$cpf' required></label>";
                echo "<label>Nascimento: <input type='date' name='nasc' required>$datanasc</label>";
                echo "<button type='submit' name='Edited' value='$editid'>Mudar</button>";
                echo "</form></div>";
            }elseif(isset($_POST['Delete'])){
                //caso botão de deletar
                $deleteid=$_POST['Delete'];
                $sql = "SELECT * FROM aluno WHERE matricula = $deleteid";
                $resultado=mysqli_fetch_array(mysqli_query($conexao,$sql));

                $nome=$resultado['nome'];
                echo "<h2>Quer mesmo exluir o aluno: $nome?</h2>";
                echo "<form action='EDaluno.php' method='post'>";
                echo "<button type='submit' name='Deleted' value='$deleteid'>Sim</button>";
                echo "<button onClick='history.go(-1)'>Não</button></form></div>";
            }else{
                //outro, manda de volta pra lista
                header('Location: ../listas/listaluno.php');
            }
        ?>
    </body>
</html>
<?php
    mysqli_close($conexao);
?>