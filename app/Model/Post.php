<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $id;
    protected $title;
    protected $description;
    protected $content;
    protected $image;
    protected $published_at;
}
