<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\ExcelImportJob;
use App\Imports\QuestionImport;
use App\Http\Controllers\Controller;

class ExcelController extends Controller
{
    public function index(){

        return view('home');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx'
        ]);

        $excelFile = $request->file('excel_file')->store('import');

        $import = new QuestionImport;
        $import->import($excelFile);
        if($import->failures()->isNotEmpty()){
            return back()->withFailures($import->failures());
        }
        return back()->with('success', 'All good!');

    }
}
