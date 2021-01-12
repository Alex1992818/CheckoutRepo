<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Users\UsersRepositoryInterface;

class FavoriteController extends Controller
{
    public function addFavorite(Request $request, UsersRepositoryInterface $usersRepository) {
        $fs_user = null;
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
        }
        if(is_null($fs_user)){
            return 0;
        }

        $id = $fs_user->user_id.$request->id;

        return $usersRepository->addFavorite($id, $fs_user->user_id, $request->type, $request->data);
    }

    public function removeFavorite(Request $request, UsersRepositoryInterface $usersRepository) {
        $fs_user = null;
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
        }
        if(is_null($fs_user)){
            return 0;
        }
        $id = $fs_user->user_id.$request->id;

        return $usersRepository->removeFavorite($id);
    }
}
