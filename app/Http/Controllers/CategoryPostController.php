<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function index(Request $request){
        return view('admin.pages.clubs.category_posts.index', [
            'club_id' => $request->id,
        ]);
    }

    public function create(Request $request){
        return view('admin.pages.clubs.category_posts.create', [
            'club_id' => $request->id,
        ]);
    }

    public function edit(Request $request){
        return view('admin.pages.clubs.category_posts.edit', [
            'club_id' => $request->id,
            'category_id' => $request->category_id,
        ]);
    }

    public function detail(Request $request){
        return view('admin.pages.clubs.category_posts.detail', [
            'club_id' => $request->id,
            'category_id' => $request->category_id,
        ]);
    }
}
