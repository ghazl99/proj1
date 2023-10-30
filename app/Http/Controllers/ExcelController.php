<?php

namespace App\Http\Controllers;

use App\Models\Excel;
use Illuminate\Http\Request;
class ExcelController extends Controller
{
    public function index() {
        return view('excel.form');
    }
    public function importFile(Request $request)
    {

        $request->validate([
            'file'=> 'required|mimes:xls,xlsx,csv'
        ]);
        $path=$request->file('file')->getRealPath();
        $data=Excel::Load($path)->get();
        dd($data);
        $data=$data->toArray();
        foreach($data as $value)
        {
            $result[]=$value;
        }
        return view('excel.form',compact('result'));
    }
}
