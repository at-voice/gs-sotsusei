<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
