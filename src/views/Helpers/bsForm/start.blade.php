<?php
$attributes = !empty($attributes) ? $attributes : [];
$icon = !empty($attributes['icon']) ? $attributes['icon'] : '';
$title = !empty($attributes['title']) ? trans('lang.'.$attributes['title']) : '';
$color = !empty($attributes['color']) ? $attributes['color'] : 'dark';

?>


<?php
 
 if(!empty($attributes['icon'])){ unset($attributes['icon']); }
 if(!empty($attributes['title'])){ unset($attributes['title']); }
 if(!empty($attributes['color'])){ unset($attributes['color']); }


?>               
{!! Form::open($attributes) !!}





        
 
       
