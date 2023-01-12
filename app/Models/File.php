<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class File extends Model
{
    use LogsActivity;
    protected $fillable = ['title'];
    public function ticket()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_files', 'file_id', 'ticket_id');
    }
    public $appends = ['image_for_web'];
    public function getImageForWebAttribute(){
        if($this->image)
            return asset('assets/upload/file/'.$this->image);
        else
            return asset('assets/upload/default.png');

    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }
}
