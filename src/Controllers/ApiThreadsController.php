<?php

namespace Greygonz\Threads\Controllers;

use App\Http\Controllers\Controller;
use Greygonz\Threads\Models\Thread;
use Illuminate\Http\Request;

class ApiThreadsController extends Controller
{

  public function index()
  {
    $threads = Thread::all();
    return $threads;
  }

  public function show(Request $request, Thread $thread)
  {
    return $thread;
  }

  public function store(Request $request) {
    $thread = Thread::create([
      'title' => $request->title,
      'description' => $request->description,
      'body' => $request->body,
      'user_id' => $request->user_id
    ]);

    return $thread;
  }

  public function update(Request $request, Thread $thread) {

    $thread->title = $request->title;
    $thread->description = $request->description;
    $thread->body = $request->body;
    $thread->user_id = $request->user_id;
    $thread->save();

    return $thread->toArray();
  }

  public function destroy(Request $request, Thread $thread) {
    $thread->delete();
    return $thread;
  }
}
