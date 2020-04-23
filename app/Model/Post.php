<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;


    protected $id;
    protected $title;
    protected $description;
    protected $content;
    protected $image;
    protected $published_at;
    protected $fillable = ['title', 'description', 'content', 'image', 'published_at'];
}
