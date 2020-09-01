<?php

namespace App\Http\Controllers;

use App\rating;
use App\video;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function addReview(Request $request, video $video)
    {
        
     
     $rating = new rating();
     $rating->rating = $request->rating;
     $rating->user_id = auth()->user()->id;
     $rating->content_ulasan = $request->content_ulasan;

     $video->ratings()->save($rating);

     return response()->json(['success'=>'Ulasan Terkirim']);
        
    }
}
