<?php

	class Comentario 
	{
		public static function selecionarComentarios($idPost)
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM comentario WHERE id_postagem = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
			$sql->execute();

			$resultado = array();

			while ($row = $sql->fetchObject('Comentario')) {
				$resultado[] = $row;
			}

			return $resultado;
		}

		public static function inserir($reqPost)
		{
			$con = Connection::getConn();

			$sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nom, :msg, :idp)";
			$sql = $con->prepare($sql);
			$sql->bindValue(':nom', $reqPost['nome']);
			$sql->bindValue(':msg', $reqPost['msg']);
			$sql->bindValue(':idp', $reqPost['id']);
			$sql->execute();

			if ($sql->rowCount()) {
				return true;
			}

			throw new Exception("Falha na inserção");
		}
	}
