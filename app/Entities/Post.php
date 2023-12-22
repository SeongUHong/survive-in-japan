<?php
namespace App\Entities;

use Illuminate\Support\Collection;
use App\Logics\Util;

class Post {
	public $post;
	public $postMetaArr = array(); // [ post_key => post_meta ]

	// parameter : post model, [postMetas model]
	public function Build($post, $postMetas) {
		if (is_null($postMetas)) {
			$postMetas = [];
		}

		$self = new static;
		$self->post = $post;
		$self->postMetaArr = collect($postMetas)->groupBy(function ($item, $key) {
			return $item->key;
		});

		return $self;
	}

	public function BuildMultiByPageAndCategoryIds($page, $categoryIds) {
		if (!is_array($categoryIds) || count($categoryIds) <= 0) {
			return [];
		}
		// 페이지에 표시할 포스트 범위
		$postNum = \App\Consts\Post::NUM_PER_PAGE;
		$offset = $postNum * ($page - 1);
		// 포스트 모델
		$postModels = \App\Models\Post::whereIn('category_id', $categoryIds)
			->where('status', 1)
			->orderByDesc('id')
			->offset($offset)
			->limit($postNum)
			->get();

		if ($postModels->count() <= 0) {
			return [];
		}

		// 포스트 ID
		$postIds = $postModels->map(function($postModel) {
			return $postModel->id;
		});
		
		// 메타데이터
		$postMetaModels = \App\Models\PostMeta::whereIn('post_id', $postIds);
		$postMetaByPostId = $postMetaModels->groupBy(function ($item, $key) {
			return $item->post_id;
		});

		$selves = [];
		foreach ($postModels as $postModel) {
			$postMeta = null;
			if (Util::CanGetArrayValue($postMetaByPostId, $postModel->id)) {
				$postMeta = $postMetaByPostId[$postModel->id];
			}
			array_push($selves, $this->Build($postModel, $postMeta));
		}

		return $selves;
	}

	public function ToArray() {
		$resultArr = [
			'id'           => $this->post->id,
			'title'        => $this->post->title,
			'content'      => $this->post->content,
			'updated_at'   => $this->post->updated_at,
		];

		$metas = [];
		foreach ($this->postMetaArr as $key => $postMeta) {
			$metas['name'] = $postMeta->key;
			$metas['content'] = $postMeta->value;
		}

		$resultArr['meta_list'] = $metas;

		return $resultArr;
	}
	
}