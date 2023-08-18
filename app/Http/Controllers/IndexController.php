<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chapter;
use App\Models\Novel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home() {
        $categories =  Category::orderBy('id', 'DESC')->get();
        $novels = Novel::orderBy('id', 'DESC')->where('status', 0)->get();
        return view('page.home')->with(compact('categories', 'novels'));
    }

    public function read($slug) {
        $novel = Novel::where('slug_novel', $slug)->where('status', 0)->first();
        $chapters = Chapter::with('novel')->orderBy('id', 'ASC')->where('novel_id', $novel->id)->get();
        $countChapter = Chapter::where('novel_id', $novel->id)->count();
        $firstChapter = Chapter::with('novel')->orderBy('id', 'ASC')->where('novel_id', $novel->id)->first();
        $categories =  Category::orderBy('id', 'DESC')->get();
        $sameCategories = Novel::with('category')->where('category_id', $novel->category->id)->get();
        return view('page.novel')->with(compact('categories', 'novel', 'countChapter', 'chapters', 'sameCategories', 'firstChapter'));
    }

    public function novel_category($slug) {
        $categories =  Category::orderBy('id', 'DESC')->get();
        $category_id = Category::where('slug_category', $slug)->first();
        $novels = Novel::orderBy('id', 'DESC')->where('category_id', $category_id->id)->where('status', 0)->get();
        return view('page.category')->with(compact('novels', 'categories', 'category_id'));
    }

    public function read_chapter($slug) {
        $categories =  Category::orderBy('id', 'DESC')->get();
        $novel = Chapter::where('slug_chapter', $slug)->first();
        $chapter = Chapter::with('novel')->where('slug_chapter', $slug)->where('novel_id', $novel->novel_id)->first();
        $allChapter = Chapter::with('novel')->where('novel_id', $novel->novel_id)->orderBy('id', 'ASC')->get();
        $nextChapter = Chapter::where('novel_id', $novel->novel_id)->where('id', '>', $chapter->id)->min('slug_chapter');
        $previousChapter = Chapter::where('novel_id', $novel->novel_id)->where('id', '<', $chapter->id)->max('slug_chapter');
        $maxId = Chapter::where('novel_id', $novel->novel_id)->orderBy('id', 'DESC')->first();
        $minId = Chapter::where('novel_id', $novel->novel_id)->orderBy('id', 'ASC')->first();

        //Breadcrum
        $novel_Breadcrum = Novel::with('category')->where('id', $novel->novel_id)->first();
        //End BreadCrum
        return view('page.chapter')->with(compact('categories', 'chapter', 'allChapter', 'nextChapter', 'previousChapter', 'maxId', 'minId', 'novel_Breadcrum'));
    }

    public function search(Request $request) {
        $categories = Category::orderBy('id', 'DESC')->get();

        $search = $_GET['search'];
        $novels = Novel::with('category')->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('author', 'LIKE', '%' . $search . '%')->get();
        return view('page.search')->with(compact('categories', 'novels', 'search'));
    }
}
