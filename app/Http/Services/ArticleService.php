<?php

namespace App\Http\Services;

use App\Author;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ArticleService extends BaseService
{
  public function createArticle($request)
  {
    $imagePath = $this->uploadImage($request['image']);

    $author = Auth::user();

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

    $imageName = uniqid() . $imageName;

    $path = 'uploads/';

    $destinationPath = $this->public_path($path);

    $image->move($destinationPath, $imageName);

    return 'uploads/' . $imageName;
  }

  /**
   * Helper function to get application base path
   * The same function is available in laravel
   * But not lumen.
   */
  private function public_path($path = null)
  {
    return rtrim(app()->basePath('public/' . $path), '/');
  }
}
