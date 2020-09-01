<?php

namespace App\Http\Controllers;

use App\comment;
use App\karya_comment;
use App\karya_kelas;
use App\like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class LikeController extends Controller
{

    public function likeIt($id)
    {
        $this->handleLike('App\karya_kelas', $id);
        return redirect()->back();
    }
    
    public function handleLike($type, $id)
    {
        $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->first();

        if (is_null($existing_like)) {
            like::create([
                'user_id'       => Auth::id(),
                'likeable_id'   => $id,
                'likeable_type' => $type,
            ]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
    }

    public function likeComment($commentId)
    {
        $comment = comment::find($commentId);
        $comment->likeComment();
        return response()->json(['status' => 'success']);
    }
}
