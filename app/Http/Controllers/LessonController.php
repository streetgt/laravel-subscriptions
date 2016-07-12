<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LessonController extends Controller
{
    public function index()
    {
        return 'Lesson index';
    }

    public function pro()
    {
        return 'Pro lesson index';
    }
}
