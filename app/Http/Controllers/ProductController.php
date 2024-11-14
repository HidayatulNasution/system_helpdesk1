<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

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

        // Ambil data persentase berdasarkan tanggal entry
        $reportData = Product::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->groupBy('month')
            ->get();

        $totalEntries = $reportData->sum('total');

        // Buat array data untuk setiap bulan (Jan - Dec) dengan nilai default 0
        $dataByMonth = array_fill(0, 12, 0);
        foreach ($reportData as $data) {
            $dataByMonth[$data->month - 1] = $data->total;
        }

        // Tambahkan data berdasarkan status
        $statusData = Product::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->where('status', 1) // Anggap 1 adalah 'DONE' dan 0 adalah 'On Progress'
            ->groupBy('month')
            ->get();

        // Buat array data untuk status 'DONE' per bulan
        $dataByStatus = array_fill(0, 12, 0);
        foreach ($statusData as $data) {
            $dataByStatus[$data->month - 1] = $data->total;
        }

        return view('product.index', compact('dataByMonth', 'dataByStatus'));
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
        $product->created_at = $request->created_at;
        $product->user = $request->user;
        $product->no_hp = $request->no_hp;
        $product->bidang_system = $request->bidang_system;
        $product->kategori = $request->kategori;
        $product->sub_kategori = $request->sub_kategori;
        $product->problem = $request->problem;
        $product->result = $request->result;
        $product->menu = $request->menu;
        $product->prioritas = $request->prioritas;
        $product->status = $request->status;
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

    public function showDetail($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
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
