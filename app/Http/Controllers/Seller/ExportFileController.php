<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportFileController extends Controller
{
    public function exportExcel()
    {
        $writer = SimpleExcelWriter::create(storage_path('app/public/users.xlsx'));

        $users = Product::all();

        $writer->addRows($users->toArray());

        return response()->download(storage_path('app/public/users.xlsx'))->deleteFileAfterSend();
    }

}
