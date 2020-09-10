<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Advertisement extends Model implements HasMedia
{
    use CrudTrait;
    use InteractsWithMedia;

    protected $table = 'advertisements';
    protected $guarded = ['id'];

    public function image()
    {
        if ($this->media->first()) {
            return $this->media->first()->getFullUrl('thumbnail');
        }
        return null;
    }

    public function registerAllMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(100)
            ->height(100);
    }
    
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
