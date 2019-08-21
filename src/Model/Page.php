<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Node
{
    use SoftDeletes;

    protected $table = 'pages';
    protected $dates = ['deleted_at'];

    protected $fillable = ['parent_id','lft','rgt','depth','title' , 'name', 'uri', 'content', 'template', 'photo', 'created_by', 'updated_by'];

    public function updateOrder($order, $orderPage){
        $orderPage = $this->findOrFail($orderPage);
        if($order == 'before'){
            $this->moveToLeftOf($orderPage);
        }elseif($order == 'after'){
            $this->moveToRightOf($orderPage);
        }elseif ($order == 'childOf') {
            $this->makeChildOf($orderPage);
        }
    }

    public function getPrettyUriAttribute(){
        return '/'.ltrim($this->uri, '/');
    }

    public function getLinkToPaddedTitleAttribute($link){
        $padding = str_repeat('&nbsp;', $this->depth * 4);
        return $padding.link_to($link, $this->title);
    }

    public function getPaddedTitleAttribute(){
        return str_repeat('&nbsp;', $this->depth * 4).$this->title;
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = $value ?: null;
    }

    public function setPhotoAttribute($value){
        $this->attributes['photo'] = $value ?: null;
    }
    
    public function setTemplateAttribute($value){
        $this->attributes['template'] = $value ?: null;
    }
}
