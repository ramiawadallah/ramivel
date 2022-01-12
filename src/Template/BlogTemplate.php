<?php 

namespace App\Template;

use Illuminate\View\View;
use App\Models\Post;
use App\Models\Category;
use App\Models\Page;
use Carbon\Carbon;
use DB;


class BlogTemplate extends AbstractTemplate{

	protected $view = 'blog';

	protected $posts;
	protected $pages;

	public function __construct(Page $pages, Post $posts){
		$this->posts = $posts;
		$this->pages = $pages;
	}

	public function prepare(View $view){
		$posts = Post::where('status','active')->orderBy('id', 'desc')->paginate(1);
		$view->with(compact($posts, 'posts'));
	}

}