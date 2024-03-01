<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * get the reviews for a specific resource from storage.
     */
    public function getreviews(Reviews $reviews, Request $request, $id)
    {
       
        return ReviewResource::collection(Reviews::where('resource_id', $id)->paginate());
        
    }
    /**
     * get the reviews for a specific resource from storage.
     */
    public function saveReview(Reviews $reviews, Request $request)
    {
        $data = $request->validate([
            'rating' => 'nullable',
            'resource_id' => 'required',
            'text' => 'required',  
            'firstname' => 'nullable',  
            'userid' => 'nullable',  
        ]);
        
        try {
            $user = $request->user();
            $data['firstname'] = $user->firstname;
            $data['userid'] = $user->id;
            Reviews::create($data);
            return response()->json('Review created', 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
