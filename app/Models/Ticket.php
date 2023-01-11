<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
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
   protected $casts = ['priority' => 'object'];

}
