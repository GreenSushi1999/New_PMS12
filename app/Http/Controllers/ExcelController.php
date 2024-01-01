<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function updateExcel()
    {
        // Your existing Excel file path
        $filePath = storage_path('app/public/pms/ranksample.xls');

        // Load the existing Excel file
        $excel = Excel::load($filePath);

        // Update the desired cell value
        $excel->sheet(0, function ($sheet) {
            $sheet->setCellValue('C6', 'New Valuesss');
        });

        // Save the changes back to the Excel file
        $excel->store('xls', storage_path('app/public/pms'));

        return "Excel file updated successfully!";
    }

//     public function updateExcel()
// {
//     // Your existing Excel file path
//     $originalFilePath = storage_path('app/public/rank.xls');

//     // Generate a new file name for the duplicated Excel file
//     $newFileName = 'DuplicatedExcel_' . now()->format('Ymd_His') . '.xls';

//     // Set the path for the new Excel file
//     $newFilePath = storage_path('app/public/' . $newFileName);

//     // Copy the existing Excel file to the new location
//     copy($originalFilePath, $newFilePath);

//     return "Excel file duplicated successfully!";
// }

}
