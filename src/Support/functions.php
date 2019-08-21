 <?php

 
function isAssoc($arr){
    return array_keys($arr) !== range(0, count($arr) - 1);
}


function site($row=null,$lang=null)
{
    try {
        if (is_null($row)) 
        {
            return @App\Setting::find(1);
                
        }else{
            $query = App\Setting::find(1);
            if (!is_null($query)) 
            {
                return $query->trans($row,$lang);
            }
        }
        } catch (\Exception $e) {
            
    }
    
}

function flug($lang = null)
{
    if (is_null($lang)) 
    {
    $lang = \App\Lang::where('code',app()->getLocale())->first();
    }else{
    $lang = \App\Lang::where('code',$lang)->first();
    }
    if (!file_exists(flugs_path.$lang->flug) || empty($lang->flug)) 
    {
        return flugs_url.'sa.png';
    }
    return flugs_url.$lang->flug;
}
function flugs()
{
   $flugs = glob(flugs_path.'*.png');
   $images = [];
    foreach ($flugs as $key => $flug) 
    {
        $flug_url = flugs_url.last(explode('/', $flug));
        $flug_file = last(explode('/', $flug));
         $images[$key]['url'] = $flug_url;
         $images[$key]['file'] = $flug_file;
    }
    return $images;
}

function langName($lang = null)
{
    if (is_null($lang)) 
    {
        return trans('lang_'.app()->getLocale());
    }else{
        return trans('lang_'.$lang);  
    }
}

function languages()
{
    $langsQuery = \App\Lang::all();
    $langs = [];
    foreach ($langsQuery as $value) 
    {
        
            $langs[$value->code]['name'] = $value->name;
            $langs[$value->code]['url'] = url('lang',$value->code);
            $langs[$value->code]['flug'] = flug($value->code);
            
    
    }

    return $langs;

}
function currentLang($value=null)
{
    $lang_query = \App\Lang::where('code',app()->getLocale());
    if ($lang_query->exists()) 
    {
        $lang = $lang_query->first();
    }else
    {
        $default_lang_query = \App\Lang::where('default',1);
        if ($default_lang_query->exists()) 
        {
            $lang = $default_lang_query->first();
        }else
        {
            $lang = \App\Lang::first();
        }
    }
    $langs = [];
    if (!array_key_exists($value,$langs)) 
        {
            $langs['name'] = $lang->name;
            $langs['url'] = url('lang',$lang->url);
            $langs['flug'] = flug($lang->code);
        }
        if (is_null($value)) 
        {
            return $langs;
        }else 
        {
            return $langs[$value];
        }
}
 
function updateLang($lang,$extends,$parent,$colum,$trans)
{
    
    $language = App\Language::where([
        'lang'=>$lang,
        'extends'=>$extends,
        'parent'=>$parent,
        'colum'=>$colum
        ]);
    if ($language->exists()) 
    {
        $update = $language->first();
        $update->trans = $trans;
        $update->save();
    }else{

        $add = new App\Language;
        $add->parent = $parent;
        $add->extends = $extends;
        $add->lang = $lang;
        $add->colum = $colum;
        $add->trans = $trans;
        $add->save(); 
    }
    
    
}
function deleteLang($extends,$parent)
{
    @ App\Language::where([
        'extends'=>$extends,
        'parent'=>$parent
        ])->delete();
}
function langFiles($lang)
{
   $lang_files = glob(base_path('resources/lang/'.$lang.'/*.php'));
   $files = [];
    foreach ($lang_files as $key => $file) 
    {
        $file_name = last(explode('/', $file));
        $file_path = base_path('resources/lang/'.$lang.'/'.$file_name);
         $files[$key]['path'] = $file_path;
         $files[$key]['name'] = $file_name;
    }
    return $files;
}
function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }

        $d->close();
    }else {
        copy( $source, $target );
    }
}


function hasRule($rule = 'admin')
{
    if (auth()->check()) 
    {
        if ($rule == 'admin') 
        {
            if (auth()->user()->rule == 'admin') 
            {
                return true;
            }else
            {
                return false;
            }
        }else
        {
            if (auth()->user()->rule == $rule || auth()->user()->rule == 'admin') 
            {
                return true;
            }else
            {
                return false;
            }

        }
    }
}

function user($row=null)
{
    if (is_null($row)) 
    {
        return auth();
    }
    if (auth()->check()) 
    {
        return !is_null($row) ? auth()->user()->{$row} : auth()->user();
    } else {
        return $row;
    }
}

 function getDir($style = false)
{
    $lang_query = \App\Lang::where('code',app()->getLocale());
    if ($lang_query->exists()) 
    {
        $dir = $lang_query->first()->direction;
    }else
    {
        $default_lang_query = \App\Lang::where('default',1);
        if ($default_lang_query->exists()) 
        {
            $dir = $default_lang_query->first()->direction;
        }else
        {
            $dir = 'rtl';
        }
    }
    if ($style == false) 
    {
        return $dir;
    }else{
        return $dir == 'ltr' ? '' : '-'.$dir;
    }
} 


function word_limit($string, $count, $ellipsis = null)
{
  $words = explode(' ', $string);
  if (count($words) > $count)
  {
    array_splice($words, $count);
    $string = implode(' ', $words);
    
      $string .= $ellipsis;
    
  }
  return $string;
}


function img($extends = null,$parent = null,$option = 'string')
  {
    $images = [];
    if (!is_null($extends) && !is_null($parent) ) 
    {
      if ($option == 'string') 
      {
        if (\App\Image::where(['parent'=>$parent,'extends'=>$extends])->count() > 0) 
        {
           $img = \App\Image::where(['parent'=>$parent,'extends'=>$extends])->first();
           if(file_exists(base_path($img->url)))
           {
              return url($img->url);
           }
        }
      }elseif($option == 'array')
      {
        if (\App\Image::where(['parent'=>$parent,'extends'=>$extends])->count() > 0) 
        {
           $img = \App\Image::where(['parent'=>$parent,'extends'=>$extends])->get();
           foreach ($img as $key => $value) 
           {
             if(file_exists(base_path($value->url)))
             {
                array_push($images, url($value->url));
             }
           }
        }
              return $images;
      }
    }
    return $extends=='user' ? IMG.'user.png' : ($extends == 'admin' ? IMG.'user.png' : IMG.'no-image.png') ;
  }
