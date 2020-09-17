<?php

$id = $_POST['id_solicitacao'];
include "../../painel/engine/conecta.php";


  //pegando infos da solicitação

try{
    $consulta = $conexao->prepare('SELECT * FROM tab_usuario WHERE id = :id LIMIT 1');
    $consulta->bindParam(':id', $id, PDO::PARAM_INT);
    $consulta->execute();

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
      $idUBER = $linha['id'];
      $talking = $linha['talking'];
      $idconversa = $linha['idconversa'];
      $tabela = $linha['tabela'];
    }

 }catch(PDOException $e){
    echo $e->getMessage();
 }

   //pegando infos do anjo

 try{
     $consulta = $conexao->prepare('SELECT nome, avatar, biografia FROM anjos WHERE id = :id LIMIT 1');
     $consulta->bindParam(':id', $talking, PDO::PARAM_INT);
     $consulta->execute();

     while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
       $nomeanjo = $linha['nome'];
       $avataranjo = $linha['avatar'];
       $biografiaanjo = $linha['biografia'];
     }

  }catch(PDOException $e){
     echo $e->getMessage();
  }

  //pegando infos da conversa

  try{
      $consulta = $conexao->prepare('SELECT session FROM conversas WHERE id = :id LIMIT 1');
      $consulta->bindParam(':id', $idconversa, PDO::PARAM_INT);
      $consulta->execute();

      while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $sessao = $linha['session'];
      }

   }catch(PDOException $e){
      echo $e->getMessage();
   }


 $array = array('iduber' => $idUBER, 'talking' => $talking, 'sessao' => $sessao, 'tabela' => $tabela, 'nomeanjo' => $nomeanjo,
                'avataranjo' => $avataranjo, 'biografiaanjo' => $biografiaanjo, );
 $vetor[] = array_map('htmlentities', $array);
 echo json_encode($vetor, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

 ?>
