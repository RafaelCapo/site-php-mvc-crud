<?php

	class HomeController
	{
		public function index()
		{
			try {
				$colecPostagens = Postagem::selecionaTodos();


				$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template = $twig->load('home.html');

				$parametros = array();
				$parametros['postagens'] = $colecPostagens;
				//var_dump($colecPostagens);

				$conteudo = $template->render($parametros);
				echo $conteudo;

				
				
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}
	}
