<?php

namespace App\Http\Controllers\Admin\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index($id)
    {
        return view('admin.pages.clubs.roles.role-index', [
            'club_id' => $id
        ]);
    }

    public function detail()
    {
        return view('admin.pages.clubs.roles.role-detail', [
            'club_id' => request('id'),
            'role_id' => request('role_id')
        ]);
    }

    public function create($id)
    {
        return view('admin.pages.clubs.roles.role-create', [
            'club_id' => $id
        ]);
    }
}
