<?php

namespace App\Http\Controllers\Admin\Clubs;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $club_id = $request->id;
        return view('admin.pages.clubs.posts.index',[
            'club_id'=> $club_id,
        ]);
    }

    public function create(Request $request)
    {
        $club_id = $request->id;
        return view('admin.pages.clubs.posts.create',[
            'club_id'=> $club_id,
        ]);
    }

    public function detail(Request $request)
    {
        $club_id = $request->id;
        return view('admin.pages.clubs.posts.detail',[
            'post_id' => $request->post_id,
            'club_id'=> $club_id,
        ]);
    }

    public function edit(Request $request)
    {
        $club_id = $request->id;
        return view('admin.pages.clubs.posts.edit',[
            'post_id' => $request->post_id,
            'club_id'=> $club_id,
        ]);

    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            try {
                $file = $request->file('upload');

                // Validate file
                $validator = Validator::make($request->all(), [
                    'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'uploaded' => 0,
                        'error' => [
                            'message' => $validator->errors()->first('upload')
                        ]
                    ]);
                }

                // Xử lý tên file
                $originName = $file->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::slug($fileName) . '_' . time() . '.' . $extension;

                // Lưu file vào thư mục storage/public/blogImg
                $file->move(storage_path('app/public/Clubs/Posts'), $fileName);

                // Trả về response theo đúng format CKEditor yêu cầu
                return response()->json([
                    'uploaded' => 1,
                    'fileName' => $fileName,
                    'url' => asset('storage/Clubs/Posts/' . $fileName)
                ]);
            } catch (Exception $e) {
                Log::error('CKEditor upload error: ' . $e->getMessage());
                return response()->json([
                    'uploaded' => 0,
                    'error' => [
                        'message' => 'Error uploading file: ' . $e->getMessage()
                    ]
                ]);
            }
        }

        return response()->json([
            'uploaded' => 0,
            'error' => [
                'message' => 'No file was uploaded.'
            ]
        ]);
    }
}
