<?php

namespace Tests\Feature;

use Greygonz\Threads\Models\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/** @test */
class ApiThreadsTest extends TestCase
{

    use RefreshDatabase;

    public function setUp() {
      parent::setUp();
//      $this->withoutExceptionHandling();
    }

    /**
     * A basic test example.
     * @test
     */
    public function can_list_threads()
    {
      $threads = factory(Thread::class, 10)->create();

      $response = $this->get('api/threads');

      $response->assertSuccessful();
      $response->assertJson($threads->toArray());
      foreach($threads as $thread) {
        $this->assertDatabaseHas('threads', [
          'id' => $thread->id,
          'title' => $thread->title,
          'description' => $thread->description,
          'body' => $thread->body,
          'user_id' => $thread->user_id,
        ]);
      }
    }

    /** @test */
    public function can_show_a_thread()
    {
      $thread = factory(Thread::class)->create();

      $response = $this->json('GET','api/threads/'.$thread->id);

      $response->assertSuccessful();
      $response->assertJsonFragment([
        'id' => $thread->id,
        'title' => $thread->title
      ]);
      $this->assertDatabaseHas('threads', [
        'id' => $thread->id,
        'title' => $thread->title,
        'description' => $thread->description,
        'body' => $thread->body,
        'user_id' => $thread->user_id
      ]);
    }

    /** @test */
    public function can_update_a_thread() {
      $thread = factory(Thread::class)->create();
      $newThread = factory(Thread::class)->make();

      $response = $this->json('PUT','api/threads/'.$thread->id, $newThread->toArray());

      $response->assertSuccessful();
      $response->assertJsonStructure([
          'id', 'title', 'description', 'body', 'user_id', 'created_at', 'updated_at'
      ]);
      $response->assertJsonFragment([
        'id' => $thread->id,
        'title' => $newThread->title,
        'description' => $newThread->description,
        'body' => $newThread->body,
        'user_id' => $newThread->user_id
      ]);
      $this->assertDatabaseHas('threads', [
        'id' => $thread->id,
        'title' => $newThread->title,
        'description' => $newThread->description,
        'body' => $newThread->body,
        'user_id' => $newThread->user_id
      ]);
    }

    /** @test */
    public function can_delete_a_thread() {
      $thread = factory(Thread::class)->create();

      $response = $this->json('DELETE', 'api/threads/'.$thread->id);

      $response->assertSuccessful();
      $response->assertJsonStructure([
        'id', 'title', 'description', 'body', 'user_id', 'created_at', 'updated_at'
      ]);
      $response->assertJsonFragment([
        'id' => $thread->id,
        'title' => $thread->title
      ]);
      $this->assertDatabaseMissing('threads', [
          'id' => $thread->id,
          'title' => $thread->title
      ]);
    }

    /** @test */
    public function can_store_threads() {
      $thread = factory(Thread::class)->make();

      $response = $this->json('POST', 'api/threads', $thread->toArray());

      $response->assertSuccessful();
      $response->assertJsonStructure([
        'id', 'title', 'description', 'body', 'user_id', 'created_at', 'updated_at'
      ]);
      $response->assertJsonFragment([
        'title' => $thread->title,
        'description' => $thread->description,
        'body' => $thread->body
      ]);
      $this->assertDatabaseHas('threads', [
        'title' => $thread->title,
        'description' => $thread->description,
        'body' => $thread->body,
        'user_id' => $thread->user_id
      ]);

    }
}
