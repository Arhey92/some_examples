<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookStorage extends Model
{
    protected $table = 'book_storage';

    protected $fillable = ['title', 'storage_id', 'start_date', 'end_date', 'description'];


    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;
    }

    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;
    }

    public function setStorageId($storageId)
    {
        $this->storage_id = $storageId;
    }
};