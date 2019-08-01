<?php

namespace Ramivel\Multiauth\Composers;

use App\Page;
use App\Setting;

use Illuminate\View\View; 

class InjectPages{

	protected $pages;
	protected $settings;

	public function __construct(Page $pages, Setting $settings){
		$this->pages = $pages;
		$this->settings = $settings;
	}

	public function compose(View $view){
		$pages = $this->pages->all()->toHierarchy();
		$settings = $this->settings->all();
		$view->with('pages', $pages)->with('settings', $settings);
	}
}

