<?php 

namespace App\Template;

use Illuminate\View\View;
// use App\Post;
use App\Models\Page;
use Carbon\Carbon;
use DB;


class ContactusTemplate extends AbstractTemplate{

	protected $view = 'contactus';

	// protected $posts;
	protected $pages;

	public function __construct( Page $pages){
		// $this->posts = $posts;
		$this->pages = $pages;
	}

	public function prepare(View $view){
		// $posts = Post::where('save_post',1)->orderBy('id', 'desc')->limit(3)->get();
	}

}