<?php

namespace App\Models;

class Comments extends Model
{
    public $id;
    public $user_name;
    public $comment_data;
    public $comment_text;
    public $product_id;

    public function getTableName(): string
    {
        return 'goods';
    }

}