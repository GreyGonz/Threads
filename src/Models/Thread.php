<?php

namespace Greygonz\Threads\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
  protected $fillable = ['title', 'description', 'body', 'user_id'];

  public function user() {
    return $this->belongsTo(User::class);
  }
}
