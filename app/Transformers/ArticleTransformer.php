<?php

namespace App\Transformers;

use App\Article;
use League\Fractal;

class ArticleTransformer extends Fractal\TransformerAbstract
{
  public function transform(Article $article)
  {
    return [
      'id'                       => (int) $article->id,
      'subject'                  =>  $article->subject,
      'secondary_title'          =>  $article->secondary_title,
      'body'                     =>  $article->body,
      'author'                   =>  $article->author->name,
      'image'                    =>  $article->image,
      'created_at'               =>  $article->created_at->format('d-m-Y'),
      'updated_at'               =>  $article->updated_at->format('d-m-Y'),
    ];
  }
}
