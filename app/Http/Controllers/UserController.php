<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(User::select('*'))
                ->addColumn('action', 'user.user-action')
                ->addIndexColumn()
                ->make(true);
        }

        return view('user.index');
    }

    public function downloadDoneExcel()
    {
        $month = request()->get('month');
        $year = request()->get('year');

        // Query the data based on filters
        $query = User::select('*')->where('status', 1);
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
    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required'
        ]);

        $user = User::create($attributes);
        auth()->login($user);

        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetail($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Data Tidak Ditemukan'], 404);
        }
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Data Tidak Ditemukan'], 404);
        }
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user  = User::find($id);

        $user->delete();

        return response()->json(['success' => true]);
    }
}
