<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        return auth('admin')->check() ? view("admin.index") : view("admin.login");
    }
    public function login() {
        return view("admin.login");
    }
    public function store(Request $request) {
        try {
            auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')]);
            $request->session()->regenerate();
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
        return response()->redirectToRoute("admin.index");
    }
}
