<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image'];
    public function ticket()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_categories', 'category_id', 'ticket_id');
    }
    public $appends = ['image_for_web'];
    public function getImageForWebAttribute(){
        if($this->image)
            return asset('assets/upload/category/'.$this->image);
        else
            return asset('assets/upload/default.png');

    }
}
