<?php

namespace App\Http\Controllers;

use App\comment;
use App\like;
use App\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

    public function addDiscuss(Request $request, video $video)
    {
        $comment = new comment();
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;

        $video->comments()->save($comment);

        return response()->json(['success'=>'Diskusi Terkirim']);
    }

    public function replyDiscuss(Request $request, comment $comment)
    {
        $reply = new comment();
        $reply->user_id = Auth::user()->id;
        $reply->content = $request->content;

        $comment->comments()->save($reply);

        return response()->json(['success'=>'Balasan Diskusi Terkirim']);
    }

    public function edit($id)
    {
        
        comment::where('id', $id)->first();
        return redirect();
    }

    public function update(Request $request, $id)
    {
        $comment = comment::find($id);
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;

        $comment->save();

        return response()->json(['success'=>'Diskusi berhasil diedit']);
    }

    public function destroy($id)
    {
        comment::find($id)->delete($id);
  
        return response()->json([
            'success' => 'Diskusi terhapus'
        ]);
    }

   
}
