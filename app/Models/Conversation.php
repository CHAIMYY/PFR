<?php

namespace App\Models;
use App\Models\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversation';
    protected $fillable = ['name'];

   
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
