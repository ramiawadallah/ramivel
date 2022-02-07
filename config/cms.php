<?php 

return [

	'theme' => [
		'folder' => 'theme',
		'active' => 'default'
	],

	'templates' => [
		'home'		=> App\Template\HomeTemplate::class,
		'about us'	=> App\Template\AboutusTemplate::class,
		'contact us'	=> App\Template\ContactusTemplate::class,
	],

	'design' => [

		'default'	=> 'default',
		'modern' 	=> 'modern',
		'amethyst' 	=> 'amethyst',
		'city' 		=> 'city',
		'flat' 		=> 'flat',
		'modern' 	=> 'modern',
		'smooth' 	=> 'smooth',
	],

	'sidebar' => [

	],

];