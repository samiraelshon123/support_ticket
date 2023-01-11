<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment'];
    public function ticket()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_comments', 'comment_id', 'ticket_id');
    }
}
