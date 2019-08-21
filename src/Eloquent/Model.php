<?php

namespace Ramivel\Multiauth\Eloquent;

use Exception;
use ArrayAccess;
use JsonSerializable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Contracts\Queue\QueueableCollection;
use Illuminate\Support\Collection as BaseCollection;
use Illuminate\Database\ConnectionResolverInterface as Resolver;

if (trait_exists('Ramivel\Multiauth\Relation\RelationMethods')) { 
    trait call_relation_helpers {
        use \Ramivel\Multiauth\Relation\RelationMethods; 
        } 
    }else{ 
        trait call_relation_helpers{} 
}

abstract class Model implements ArrayAccess, Arrayable, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{
    use call_relation_helpers,
}


