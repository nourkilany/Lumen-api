<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'subject', 'secondary_title', 'body', 'image', 'author_id'
  ];

  public function author()
  {
    return $this->belongsTo('App\Author');
  }
}
