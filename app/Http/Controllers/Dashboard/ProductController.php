<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    function __construct()
    {
        $this->middleware('permissionMiddleware:read-sizes')->only('index');
        $this->middleware('permissionMiddleware:delete-sizes')->only('destroy');
        $this->middleware('permissionMiddleware:update-sizes')->only(['edit', 'update', 'activity_logs']);
        $this->middleware('permissionMiddleware:create-sizes')->only(['create', 'store']);
    }


    public function index(Request $request)
    {


        $sizes = Size::all();

        if ($request->ajax()) {

            $products = Product::with(['sizes']);

            if (request('size')) {
                $products->whereRelation('sizes', 'name', request('size'));
            }


            return Datatables($products)

                ->addColumn('size', function ($product) {

                    $sizeProduct = '';

                    foreach ($product->sizes as $size) {

                        $sizeProduct .= $size->name . ",";
                    }
                    return $sizeProduct;
                })
                // ->with('count', function () use ($products) {
                //     return $products->count();
                // })

                ->addColumn('actions', 'Dashboard.products.actions')

                ->addColumn('checkboxDelete', 'Dashboard.products.checkboxDelete')
                ->setRowId('row-{{$id}}')

                ->editColumn('created_at', function ($product) {

                    return $product->created_at->format('Y-m-d H:i:s');
                })
                ->rawColumns(['actions','checkboxDelete'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.products.index', compact('sizes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sizes = Size::all();



        return view('Dashboard.products.create', compact('sizes'));
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
            'name' => 'required|string|min:3',
            'sizes' => 'exists:sizes,id',
        ]);



        $product = Product::create([
            'name' => $request->name,
        ]);

        $product->sizes()->attach($request->sizes);

        return redirect()->route('dashboard.products.index')->with('success', 'تم اضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sizes = Size::all();

        $product = Product::findOrFail($id);

        return view('Dashboard.products.edit', compact('product', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'sizes' => 'exists:sizes,id',
        ]);


        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
        ]);


        $product->sizes()->sync($request->sizes);


        return redirect()->route('dashboard.products.index')
            ->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();


        return redirect()->route('dashboard.products.index')->with('success', 'تم حذف المنتج بنجاح');
    }

    public function destroyAll(Request $request) 
    {

        $ids = $request->ids;

        $products = Product::whereIn('id',$ids);

        $products->delete();

        return response()->json([
            'status' => 204,
            'data' =>  $products,
        ]);

    }

    public function importProductPage()
    {
        return view('Dashboard.products.import-product');
    }
    public function importProduct(Request $request)
    {

        $request->validate([
            'excel' => 'required|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp',
        ]);

        Excel::import(new ProductImport, request()->file('excel'));

        return redirect()->route('dashboard.products.index')
            ->with('success', 'تم اضافة المنتج بنجاح');
    }
}
