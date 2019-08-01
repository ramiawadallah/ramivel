<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Page;
use App\Gallary;
use App\University;
use App\Quicknews;
use App\Event;
use App\Category;
use App\Youtube;
use App\File;
use App\Lang;

class PagesController extends Controller
{

    public function show(Page $page, Lang $lang, array $parmaeters){
        $this->prepaerTemplate($page, $parmaeters);
        return view('page', compact('page','lang'));
    }

     public function prepaerTemplate(Page $page, array $parmaeters){
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

    public function getGallary($id){
        $gallaries  = Gallary::Where('category_id' , $id)->get();
        $categories = Category::Where('id' , $id)->get();
        return view('frontend.gallary',compact('gallaries',$gallaries,'categories',$categories));
    }

    public function getEvent($id){
        $events = Event::Where('id' , $id)->get();
        $files = File::Where('relation_id',$id)->get();
        return view('frontend.event',compact('events',$events,'files',$files));
    }

    public function getPost($uri){
        $posts = Post::Where('uri' , $uri)->get();
        return view('frontend.event',compact('events',$events));
    }

    public function getUniversity($uri){
        $universities = University::Where('uri' , $uri)->get();
        return view('frontend.university',compact('universities',$universities));
    }

    public function getQuickNews($uri){
        $quicknews = Quicknews::Where('uri' , $uri)->get();
        return view('frontend.quicknews',compact('quicknews',$quicknews));
    }

    public function getDetailsGallary($id){
        $gallaries  = Gallary::Where('id' , $id)->get();
        $files = File::Where('relation_id',$id)->get();
        return view('frontend.details-gallary',compact('gallaries',$gallaries,'files',$files));
    }

    public function getDetailsPlayList($id){
        $youtubes  = Youtube::Where('id' , $id)->get();
        return view('frontend.details-playlist',compact('youtubes',$youtubes));
    }

}
