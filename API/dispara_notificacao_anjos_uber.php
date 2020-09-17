<?php
$j = 0;
// 0) Conexão com o DataBase + Funções
      include '../../painel/engine/conecta.php';
      include '../../painel/engine/funcoes-sms.php';

// 1) usando o id da solicitação vou recuperar dados como: nome do heroi,tema, tipo
      $id_solicitacao = $_POST['id_solicitacao'];
      $consulta = $conexao->prepare("SELECT nome, tema, tipo FROM tab_usuario WHERE (id = :id) ORDER BY id DESC LIMIT 1");
      $consulta->bindParam(':id', $id_solicitacao, PDO::PARAM_INT);
      $consulta->execute();
      while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
          $nome = $linha['nome'];
          $tema = $linha['tema'];
          $tipo = $linha['tipo'];
      }

// 2) vou selecionar os anjos que estão online && falam sobre o assunto && sao do uber && aceitam o tipo de atendimento e enviar notificacoes para eles.
      //AND (CONCAT_WS(desafio1, desafio2, desafio3) LIKE '%$tema%')
      $consulta = $conexao->prepare("SELECT * FROM anjos
                                     WHERE (uber = 1) AND (tipo >= $tipo) AND (premium = 1)");
      $consulta->execute();
      while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
         $j++;
         $telefone = $linha['telefone'];
         envia_notificacao_uber($nome, $telefone);
      }


      echo "Notificação enviada para ".$j." anjos";


 ?>
