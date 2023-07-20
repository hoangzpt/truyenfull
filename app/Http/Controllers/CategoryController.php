<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();

        return view('admin.category.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
                'name' => 'required|unique:category|max:255',
                'slug_category' => 'required|unique:category|max:255',
                'describe' => 'required|max:255',
                'status' => 'required',
            ],
            [
                // Sửa lại thông báo validate
                'name.unique' => 'Tên danh mục đã tồn tại',
                'slug_category.unique' => 'Slug danh mục đã tồn tại',
                'name.required' => 'Bạn phải điền tên danh mục',
                'describe.required' => 'Bạn phải điền mô tả danh mục',
            ]
        );

        $category = new Category();
        $category->name = $data['name'];
        $category->slug_category = $data['slug_category'];
        $category->describe = $data['describe'];
        $category->status = $data['status'];
        $category->save();
        return redirect()->back()->with('status', 'Thêm danh mục thành công');
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
        $category = Category::find($id);
        return view('admin.category.edit')->with(compact('category'));    
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
                'slug_category' => 'required|max:255',
                'describe' => 'required|max:255',
                'status' => 'required',
            ],
            [
                // Sửa lại thông báo validate
                'name.required' => 'Bạn phải điền tên danh mục',
                'slug_category.required' => 'Bạn phải điền slug danh mục',
                'describe.required' => 'Bạn phải điền mô tả danh mục',
            ]
        );

        $category = Category::find($id);

        $category->name = $data['name'];
        $category->slug_category = $data['slug_category'];
        $category->describe = $data['describe'];
        $category->status = $data['status'];

        $category->save();
        return redirect()->back()->with('status', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa danh mục thành công');
    }
}
