<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{

	public function createOrUpdateTags($tagName)
	{
		return Tag::firstOrCreate(['name' => $tagName]);
	}


	public function deleteTag($id)
	{
		$tag = Tag::find($id);
		if (!$tag) {
			return response()->json([
				"success" => false,
				"message" => "Tag not found"
			]);
		}
		$tag->delete();

		return  response()->json(data: [
			"success" => true,
			"status" => 200,
			"message" => "Tag deleted"
		]);
	}
}