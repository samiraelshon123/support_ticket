<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Comment extends Model
{
    use LogsActivity;
    protected $fillable = ['comment'];
    public function ticket()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_comments', 'comment_id', 'ticket_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }
}
