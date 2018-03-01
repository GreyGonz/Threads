<?php

namespace Tests\Feature;

use Greygonz\Threads\Models\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/** @test */
class ThreadsControllerTest extends TestCase
{

    public function setUp() {
      parent::setUp();
      $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function can_see_threads()
    {
      $threads = factory(Thread::class)->create();

      $response = $this->get('/threads');

      $response->assertSuccessful();
      $response->assertViewIs('threads::index');
      $response->assertSeeText('Threads');
      foreach($threads as $thread) {
        $response->assertSee($thread);
        $this->assertDatabaseHas('threads', [
          'id' => $thread->id,
          'title' => $thread->title,
          'description' => $thread->description,
          'body' => $thread->body,
          'user_id' => $thread->user_id
        ]);
      }
    }
}
