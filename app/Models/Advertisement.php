<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Advertisement extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['title', 'description', 'price', 'user_id','is_accepted'];

    public function toSearchableArray(){
        $category = $this->category;
        $array = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $category,
        ];
        return $array;
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function setAccepted($value){
        $this->is_accepted=$value;
        $this->save();
        return true;
    }
    public static function toBeRevisonedCount(){
        return Advertisement::where('is_accepted', null)->count();
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

}
