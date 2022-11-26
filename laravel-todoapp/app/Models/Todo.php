<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    // protected $fillable = ['content', 'genre_id'];
    protected $guarded = array('id');

    public function tag()
    {
        return $this->BelongsTo(Tag::class);
    }

    public static function doSearch($keyword, $genre_id)
    {
        $query = self::query();
        if (!empty($keyword)) {
            $query->where('content', 'like binary', "%{$keyword}%");
        }
        if (!empty($genre_id)) {
            $query->where('genre_id', 'like binary', "%{$genre_id}%");
        }
        $results = $query->get();
        return $results;
    }
}
