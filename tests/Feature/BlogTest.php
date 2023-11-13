<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    public function test_blogs(): void
    {
        $response = $this->get('/');
        $response->assertSeeText('Posts');
        $response->assertStatus(200);
    }

    public function test_store_blog() : void
    {
        $data =['title'=>'New Title','content' => 'new content'];
        $this->actingAs($this->user())->post('/blogs', $data)->assertStatus(302)->assertSessionHas('message');
    }

    public function test_store_blog_fail() : void
    {
        $user = $this->user();
        $data =['title'=>'','content' => '','user_id',$user->id];
        $this->actingAs($user)->post('/blogs', $data)->assertStatus(302)->assertSessionHas('errors');
        $message  = session('errors')->getMessages();
        $this->assertEquals($message['title'][0], 'The title field is required.');
        $this->assertEquals($message['content'][0], 'The content field is required.');
    }

    public function test_update_blog(): void
    {
        $user = $this->user();
        $data = $this->createBlog($user->id);
        $this->assertDatabaseHas('blogs', $data->toArray());

        $newData = [
            'title'=>'updated title',
            'content'=>'updated content',
            'user_id'=>$user->id
        ];

        $this->actingAs($user)->put("/blogs/{$data->id}", $newData)->assertStatus(302)->assertSessionHas('message');
        $this->assertEquals(session('message'), 'updated title was updated');
    }

    public function test_delete_blog() :void
    {
        $user = $this->user();
        $data = $this->createBlog($user->id);
        $this->assertDatabaseHas('blogs', $data->toArray());
        $this->actingAs($user)->delete("/blogs/{$data->id}")->assertSessionHas('message');
        $this->assertSoftDeleted('blogs',$data->toArray());
    }

    public function createBlog(int $user_id) :Blog
    {
        return Blog::factory()->create([
            'user_id'=>$user_id
        ]);
    }
}
