<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SecondaryCategory;
class Item extends Model
{
    use HasFactory;

     // 出品中
     const STATE_SELLING = 'selling';
     // 購入済み
     const STATE_BOUGHT = 'bought';

     protected $casts = [
        'bought_at' => 'datetime',
    ];

     public function secondaryCategory()
     {
         return $this->belongsTo(SecondaryCategory::class);
     }

     public function seller()
     {
         return $this->belongsTo(User::class, 'seller_id');
     }
 
     public function condition()
     {
         return $this->belongsTo(ItemCondition::class, 'item_condition_id');
     }
//soldラベルの表示非表示のために定義
     public function getIsStateSellingAttribute()
     {
         return $this->state === self::STATE_SELLING;
     }

     public function getIsStateBoughtAttribute()
     {
         return $this->state === self::STATE_BOUGHT;
     }
}
