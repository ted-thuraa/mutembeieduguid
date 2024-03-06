<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashController extends Controller
{
    <?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Resources;
use App\Models\RoomApplication;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::count();
        $books = Resources::where('type', 'Book')->count();
        $articles = Hotel::where('type', 'Article')->count();
        $videos = RoomApplication::where('type', 'Video')->count();

        $data = [
            'users' => $users,
            'books' => $books,
            'articles' => $articles,
            'videos' => $videos,
           
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }
}
