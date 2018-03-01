<?php

namespace Greygonz\Threads\Controllers;

use Greygonz\Threads\Models\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThreadsController extends Controller
{
  public function index() {
    $threads = Thread::all();
    return view('threads::index', compact($threads));
  }
}
