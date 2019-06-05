<?php

	class Postagem
	{

		public static function selecionaTodos()
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM postagem ORDER BY id DESC";
			$sql = $con->prepare($sql);
			$sql->execute();

			$resultado = array();

			while ($row = $sql->fetchObject('Postagem')) {
				$resultado[] = $row;
			}

			if (!$resultado) {
				throw new Exception("Não foi encontrado nenhum registro no banco");		
			}

			return $resultado;
		}

		public static function selecionaPorId($idPost)
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM postagem WHERE id = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
			$sql->execute();

			$resultado = $sql->fetchObject('Postagem');

			if (!$resultado) {
				throw new Exception("Não foi encontrado nenhum registro no banco");	
			} else {
				$resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
			}

			return $resultado;
		}

		public static function insert($dadosPost)
		{
			if (empty($dadosPost['titulo']) OR empty($dadosPost['conteudo'])) {
				throw new Exception("Preencha todos os campos");

				return false;
			}

			$con = Connection::getConn();

			$sql = $con->prepare('INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)');
			$sql->bindValue(':tit', $dadosPost['titulo']);
			$sql->bindValue(':cont', $dadosPost['conteudo']);
			$res = $sql->execute();

			if ($res == 0) {
				throw new Exception("Falha ao inserir publicação");

				return false;
			}

			return true;
		}

	}
