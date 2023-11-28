<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrBorrowBook extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_borrow_book';

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function book(){
        return $this->belongsTo(MsBook::class, 'id_book', 'id_book');
    }
}
