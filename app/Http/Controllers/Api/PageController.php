<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page()
    {
        $page= Page::first();

    
        return response()->json(["status" => true,"data" =>$page]);
    }
}
