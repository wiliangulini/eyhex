<?php

// 0) Conexão com o DataBase + Funções
      include '../../painel/engine/conecta.php';
      include '../../painel/engine/funcoes-sms.php';

// 1) usando o id da solicitação vou recuperar dados como: nome do heroi,tema, tipo
      $id_solicitacao = $_POST['id_solicitacao'];
      $consulta = $conexao->prepare("SELECT nome, tipo, tema FROM tab_usuario WHERE (id = :id) ORDER BY id DESC LIMIT 1");
      $consulta->bindParam(':id', $id_solicitacao, PDO::PARAM_INT);
      $consulta->execute();
      while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
          $nome = $linha['nome'];
          $tipo = $linha['tipo'];
          $tema = $linha['tema'];
      }

      if($tipo == 1) $tipo = 'chat por texto sobre '.$tema;
      if($tipo == 2) $tipo = 'chat por vídeo sobre '.$tema;


      //envia_notificacao_manager_uber($nome, $tipo, '554699177534');
      envia_notificacao_manager_uber($nome, $tipo, '554591197570');
      envia_notificacao_manager_uber($nome, $tipo, '554688011011');



 ?>
