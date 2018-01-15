<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['title', 'description', 'img_url', 'published_date'];

    protected $hidden = ['created_at', 'updated_at'];
}
