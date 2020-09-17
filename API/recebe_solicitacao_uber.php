 <?php date_default_timezone_set('America/Sao_Paulo');

    //Conexão com o DataBase
    include '../../painel/engine/conecta.php';

    //Registrando solicitação e retornando o id da solicitacao
    $talking = 0;
    $uber = 1;
    $avatar = 'avatar-herois/avatar.jpg';
    $datarequisicao = date('Y-m-d H:i:s');

    try{
       $stmte2 = $conexao->prepare("INSERT INTO tab_usuario
                                   (nome, email, telefone, idade, sexo, tema, tipo, datacadastro, talking, uber, avatar)
                                   VALUES (?,?,?,?,?,?,?,?,?,?,?)");
       $stmte2->bindParam(1, $_POST['nome'], PDO::PARAM_STR);
       $stmte2->bindParam(2, $_POST['email'], PDO::PARAM_STR);
       $stmte2->bindParam(3, $_POST['telefone'], PDO::PARAM_STR);
       $stmte2->bindParam(4, $_POST['idade'], PDO::PARAM_STR);
       $stmte2->bindParam(5, $_POST['sexo'], PDO::PARAM_STR);
       $stmte2->bindParam(6, $_POST['assunto'], PDO::PARAM_STR);
       $stmte2->bindParam(7, $_POST['tipo'], PDO::PARAM_STR);
       $stmte2->bindParam(8, $datarequisicao , PDO::PARAM_STR);
       $stmte2->bindParam(9, $talking , PDO::PARAM_STR);
       $stmte2->bindParam(10, $uber, PDO::PARAM_STR);
       $stmte2->bindParam(11, $avatar, PDO::PARAM_STR);
       $executa2 = $stmte2->execute();
       $id_solicitacao = $conexao->lastInsertId();
     }
     catch(PDOException $e){
        echo $e->getMessage();
     }

     //retorno!
     echo $id_solicitacao;

?>
