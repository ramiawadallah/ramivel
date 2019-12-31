<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Category extends Node 
{
    public function getDefaultLeftColumnName()
    {
        return 'lft';
    }

    public function getDefaultRightColumnName()
    {
        return 'rgt';
    }


    protected $table = 'categories';
    protected $dates = ['deleted_at'];

    protected $fillable = ['parent_id','lft','rgt','depth','title' , 'uri', 'photo', 'created_by', 'updated_by'];

    public function updateOrder($order, $orderCategory){
        $orderCategory = $this->findOrFail($orderCategory);
        if($order == 'before'){
            $this->moveToLeftOf($orderCategory);
        }elseif($order == 'after'){
            $this->moveToRightOf($orderCategory);
        }elseif ($order == 'childOf') {
            $this->makeChildOf($orderCategory);
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


    public function setPhotoAttribute($value){
        $this->attributes['photo'] = $value ?: null;
    }

}
