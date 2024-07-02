<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::tree()->get();
        return view('dashboard.categories.index')->with([
            'categories'    => $categories,
        ]);
    }

    public function create(){
        $categories = Category::tree(0)->get();

        return view('dashboard.categories.create')->with([
            'categories'    => $categories,
        ]);
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
                $input = $request->only('parent_id', 'en', 'ar');

                Category::create($input);
            DB::commit();
            return redirect(route('dashboard.categories.index'))->with('success', 'success');
        } catch(\Exception $ex){
            return redirect(route('dashboard.categories.index'))->with('error', 'faild');
        }
    }

    public function edit($id){
        $data = Category::findOrFail($id);
        $categories = Category::tree(0)->where('id', '!=',$id)->get();

        return view('dashboard.categories.edit')->with([
            'categories'    => $categories,
            'data'  => $data,
        ]);
    }

    public function update(Request $request, $id){
        $input = $request->only('parent_id', 'en', 'ar');
        $category = Category::findOrFail($id);

        try{
            DB::beginTransaction();
                $category->update($input);
            DB::commit();
            return redirect(route('dashboard.categories.index'))->with('success', 'success');
        } catch(\Exception $ex){
            return redirect(route('dashboard.categories.index'))->with('error', 'faild');
        }
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect(route('dashboard.categories.index'))->with('success', 'success');
    }
}
