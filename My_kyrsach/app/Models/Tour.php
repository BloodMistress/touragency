<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
class Tour extends Model
{
    use HasFactory;

    protected $table = 'tour'; // имя таблицы
    protected $primaryKey = 'tourID'; // имя первичного ключа
    public $timestamps = false; // таблица не содержит поля created_at и updated_at

    protected $fillable = [
        'tour_name',
        'price',
        'tour_photo',
        'num_of_people',
        'placement',
        'date',
        'age_orientation',
        'description',
        'selection_toursID',
        'companyIDtour',
    ];
}
