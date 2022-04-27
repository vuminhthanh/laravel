<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'image_link',
        'comment',
        'title',
    ];
}
