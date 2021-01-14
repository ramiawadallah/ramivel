<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Category;
use App\Models\File;
use App\Models\Lang;

class FrontendController extends Controller
{   

    public function show(Page $page, Lang $lang){
        $this->prepaerTemplate($page);
        return view('page', compact('page','lang'));
    }

    public function prepaerTemplate(Page $page){
        $templates = config('cms.templates');

        if (! $page->template || ! isset($templates[$page->template])) {
            return;
        }

        $template = app($templates[$page->template]);

        $view = sprintf('templates.%s', $template->getView());
        if (! view()->exists($view)) {
            return;
        }

        $template->prepare($view = view($view));

        $page->view = $view;
    }
}
