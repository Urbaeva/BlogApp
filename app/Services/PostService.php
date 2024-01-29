<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            $tags = $this->tagsHandle($data['tag_ids']);

            unset($data['tag_ids']);
            $post = Post::create($data);
            $post->tags()->attach($tags);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
    }

    public function update($data, $post)
    {
        try {
            DB::beginTransaction();
            $tags = $this->tagsHandle($data['tag_ids']);
            unset($data['tag_ids']);
            if (isset($data['image'])) {
                $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            }
            $post->update($data);
            $post->tags()->sync($tags);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function isNumericString($str) {
        return ctype_digit($str);
    }

    public function tagsHandle($tags)
    {
        for($i = 0; $i < count($tags); $i++)
        {
            if(!$this->isNumericString($tags[$i]))
            {
                $new_tag = Tag::firstOrCreate(['title' => $tags[$i]]);
                $tags[$i] = $new_tag->id;
            }
        }
        return $tags;
    }
}
