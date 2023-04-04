<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\IdeaWord; //our_workに使用

class WorkInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content1_id',
        'content2_id',
        'content3_id',
        'content4_id',
        'content5_id',
        'content1_posted_by',
        'content2_posted_by',
        'content3_posted_by',
        'content4_posted_by',
        'content5_posted_by',
        'video_url',
        'event_name',
        'event_date',
        'event_location',
        'event_info_url',
        'event_type',
        'event_organizer',
    ];

    public function content1()
    {
        return $this->belongsTo(IdeaWord::class, 'content1_id');
    }

    public function content2()
    {
        return $this->belongsTo(IdeaWord::class, 'content2_id')->withDefault();
    }

    public function content3()
    {
        return $this->belongsTo(IdeaWord::class, 'content3_id')->withDefault();
    }

    public function content4()
    {
        return $this->belongsTo(IdeaWord::class, 'content4_id')->withDefault();
    }

    public function content5()
    {
        return $this->belongsTo(IdeaWord::class, 'content5_id')->withDefault();
    }
}
