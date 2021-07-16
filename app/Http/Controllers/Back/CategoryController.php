<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Article;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
    }

    public function create(Request $request)
    {
        $isExists = Category::whereSlug(Str::slug($request->category))->first();
        if (!$isExists) {
            $category = new Category;
            $category->name = $request->category;
            $category->slug = Str::slug($request->category);
            $category->save();
            toastr()->success('Kategori eklendi', 'Başarılı');
            return redirect()->back();
        } else {
            toastr()->error($request->category . ' adında bir kategori zaten mevcut.', 'Başarısız', ['timeOut' => 2000]);
            return redirect()->back();
        }

    }

    public function update(Request $request)
    {
        $isSlug = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName = Category::whereName($request->category)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->category . ' adında bir kategori zaten mevcut.', 'Başarısız', ['timeOut' => 2000]);
            return redirect()->back();

        }
        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->slug);
        $category->save();
        toastr()->success('Kategori güncellendi', 'Başarılı', ['timeOut' => 2000]);
        return redirect()->back();

    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        if ($category->id == 1) {
            toastr()->error('Bu kategori silinemez', 'Başarısız', ['timeOut' => 2000]);
            return redirect()->back();
        }
        $count = $category->articleCount();
        $defaultCategory = Category::find(1);
        $message = "";
        if ($category->articleCount() > 0) {
            Article::where('category_id', $category->id)->update(['category_id' => 1]);
            $message =  'Bu kategoriye ait ' . $count . ' makale ' . $defaultCategory->name . ' kategorisine taşındı.';
        }
        toastr()->success($message,'Kategori başarıyla silindi' ,['timeOut' => 3500]);

        $category->delete();
        return redirect()->back();

    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }
}
