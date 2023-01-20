<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function images() {
        return $this->hasMany(Image::class);
    }
    protected $fillable = [
        'title',
        'description'
    ];
    public static $validation_rules = [
        'title' => 'required|unique:articles|max:255',
        'description' => 'required'
    ];
    public static $update_validation_rules = [
        'title' => 'required|max:255',
        'description' => 'required'
    ];
}
