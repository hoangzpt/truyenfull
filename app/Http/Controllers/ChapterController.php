<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Novel;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapters = Chapter::with('novel')->orderBy('id', 'DESC')->get();
        return view('admin.chapter.index')->with(compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $novels = Novel::orderBy('id', 'DESC')->get();

        return view('admin.chapter.create')->with(compact('novels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|unique:chapter|max:255',
                'slug_chapter' => 'required|unique:chapter|max:255',
                'describe' => 'required',
                'status' => 'required',
                'content' => 'required',
                'novel' => 'required',
            ],
            [
                // Sửa lại thông báo validate
                'title.unique' => 'Tên truyện đã tồn tại',
                'slug_chapter.unique' => 'Slug truyện đã tồn tại',
                'title.required' => 'Bạn phải điền tên truyện',
                'slug_chapter.required' => 'Bạn phải điền slug_truyện',
                'describe.required' => 'Bạn phải điền mô tả truyện',
                'content.required' => 'Bạn phải điền nội dung truyện',
            ]
        );

        $chapter = new Chapter();
        $chapter->title = $data['title'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->describe = $data['describe'];
        $chapter->content = $data['content'];
        $chapter->status = $data['status'];
        $chapter->novel_id = $data['novel'];

        $chapter->save();
        return redirect()->back()->with('status', 'Thêm chương thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $novels = Novel::orderBy('id', 'DESC')->get();
        $chapter = Chapter::find($id);
        return view('admin.chapter.edit')->with(compact('novels', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'slug_chapter' => 'required|max:255',
                'describe' => 'required',
                'status' => 'required',
                'content' => 'required',
                'novel' => 'required',
            ],
            [
                // Sửa lại thông báo validate
                'title.required' => 'Bạn phải điền tên truyện',
                'slug_chapter.required' => 'Bạn phải điền slug_truyện',
                'describe.required' => 'Bạn phải điền mô tả truyện',
                'content.required' => 'Bạn phải điền nội dung truyện',
            ]
        );

        $chapter = Chapter::find($id);
        $chapter->title = $data['title'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->describe = $data['describe'];
        $chapter->content = $data['content'];
        $chapter->status = $data['status'];
        $chapter->novel_id = $data['novel'];

        $chapter->save();
        return redirect()->back()->with('status', 'Cập nhật chương thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('status', 'Xoá chương thành công');
    }
}
