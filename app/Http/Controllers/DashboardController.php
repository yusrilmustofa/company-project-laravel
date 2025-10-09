<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        // Get top 5 articles ordered by created_at (most recent first)
        $topArticles = Article::with('category')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
            
        return view('dashboard', compact('topArticles'));
    }
}