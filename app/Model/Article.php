<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\Scout\Searchable;

/**
 */
class Article extends Model
{

    use Searchable;


    public function searchableAs()
    {
        return 'article_index';
    }

    public function toSearchableArray()
    {
        return $this->toArray();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["title","content"];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}