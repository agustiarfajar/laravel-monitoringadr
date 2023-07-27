<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PemasokBarang;
use App\Models\PemasokBarangDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use DB;

class PrintController extends Controller
{
    public function print($id)
    {
        $cek = PemasokBarang::findOrFail($id);
        //$params = $request->all();
         // dd($params);
        //$brg = $params['id_barang'];

        if($cek) 
        {
            $barang = DB::table('pemasok_barang as a')
                    ->join('ms_perusahaan as b', 'a.id_perusahaan', '=', 'b.id')
                    ->select('a.*', 'b.perusahaan')
                    ->where('a.id', $id)
                    ->first();

            $barang_detail = DB::table('pemasok_barang as a')
                    ->join('pemasok_barang_detail as b', 'a.no_faktur', '=', 'b.no_faktur')
                    ->select('b.*')
                    ->where('a.id', '=', $id)
                    ->get();

        //for($i = 0; $i < count($brg); $i++) 
        //{
        //    $res_detail = PemasokBarangDetail::create([
        //        'no_faktur' => $no_faktur,
        //        'user' => $params['user'][$i],
        //        'supplier' => $params['supplier'][$i],
        //        'item' => $params['item'][$i],
        //        'jumlah' => $params['jumlah'][$i],
        //        'unit' => $params['unit'][$i],
        //        'nomor_po' => $params['nomor_po'][$i]
        //    ]);
        //}
            //$data_detail = [
            //    'item'=>$barang_detail->first()->item
            //];
            $barang_detail = $barang_detail->toArray();
            $data = [
                'barang_detail' => $barang_detail,
                'barang'=> $barang
            ];
            // dd();
            //dd($barang_detail);
            $data = ['row' => 1, 'barang' => $barang];
            $pdf = PDF::loadView('admin.print', $data);
            return $pdf->download('suratjalan.pdf');
            // return view('data.print_ho');
            // return view('admin.detail_ho', compact('barang', 'barang_detail'));
           
            
            Pdf::loadView('admin.print', $data);
        }
    }

    public function adminfaq()
    {
        $data = ['row' => 1, 'barang' => 2];
        $pdf = PDF::loadView('admin.print', $data);
        return $pdf->download('suratjalan.pdf');
    }

    //public function adminfaq()
    //{
    //    $data = ['row' => 1, 'barang' => 2];
    //    $pdf = Pdf::loadView('admin.print', $data);
    //    $pdf ->set_option('chroot', realpath(''));
    //    $pdf ->set_option('isHtml5ParserEnabled', true);
    //    $pdfContent = $pdf->output(); // generate the PDF content as a string
    //    return response($pdfContent, 200, [
    //        'Content-Type' => 'application/pdf',
    //        'Content-Disposition' => 'inline; filename="surat_jalan.pdf"',
    //    ]);
    //}
}