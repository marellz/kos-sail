<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'email',
        'subject',
        'phone',
        'message',
        'reply_to',
        'resolved',
        'read',
    ];

    protected $guarded = [
        'resolved',
    ];
}
