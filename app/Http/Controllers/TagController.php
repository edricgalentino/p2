<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
	protected $tagService;

	public function __construct(TagService $tagService)
	{
		$this->tagService = $tagService;
	}

	public function createTag(Request $request, TagService $tagService)
	{
		$request->validate(['name' => 'required|string|max:255']);

		$tag = $tagService->createOrUpdateTags($request->name);

		return response()->json(['success' => true, 'tag_id' => $tag->id]);
	}


	public function deleteTag($id)
	{
		return $this->tagService->deleteTag($id);
	}
}
