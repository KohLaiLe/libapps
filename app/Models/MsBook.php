<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsBook extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_book';

    protected $fillable = [
        'is_available',
        'is_borrowed',
        'is_lost'
    ];

    public function borrow_book(){
        return $this->hasOne(TrBorrowBook::class, 'id_borrow_book', 'id_borrow_book');
    }
}
