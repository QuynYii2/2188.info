<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportFileController extends Controller
{
    public function exportExcel(Request $request)
    {
        $jsonData = $request->input('excel-value');
        $arrayData = json_decode($jsonData, true);
        $writer = SimpleExcelWriter::create(storage_path('app/public/storage.xlsx'));
        $writer->addRows($arrayData);

        return response()->download(storage_path('app/public/storage.xlsx'), 'storage-' . Auth::user()->name . '-' . rand() . '.xlsx')->deleteFileAfterSend();
    }

    public function exportExcelRevenue()
    {
        $writer = SimpleExcelWriter::streamDownload(storage_path('app/public/revenue.xlsx'));
        $user = Auth::user()->id;
        $role_id = DB::table('role_user')->where('user_id', $user)->get();
        $isAdmin = false;
        foreach ($role_id as $item) {
            if ($item->role_id == 1) {
                $isAdmin = true;
            }
        }
        if ($isAdmin){
            $revenue = Revenue::all();
        } else {
            $revenue = Revenue::where('seller_id', $user)->get();
        }
        $writer->addRows($revenue->toArray());
//        $users = Revenue::all();
//        $writer->addRows($users->toArray());

        return  $writer->toBrowser();
    }

    public function exportExcelOrder(Request $request)
    {
        $jsonData = $request->input('excel-value');
        $arrayData = json_decode($jsonData, true);
        $writer = SimpleExcelWriter::create(storage_path('app/public/order.xlsx'));
        $writer->addRows($arrayData);

        return response()->download(storage_path('app/public/order.xlsx'), 'storage-' . Auth::user()->name . '-' . rand() . '.xlsx')->deleteFileAfterSend();
    }
}
