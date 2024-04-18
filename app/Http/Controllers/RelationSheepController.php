<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;

class RelationSheepController extends Controller {

    public function posts() {
        return Post::with('topic', 'author')->get()
            ->map(function($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'topic' => $post->topic->name,
                'author' => $post->author->name,
            ];
        });
    }

    public function postsByTopic($slug) {
        $topic = Topic::where('slug', $slug)
            ->first();

        return $topic->posts->load('author')
            ->map(function($post) use ($topic) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'topic' => $topic->name,
                    'author' => $post->author->name,
                ];
            });
    }

}
