<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Novel;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $novels = Novel::with('category')->orderBy('id', 'DESC')->get();
        return view('admin.novel.index')->with(compact('novels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.novel.create')->with(compact('categories'));
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
                'name' => 'required|unique:novel|max:255',
                'author' => 'required|unique:novel|max:255',
                'slug_novel' => 'required|unique:novel|max:255',
                'describe' => 'required',
                'status' => 'required',
                'image' => 'required|image|mimes:jpg,png,jepg,svg|max:2048|dimensions:min_width=100,min_height=100,
                max_width=1920,max_height=1080',
                'category' => 'required',
            ],
            [
                // Sửa lại thông báo validate
                'name.unique' => 'Tên truyện đã tồn tại',
                'slug_novel.unique' => 'Slug truyện đã tồn tại',
                'name.required' => 'Bạn phải điền tên truyện',
                'author.required' => 'Bạn phải điền tên tác giả',
                'slug_novel.required' => 'Bạn phải điền slug_truyện',
                'describe.required' => 'Bạn phải điền mô tả truyện',
                'image.required' => 'Phải thêm hình ảnh',
            ]
        );

        $novel = new Novel();
        $novel->name = $data['name'];
        $novel->author = $data['author'];
        $novel->slug_novel = $data['slug_novel'];
        $novel->describe = $data['describe'];
        $novel->status = $data['status'];
        $novel->category_id = $data['category'];

        //Thêm ảnh vào folder
        $get_image = $request->image;
        $path = 'public/uploads/novel/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $novel->image = $new_image;

        $novel->save();
        return redirect()->back()->with('status', 'Thêm truyện thành công');
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
        $novel = Novel::find($id);
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.novel.edit')->with(compact('novel', 'categories'));
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
                'name' => 'required|max:255',
                'author' => 'required|max:255',
                'slug_novel' => 'required|max:255',
                'describe' => 'required',
                'status' => 'required',
                'category' => 'required',
            ],
            [
                // Sửa lại thông báo validate

                'name.required' => 'Bạn phải điền tên truyện',
                'author.required' => 'Bạn phải điền tên tác giả',
                'slug_novel.required' => 'Bạn phải điền slug_truyện',
                'describe.required' => 'Bạn phải điền mô tả truyện',

            ]
        );

        $novel = Novel::find($id);
        $novel->name = $data['name'];
        $novel->author = $data['author'];
        $novel->slug_novel = $data['slug_novel'];
        $novel->describe = $data['describe'];
        $novel->status = $data['status'];
        $novel->category_id = $data['category'];

        //Thêm ảnh
        $get_image = $request->image;
        if ($get_image) {
            $path = 'public/uploads/novel/' . $novel->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/novel/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $novel->image = $new_image;
        }
        $novel->save();
        return redirect()->back()->with('status', 'Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $novel = Novel::find($id);
        $path = 'public/uploads/novel/' . $novel->image;
        if (file_exists($path)) {
            unlink($path);
        }
        Novel::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa truyện thành công');
    }
}
