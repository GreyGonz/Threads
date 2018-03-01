<?php

namespace Greygonz\Threads\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
  protected $fillable = ['title', 'description', 'body', 'user_id'];
}
