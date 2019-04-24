<?php

	class HomeController
	{
		public function index()
		{
			try {
				//echo 'teste';
				$colecPostagens = Postagem::selecionaTodos();

				var_dump($colecPostagens);
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}
	}
