<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Mypage\Profile\EditRequest;
use Intervention\Image\Facades\Image;
use App\Services\ImageService;

class ProfileController extends Controller
{
    public function showProfileEditForm()
    {
        return view('mypage.profile_edit_form')
            ->with('user', Auth::user());
    }
    public function editProfile(EditRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');

        $imageFile = $request->avatar;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            //画像とフォルダ名を渡す
            $fileNameToStore = ImageService::upload($imageFile, 'images');
        }
        if (!is_null($imageFile)) {
            $user->avatar_file_name = $fileNameToStore;
        }
        $user->save();

        return redirect()->back()
            ->with('status', 'プロフィールを変更しました。');
    }
}
