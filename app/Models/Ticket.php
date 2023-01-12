<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Ticket extends Model
{
    use LogsActivity;
    protected $fillable = ['title', 'description','priority', 'status', 'user_id', 'agent_id', 'comment_id'];


    public function category()
    {
        return $this->belongsToMany(Category::class, 'ticket_categories', 'ticket_id', 'category_id');
    }
    public function label(){
        return $this->belongsToMany(Label::class, 'ticket_labels', 'ticket_id', 'label_id');
    }
    public function file(){
        return $this->belongsToMany(File::class, 'ticket_files', 'ticket_id', 'file_id');
    }
    public function comment()
    {
        return $this->belongsToMany(Comment::class, 'ticket_comments', 'ticket_id', 'comment_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
//    protected $casts = ['priority' => 'object'];

}
