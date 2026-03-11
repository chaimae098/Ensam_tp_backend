<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrower_name',
        'borrower_email',
        'book_title',
        'borrowed_at',
        'due_date',
        'returned',
        'status'
    ];
}
