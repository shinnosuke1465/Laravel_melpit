<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;
use App\Http\Requests\SellRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageService;

class SellController extends Controller
{
    public function showSellForm()
    {
        $categories = PrimaryCategory::query()
            ->with([
                'secondaryCategories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();
        $conditions = ItemCondition::orderBy('sort_no')->get();

        return view('sell')
            ->with('categories', $categories)
            ->with('conditions', $conditions);
    }

    public function sellItem(SellRequest $request)
    {
        $user = Auth::user();
        //画像ファイル取得
        $imageFile = $request->item;

        //画像を選択していて確実にアップロードできていたら
        if (!is_null($imageFile) && $imageFile->isValid()) {
            //画像とフォルダ名を渡す
            $fileNameToStore = ImageService::upload($imageFile, 'products');
        }

        $item = new Item();
        $item->seller_id = $user->id;
        $item->name = $request->input('name');
        $item->description  = $request->input('description');
        $item->secondary_category_id = $request->input('category');
        $item->item_condition_id = $request->input('condition');
        $item->price = $request->input('price');
        $item->state = Item::STATE_SELLING;
        //DBに画像保存
        if (!is_null($imageFile)) {
            $item->image_file_name = $fileNameToStore;
        }
        $item->save();

        return redirect()->back()
            ->with('status', '商品を出品しました。');
    }
}
