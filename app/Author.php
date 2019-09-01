<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Monolog\Logger;

class Author extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'github', 'twitter', 'location', 'latest_article_published'
  ];

  public function articles()
  {
    return $this->hasMany('App\Article');
  }

  public function updateLatestArticlePublished($article)
  {
    return $this->update(['latest_article_published' => $article->id]);
  }
}
