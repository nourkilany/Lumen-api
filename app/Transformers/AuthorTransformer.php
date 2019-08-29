<?php

namespace App\Transformers;

use App\Author;
use League\Fractal;

class AuthorTransformer extends Fractal\TransformerAbstract
{
  public function transform(Author $author)
  {
    return [
      'id'                       => (int) $author->id,
      'name'                     =>  $author->name,
      'email'                    =>  $author->email,
      'github'                   =>  $author->github,
      'twitter'                  =>  $author->twitter,
      'location'                 =>  $author->location,
      'latest_article_published' =>  $author->latest_article_published,
      'created_at'               =>  $author->created_at->format('d-m-Y'),
      'updated_at'               =>  $author->updated_at->format('d-m-Y'),
    ];
  }
}
