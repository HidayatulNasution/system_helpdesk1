<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\M_admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(M_admin::select('*')->where('status', 0))
                ->addColumn('action', 'admin.admin-action')
                ->rawColumns(['action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }

        // ambil data persentase berdasarkan tanggal entry
        $reportData = M_admin::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->groupBy('month')
            ->get();

        $totalEntries = $reportData->sum('total');

        // array data untuk setiap bulan (Jan - Dec) dengan nilai default 0
        $dataByMonth = array_fill(0, 12, 0);

        foreach ($reportData as $data) {
            $dataByMonth[$data->month - 1] = $data->total;
        }

        // Tambahkan Data berdasarkan status 0 (on progress)
        $statusData = M_admin::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->where('status', 0) // 1 = done, 0 =  on progress
            ->groupBy('month')
            ->get();

        // array data untuk status 'on progress' per bulan
        $dataByStatus = array_fill(0, 12, 0);
        foreach ($statusData as $data) {
            $dataByStatus[$data->month - 1] =  $data->total;
        }

        // Tambahkan data berdasarkan status 1 (done)
        $statusDataDone = M_admin::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->where('status', 1)
            ->groupBy('month')
            ->get();

        // array data untuk status 'done' per bulan
        $dataByStatusDone = array_fill(0, 12, 0);
        foreach ($statusDataDone as $data) {
            $dataByStatusDone[$data->month - 1] = $data->total;
        }

        return view('admin.list', compact('dataByMonth', 'dataByStatus', 'dataByStatusDone'));
    }

    public function done()
    {
        if (request()->ajax()) {
            $query = M_admin::select('*')->where('status', 1);

            // Apply month and year filters if provided
            $month = request()->get('month');
            $year = request()->get('year');
            if ($month) {
                $query->whereMonth('created_at', $month);
            }
            if ($year) {
                $query->whereYear('created_at', $year);
            }

            return datatables()->of($query)
                ->addColumn('action', 'admin.done-action')
                ->rawColumns(['action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }

        // Get the report data as before
        $reportData = M_admin::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->groupBy('month')
            ->get();
        $totalEntries = $reportData->sum('total');

        // Array data for each month (Jan - Dec) default to 0
        $dataByMonth = array_fill(0, 12, 0);
        foreach ($reportData as $data) {
            $dataByMonth[$data->month - 1] = $data->total;
        }

        // Add data based on status
        $statusData = M_admin::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->where('status', 1)
            ->groupBy('month')
            ->get();

        // Array data for status 'DONE' per month
        $dataByStatus = array_fill(0, 12, 0);
        foreach ($statusData as $data) {
            $dataByStatus[$data->month - 1] =  $data->total;
        }

        return view('admin.list', compact('dataByMonth', 'dataByStatus'));
    }


    public function downloadDoneExcel()
    {
        $month = request()->get('month');
        $year = request()->get('year');

        // Query the data based on filters
        $query = M_admin::select('*')->where('status', 1);
        if ($month) {
            $query->whereMonth('created_at', $month);
        }
        if ($year) {
            $query->whereYear('created_at', $year);
        }
        $data = $query->get();

        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers for the Excel file
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Tanggal Entry');
        $sheet->setCellValue('C1', 'User');
        $sheet->setCellValue('D1', 'Bidang System');
        $sheet->setCellValue('E1', 'Prioritas');
        $sheet->setCellValue('F1', 'Status');

        // Populate the data
        $rowNumber = 2;
        foreach ($data as $index => $item) {
            $sheet->setCellValue('A' . $rowNumber, $index + 1);
            $sheet->setCellValue('B' . $rowNumber, $item->created_at);
            $sheet->setCellValue('C' . $rowNumber, $item->user);
            $sheet->setCellValue('D' . $rowNumber, $item->bidang_system);
            $sheet->setCellValue('E' . $rowNumber, $item->prioritas == 1 ? 'URGENT' : 'BIASA');
            $sheet->setCellValue('F' . $rowNumber, $item->status == 1 ? 'DONE' : 'On Progress');
            $rowNumber++;
        }

        // Create a writer and export the file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Done_Ticket_Report_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productId = $request->product_id;
        $product = M_admin::find($productId) ?? new M_admin();
        $image = $request->hidden_image;

        if ($files = $request->file('image')) {
            // Delete old files
            if (!empty($request->hidden_image)) {
                File::delete('public/admin/' . $request->hidden_image);
            }

            // Upload New File
            $destinationPath = 'public/admin/';
            $profileImage = date('YmdHis') . "." . $files->geClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $image = $profileImage;
        }

        $product->created_at = $request->created_at;
        $product->user = $request->user;
        $product->no_hp = $request->no_hp;
        $product->bidang_system = $request->bidang_system;
        $product->kategori = $request->kategori;
        $product->sub_kategori = $request->sub_kategori;
        $product->problem = $request->problem;
        $product->menu = $request->problem;
        $product->prioritas = $request->prioritas;
        $product->image = $request->image;

        $product->save();

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetail($id)
    {
        $product = M_admin::find($id);
        if (!$product) {
            return response()->json(['error' => 'Data Tidak Ditemukan'], 404);
        }
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = M_admin::find($id);
        if (!$product) {
            return response()->json(['error' => 'Data Tidak Ditemukan'], 404);
        }
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product  = M_admin::find($id);

        if ($product && $product->image) {
            File::delete('public/admin/' . $product->image);
        }

        $product->delete();

        return response()->json(['success' => true]);
    }
}
