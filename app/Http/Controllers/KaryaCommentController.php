<?php

namespace App\Http\Controllers;

use App\karya_comment;
use App\karya_kelas;
use App\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryaCommentController extends Controller
{
    public function addDiscussKaryaKelas(Request $request, $id)
    {
        $karya = karya_kelas::where('id', '=', $id)->first();
        $comkarya = new karya_comment();
        $comkarya->user_id = Auth::user()->id;
        $comkarya->content = $request->content;

        $karya->karya_comments()->save($comkarya);

        return response()->json(['success'=>'Komentar Terkirim']);
    }

    public function replyDiscussKaryaKelas(Request $request, $id)
    {
        $karya = karya_comment::where('id', '=', $id)->first();
        $reply = new karya_comment();
        $reply->user_id = Auth::user()->id;
        $reply->content = $request->content;

        $karya->karya_comments()->save($reply);

        return response()->json(['success'=>'Balasan Terkirim']);
    }

    public function edit($id)
    {
        
        karya_kelas::where('id', $id)->first();
        return redirect();
    }

    public function update(Request $request, $id)
    {
        $comment = karya_comment::find($id);
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;

        $comment->save();

        return back()->with('success', 'Komentar berhasil diedit');
    }

    public function destroy($id)
    {
        karya_comment::find($id)->delete($id);
  
        return response()->json([
            'success' => 'Komentar terhapus'
        ]);
    }
}
