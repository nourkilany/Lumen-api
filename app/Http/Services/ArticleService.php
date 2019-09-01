<?php

namespace App\Http\Services;

use App\Author;
use Illuminate\Support\Carbon;

class ArticleService extends BaseService
{
  public function createArticle($request)
  {
    $imagePath = $this->uploadImage($request['image']);

    //TODO Get logged in user id instead of this
    $author = Author::first();

    $article = $author->articles()->create([
      'subject' => $request['subject'],
      'secondary_title' => $request['secondary_title'],
      'body' => $request['body'],
      'image' => $imagePath,
    ]);

    $author->updateLatestArticlePublished($article);

    return $article;
  }

  private function uploadImage($image)
  {
    $imageName = $image->getClientOriginalName();

    $imageName = Carbon::now() . $imageName;

    $image->move('uploads', $imageName);

    return 'uploads/' . $imageName;
  }
}
