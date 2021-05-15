<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @param string $title
 * @property string $url
 */
class Book extends Model
{
    use HasFactory;
}
