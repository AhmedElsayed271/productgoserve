<?php


namespace App\Http\Controllers\Dashboard;

use App\Models\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permissionMiddleware:read-sizes')->only('index');
        $this->middleware('permissionMiddleware:delete-products')->only('destroy');
        $this->middleware('permissionMiddleware:update-products')->only(['edit', 'update', 'activity_logs']);
        $this->middleware('permissionMiddleware:create-products')->only(['create', 'store']);
    }


    public function index()
    {
        $sizes = Size::all();
        return view('dashboard.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'unique:sizes|min:2',
        ]);

        Size::create([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.sizes.index')->with('success', 'تم اضافة المقاس بنجاج');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        
        return view('Dashboard.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $size = Size::findOrFail($id);

        $request->validate([
            'name' => 'unique:sizes|min:2',
        ]);

        $size->update([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.sizes.index')->with('success','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect()->route('dashboard.sizes.index')->with('success','تم الحذف بنجاح');
    }
}
