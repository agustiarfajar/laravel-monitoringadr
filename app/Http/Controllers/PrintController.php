<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PemasokBarang;
use App\Models\PemasokBarangDetail;
use App\Models\PengirimanHo;
use App\Models\PengirimanHoDetail;
use App\Models\Ekspedisi;
use Illuminate\Http\Request;
use PDF;
use DB;

class PrintController extends Controller
{
    public function print($id)
    {
        $cek = PemasokBarang::findOrFail($id);

        if($cek) 
        {
            $barang = DB::table('pemasok_barang as a')
                    ->join('ms_perusahaan as b', 'a.id_perusahaan', '=', 'b.id')
                    ->join('ms_ekspedisi as c', 'a.id_ekspedisi', '=', 'c.id')
                    ->select('a.*', 'b.perusahaan', 'c.ekspedisi', 'c.alamat', 'c.pic_eks', 'c.telpon as telpon_eks')
                    ->where('a.id', $id)
                    ->first();

            $barang_detail = DB::table('pemasok_barang as a')
                    ->join('pemasok_barang_detail as b', 'a.no_faktur', '=', 'b.no_faktur')
                    ->select('b.*')
                    ->orderBy('b.nomor_po', 'ASC')
                    ->where('a.id', '=', $id)
                    ->get();

            $barangChunks = array_chunk($barang_detail->toArray(), 10);

            
            $pdf = PDF::loadView('admin.print', compact('barang', 'barang_detail', 'barangChunks'))
                ->setPaper('a4', 'portrait');
            $tanggal = now()->format('Ymd'); // Mendapatkan tanggal saat ini dalam format Ymd (misal: 20230803)
            $namaFile = 'Surat_Penyerahan_' . $tanggal . '.pdf';
            return $pdf->download($namaFile);
        }
    }

    public function print_ho($id)
    {
        $cek = PengirimanHo::findOrFail($id);

        if($cek) 
        {  
            $barang = DB::table('pengiriman_ho as a')
                    ->join('ms_perusahaan as b', 'a.id_perusahaan', '=', 'b.id')
                    ->join('ms_ekspedisi as c', 'a.id_ekspedisi', '=', 'c.id')
                    ->select('a.*', 'b.perusahaan', 'c.ekspedisi', 'c.pic_eks', 'c.telpon as telpon_eks')
                    ->where('a.id', $id)
                    ->first();

            $barang_detail = DB::table('pengiriman_ho as a')
                    ->join('pengiriman_ho_detail as b', 'a.no_faktur', '=', 'b.no_faktur')
                    ->select('b.*')
                    ->where('a.id', '=', $id)
                    ->orderBy('b.nomor_po', 'ASC')
                    ->orderBy('b.tgl_kedatangan', 'ASC')
                    ->get();

            $barangChunks = array_chunk($barang_detail->toArray(), 10);


            $pdf = PDF::loadView('admin.printho', compact('barang', 'barang_detail', 'barangChunks'))
                ->setPaper('a4', 'portrait');
            $tanggal = now()->format('Ymd'); // Mendapatkan tanggal saat ini dalam format Ymd (misal: 20230803)
            $namaFile = 'Surat_Pengiriman_' . $tanggal . '.pdf';
            return $pdf->download($namaFile);
        }        
    }

    public function adminfaq()
    {
        $data = ['row' => 1, 'barang' => 2];
        $pdf = PDF::loadView('admin.print', $data);
        return $pdf->download('suratjalan.pdf');
    }
}