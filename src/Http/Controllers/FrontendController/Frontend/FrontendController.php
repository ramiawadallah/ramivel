<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Category;
use App\Models\Project;
use App\Models\Post;
use App\Models\Partner;
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

    public function work($uri)
    {
        $project = Project::where('uri',$uri)->first();
        return view('frontend/project',compact('project',$project));
    }

    public function partner($uri)
    {
        $partner  = Partner::where('uri', $uri)->first();
        $projects = Project::where('id',$partner->id)->where('status','active')->get();
        return view('frontend/partner',compact('projects',$projects));
    }

    public function post($uri)
    {
        $post = Post::where('uri',$uri)->first();
        return view('frontend/post',compact('post',$post));
    }
}
