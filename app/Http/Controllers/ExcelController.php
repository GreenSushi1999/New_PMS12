<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function updateExcel()
    {
        // Your existing Excel file path
        $filePath = storage_path('app/public/SampleExcelPMS.xlsx');

        // Load the existing Excel file
        $excel = Excel::load($filePath);

        // Update the desired cell value
        $excel->sheet(0, function ($sheet) {
            $sheet->setCellValue('A7', 'New Value');
        });

        // Save the changes back to the Excel file
        $excel->store('xlsx', storage_path('app/public'));

        return "Excel file updated successfully!";
    }
}
