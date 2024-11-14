<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Product::select('*'))
                ->addColumn('action', 'product.product-action')
                ->addColumn('image', 'product.image')
                ->rawColumns(['action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('product.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productId = $request->product_id;
        $product = Product::find($productId) ?? new Product();
        $image = $request->hidden_image;

        if ($files = $request->file('image')) {
            // Delete old file
            if (!empty($request->hidden_image)) {
                File::delete('public/product/' . $request->hidden_image);
            }

            // Upload new file
            $destinationPath = 'public/product/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $image = $profileImage;
        }

        // Set product attributes
        //$product->title = $request->title;
        //$product->category = $request->category;
        //$product->price = $request->price;
        $product->tgl_entry = $request->tgl_entry;
        $product->user = $request->user;
        $product->no_hp = $request->no_hp;
        $product->bidang_system = $request->bidang_system;
        $product->kategori = $request->kategori;
        $product->sub_kategori = $request->sub_kategori;
        $product->problem = $request->problem;
        $product->menu = $request->menu;
        $product->prioritas = $request->prioritas;
        $product->handle_by = $request->handle_by;
        $product->image = $image;

        // Save product
        $product->save();

        return response()->json($product);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product && $product->image) {
            File::delete('public/product/' . $product->image);
        }

        $product->delete();

        return response()->json(['success' => true]);
    }
}
