<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Page;
use App\Post;
use App\Category;


class PagesController extends Controller
{

    public function show(Page $page, array $parmaeters){
        $this->prepaerTemplate($page, $parmaeters);
        return view('page', compact('page'));
    }

     public function prepaerTemplate(Page $page, array $parmaeters)
     {
        $templates = config('cms.templates');

        if (! $page->template || ! isset($templates[$page->template])) {
            return;
        }

        $template = app($templates[$page->template]);

        $view = sprintf('templates.%s', $template->getView());
        if (! view()->exists($view)) {
            return;
        }

        $template->prepare($view = view($view), $parmaeters);

        $page->view = $view;
    }

}
