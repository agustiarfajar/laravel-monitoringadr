<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Date;
use TheSeer\Tokenizer\Exception;
use App\Models\Barang;
use App\Models\PemasokBarang;
use App\Models\PengirimanHo;
use App\Models\Perusahaan;
use App\Models\Ekspedisi;
use App\Exports\LaporanKpiExport;
use Maatwebsite\Excel\Facades\Excel;

use DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Default by months
        $date = Carbon::now()->month;

        $pengirimanHo = DB::table('pengiriman_ho')
                        ->where('status', '=', 'diproses')
                        ->whereMonth('tgl_surat_jalan', $date)
                        ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                        ->count();
        $pengirimanPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'diproses')
                        ->orWhere('status', '=', 'dikirim')
                        ->whereMonth('tgl_surat_jalan', $date)
                        ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                        ->count();
        $pengirimanHoAll = DB::table('pengiriman_ho')
                        ->where('status', '=', 'diproses')
                        ->orWhere('status', '=', 'diterima')
                        ->whereMonth('tgl_surat_jalan', $date)
                        ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                        ->count();
        $pengirimanPemasokAll = DB::table('pemasok_barang')
                        ->where('status', '=', 'diproses')
                        ->orWhere('status', '=', 'dikirim')
                        ->orWhere('status', '=', 'diterima')
                        ->whereMonth('tgl_surat_jalan', $date)
                        ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                        ->count();
        $pengirimanHoKirim = PengirimanHo::where('status', 'dikirim')->get();
        $pengirimanPemasokKirim = PemasokBarang::where('status', 'dikirim')->get();
        $barang = Barang::whereMonth('tgl_kedatangan', Carbon::now()->month)
                        ->whereYear('tgl_kedatangan', Carbon::now()->year)
                        ->get();
        $sisaBarang = DB::table('barang')
                    ->whereMonth('tgl_kedatangan', '=', $date)
                    ->whereYear('tgl_kedatangan', Carbon::now()->year)
                    ->sum('jumlah');

        $pengirimanDiprosesHo = DB::table('pengiriman_ho')
                    ->where('status', '=', 'diproses')
                    ->whereMonth('tgl_surat_jalan', $date)
                    ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                    ->count();
        $pengirimanDiprosesPemasok = DB::table('pemasok_barang')
                    ->where('status', '=', 'diproses')
                    ->whereMonth('tgl_surat_jalan', $date)
                    ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                    ->count();
        $pengirimanHoBelumTerima = DB::table('pengiriman_ho')
                            ->where('status', '=', 'dikirim')
                            ->whereMonth('tgl_surat_jalan', $date)
                            ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                            ->count();
        $pengirimanPemasokBelumTerima = DB::table('pemasok_barang')
                            ->where('status', '=', 'dikirim')
                            ->whereMonth('tgl_kirim_pemasok', $date)
                            ->whereYear('tgl_kirim_pemasok', Carbon::now()->year)
                            ->count();
        $pengirimanBatalHo = DB::table('pengiriman_ho')
                            ->where('status', '=', 'dibatalkan')
                            ->whereMonth('tgl_surat_jalan', $date)
                            ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                            ->count();
        $pengirimanBatalPemasok = DB::table('pemasok_barang')
                            ->where('status', '=', 'dibatalkan')
                            ->whereMonth('tgl_surat_jalan', $date)
                            ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                            ->count();
        $pengirimanHoSudahTerima = DB::table('pengiriman_ho')
                            ->where('status', '=', 'diterima')
                            ->whereMonth('tgl_diterima_site', $date)
                            ->whereYear('tgl_diterima_site', Carbon::now()->year)
                            ->count();   
        $pengirimanPemasokSudahTerima = DB::table('pemasok_barang')
                            ->where('status', '=', 'diterima')
                            ->whereMonth('tgl_diterima_site', $date)
                            ->whereYear('tgl_diterima_site', Carbon::now()->year)
                            ->count();
        $pemasokLaporan = DB::table('pemasok_barang as a')
                            ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                            ->join('ms_ekspedisi as d', 'a.id_ekspedisi', 'd.id')
                            ->join('pemasok_barang_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                            ->select('a.*', 'b.perusahaan', 'c.item', 'c.jumlah', 'c.unit', 'c.nomor_po', 'd.ekspedisi')
                            ->orderBy('a.no_faktur', 'ASC')
                            ->where('status', '=', 'diproses')
                            ->orWhere('status', '=', 'dikirim')
                            ->orWhere('status', '=', 'diterima')
                            ->whereMonth('a.tgl_surat_jalan', $date)
                            ->get();
            
        $hoLaporan = DB::table('pengiriman_ho as a')
                            ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                            ->join('ms_ekspedisi as d', 'a.id_ekspedisi', 'd.id')
                            ->join('pengiriman_ho_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                            ->select('a.*', 'b.perusahaan', 'c.item', 'c.jumlah', 'c.unit', 'c.nomor_po', 'c.pemasok', 'd.ekspedisi')
                            ->orderBy('a.no_faktur', 'ASC')
                            ->where('status', '=', 'diproses')
                            ->orWhere('status', '=', 'dikirim')
                            ->orWhere('status', '=', 'diterima')
                            ->whereMonth('a.tgl_surat_jalan', $date)
                            ->get();
            
        $laporan = $pemasokLaporan->concat($hoLaporan);
        $countLaporan = count($laporan);

        $countBarang = count($barang);
        $countPengiriman = $pengirimanHo + $pengirimanPemasok;
        $countPengirimanAll = $pengirimanHoAll + $pengirimanPemasokAll;
        $countPengirimanDiproses = $pengirimanDiprosesHo + $pengirimanDiprosesPemasok;
        $countPengirimanBelumTerima = $pengirimanHoBelumTerima + $pengirimanPemasokBelumTerima;
        $countPengirimanBatal = $pengirimanBatalHo + $pengirimanBatalPemasok;
        $countTerima = $pengirimanHoSudahTerima + $pengirimanPemasokSudahTerima;

        // total seluruh barang di HO
        $stok_ho = DB::table('barang')
                    ->whereMonth('tgl_kedatangan', Carbon::now()->month)
                    ->whereYear('tgl_kedatangan', Carbon::now()->year)
                    ->sum('jumlah');
        $jml_brg_ho = DB::table('pengiriman_ho_detail as a')
                    ->join('pengiriman_ho as b', 'a.no_faktur', '=', 'b.no_faktur')
                    ->join('barang as c', 'a.id_barang', '=', 'c.id')
                    ->where('b.status', '!=', 'dibatalkan')
                    ->whereMonth('c.tgl_kedatangan', Carbon::now()->month)
                    ->whereYear('c.tgl_kedatangan', Carbon::now()->year)
                    ->sum('a.jumlah');
        
        $countTotalBarangHo = (int) $stok_ho + (int) $jml_brg_ho;
    
        // tgl_kedatangan
        $limaHariLalu = Carbon::now()->subDays(5);      

        $countBarangAging = DB::table('barang')
            ->where('tgl_kedatangan', '<', $limaHariLalu)
            ->whereMonth('tgl_kedatangan', Carbon::now()->month)
            ->whereYear('tgl_kedatangan', Carbon::now()->year)
            ->sum('jumlah');
        // Chart
        $chartProsesHo = DB::table('pengiriman_ho')
                    ->where('status', '=', 'diproses')
                    ->whereMonth('tgl_surat_jalan', $date)
                    ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                    ->count();

        $chartProsesPemasok = DB::table('pemasok_barang')
                    ->where('status', '=', 'diproses')
                    ->whereMonth('tgl_surat_jalan', $date)
                    ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                    ->count();
        $countKirimPemasok = DB::table('pemasok_barang')
                    ->where('status', '=', 'dikirim')
                    ->whereMonth('tgl_kirim_pemasok', $date)
                    ->whereYear('tgl_kirim_pemasok', Carbon::now()->year)
                    ->count();
        $chartTerimaHo = DB::table('pengiriman_ho')
                    ->where('status', '=', 'diterima')
                    ->whereMonth('tgl_diterima_site', $date)
                    ->whereYear('tgl_diterima_site', Carbon::now()->year)
                    ->count();

        $chartTerimaPemasok = DB::table('pemasok_barang')
                    ->where('status', '=', 'diterima')
                    ->whereMonth('tgl_diterima_site', $date)
                    ->whereYear('tgl_diterima_site', Carbon::now()->year)
                    ->count();

        $countProses = $chartProsesHo + $chartProsesPemasok;
        $countTerima = $chartTerimaHo + $chartTerimaPemasok;
        return view('admin.dashboard', compact(
            'countPengiriman', 
            'countPengirimanAll',
            'countBarang', 
            'countTotalBarangHo',
            'sisaBarang', 
            'countPengirimanDiproses', 
            'countPengirimanBelumTerima', 
            'countPengirimanBatal', 
            'countBarangAging',
            'countProses',
            'countKirimPemasok',
            'countTerima',
            'countLaporan'
        ));
    }

    // Update sisa barang ho di dashboard
    public function update_sisa_barang_ho_periode(Request $request)
    {
        $periode = $request->input('periode');

        if($periode == 'today')
        {
            $date = NOW();
            $data = DB::table('barang')
                ->whereDate('tgl_kedatangan', $date)
                ->whereMonth('tgl_kedatangan', Carbon::now()->month)
                ->whereYear('tgl_kedatangan', Carbon::now()->year)
                ->sum('jumlah');
        } else if($periode == 'month')
        {
            $date = Carbon::now()->month;
            $data = DB::table('barang')
                ->whereMonth('tgl_kedatangan', $date)
                ->whereYear('tgl_kedatangan', Carbon::now()->year)
                ->sum('jumlah');
        } else if($periode == 'year')
        {
            $date = Carbon::now()->year;
            $data = DB::table('barang')
                ->whereYear('tgl_kedatangan', $date)
                ->sum('jumlah');
        }
        return response()->json(['status' => 200, 'data' => $data], 200);
    }
    // Update surat jalan di dashboard
    public function update_surat_jalan_periode(Request $request)
    {
        $periode = $request->input('periode');

        if($periode == 'today')
        {
            $date = NOW();

            $pengirimanHoAll = DB::table('pengiriman_ho')
                ->where('status', '=', 'diproses')
                ->orWhere('status', '=', 'diterima')
                ->whereDate('tgl_surat_jalan', $date)
                ->whereMonth('tgl_surat_jalan', Carbon::now()->month)
                ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                ->count();

            $pengirimanPemasokAll = DB::table('pemasok_barang')
                ->where('status', '=', 'diproses')
                ->orWhere('status', '=', 'dikirim')
                ->orWhere('status', '=', 'diterima')
                ->whereDate('tgl_surat_jalan', $date)
                ->whereMonth('tgl_surat_jalan', Carbon::now()->month)
                ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                ->count();

        } else if($periode == 'month')
        {
            $date = Carbon::now()->month;
            
            $pengirimanHoAll = DB::table('pengiriman_ho')
                ->where('status', '=', 'diproses')
                ->orWhere('status', '=', 'diterima')
                ->whereMonth('tgl_surat_jalan', $date)
                ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                ->count();

            $pengirimanPemasokAll = DB::table('pemasok_barang')
                ->where('status', '=', 'diproses')
                ->orWhere('status', '=', 'dikirim')
                ->orWhere('status', '=', 'diterima')
                ->whereMonth('tgl_surat_jalan', $date)
                ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                ->count();
        } else if($periode == 'year')
        {
            $date = Carbon::now()->year;
            $pengirimanHoAll = DB::table('pengiriman_ho')
                ->where('status', '=', 'diproses')
                ->orWhere('status', '=', 'diterima')
                ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                ->count();

            $pengirimanPemasokAll = DB::table('pemasok_barang')
                ->where('status', '=', 'diproses')
                ->orWhere('status', '=', 'dikirim')
                ->orWhere('status', '=', 'diterima')
                ->whereYear('tgl_surat_jalan', $date)
                ->count();
        }

        $data = $pengirimanHoAll + $pengirimanPemasokAll;

        return response()->json(['status' => 200, 'data' => $data], 200);
    }
    // Barang Aging dashboard
    public function update_barang_aging_periode(Request $request)
    {
        $periode = $request->input('periode');
        $barang = Barang::all();
        
        if($periode == 'today')
        {
            $date = NOW();

            $limaHariLalu = Carbon::now()->subDays(5);      

            $data = DB::table('barang')
                ->where('tgl_kedatangan', '<', $limaHariLalu)
                ->whereDate('tgl_kedatangan', $date)
                ->whereMonth('tgl_kedatangan', Carbon::now()->month)
                ->whereYear('tgl_kedatangan', Carbon::now()->year)
                ->sum('jumlah');
        } else if($periode == 'month')
        {
            $date = Carbon::now()->month;

            $limaHariLalu = Carbon::now()->subDays(5);      

            $data = DB::table('barang')
                ->where('tgl_kedatangan', '<', $limaHariLalu)
                ->whereMonth('tgl_kedatangan', $date)
                ->whereYear('tgl_kedatangan', Carbon::now()->year)
                ->sum('jumlah');
        } else if($periode == 'year')
        {
            $date = Carbon::now()->year;


            $limaHariLalu = Carbon::now()->subDays(5);      

            $data = DB::table('barang')
                ->where('tgl_kedatangan', '<', $limaHariLalu)
                ->whereYear('tgl_kedatangan', $date)
                ->sum('jumlah');
        }
        return response()->json(['status' => 200, 'data' => $data], 200);
    }
    // Belum kirim pemasok
    public function update_belum_kirim_pemasok_periode(Request $request)
    {
        $periode = $request->input('periode');

        if($periode == 'today')
        {
            $date = NOW();
            $data = DB::table('pemasok_barang')
                ->where('status', '=', 'diproses')
                ->whereDate('tgl_surat_jalan', $date)
                ->whereMonth('tgl_surat_jalan', Carbon::now()->month)
                ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                ->count();
        } else if($periode == 'month')
        {
            $date = Carbon::now()->month;
            $data = DB::table('pemasok_barang')
                ->where('status', '=', 'diproses')
                ->whereMonth('tgl_surat_jalan', $date)
                ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                ->count();
            
        } else if($periode == 'year')
        {
            $date = Carbon::now()->year;
            $data = DB::table('pemasok_barang')
                ->where('status', '=', 'diproses')
                ->whereYear('tgl_surat_jalan', $date)
                ->count();
            
        }
        return response()->json(['status' => 200, 'data' => $data], 200);
    }
    // Belum terima site dashboard
    public function update_belum_terima_site_periode(Request $request)
    {
        $periode = $request->input('periode');

        if($periode == 'today')
        {
            $date = NOW();
            $pengirimanHoBelumTerima = DB::table('pengiriman_ho')
                                    ->where('status', '=', 'diproses')
                                    ->whereDate('tgl_surat_jalan', $date)
                                    ->whereMonth('tgl_surat_jalan', Carbon::now()->month)
                                    ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                                    ->count();
            $pengirimanPemasokBelumTerima = DB::table('pemasok_barang')
                                        ->where('status', '=', 'dikirim')
                                        ->whereDate('tgl_kirim_pemasok', $date)
                                        ->whereMonth('tgl_kirim_pemasok', Carbon::now()->month)
                                        ->whereYear('tgl_kirim_pemasok', Carbon::now()->year)
                                        ->count();
            $data = $pengirimanHoBelumTerima + $pengirimanPemasokBelumTerima;
            
        } else if($periode == 'month')
        {
            $date = Carbon::now()->month;
            $pengirimanHoBelumTerima = DB::table('pengiriman_ho')
                                    ->where('status', '=', 'diproses')
                                    ->whereMonth('tgl_surat_jalan', $date)        
                                    ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                                    ->count();
            $pengirimanPemasokBelumTerima = DB::table('pemasok_barang')
                                        ->where('status', '=', 'dikirim')
                                        ->whereMonth('tgl_kirim_pemasok', $date)                                        
                                        ->whereYear('tgl_kirim_pemasok', Carbon::now()->year)
                                        ->count();
            $data = $pengirimanHoBelumTerima + $pengirimanPemasokBelumTerima;
            
        } else if($periode == 'year')
        {
            $date = Carbon::now()->year;
            $pengirimanHoBelumTerima = DB::table('pengiriman_ho')
                                    ->where('status', '=', 'diproses')
                                    ->whereYear('tgl_surat_jalan', $date)
                                    ->count();
            $pengirimanPemasokBelumTerima = DB::table('pemasok_barang')
                                        ->where('status', '=', 'dikirim')
                                        ->whereYear('tgl_kirim_pemasok', $date)
                                        ->count();
            $data = $pengirimanHoBelumTerima + $pengirimanPemasokBelumTerima;
        }
        return response()->json(['status' => 200, 'data' => $data], 200);
    }
    // Batal proses dashboard
    public function update_batal_proses_periode(Request $request)
    {
        $periode = $request->input('periode');

        if($periode == 'today')
        {
            $date = NOW();
            $pengirimanBatalHo = DB::table('pengiriman_ho')
                            ->where('status', '=', 'dibatalkan')
                            ->whereDate('tgl_surat_jalan', $date)
                            ->whereMonth('tgl_surat_jalan', Carbon::now()->month)        
                            ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                            ->count();
            $pengirimanBatalPemasok = DB::table('pemasok_barang')
                            ->where('status', '=', 'dibatalkan')
                            ->whereDate('tgl_surat_jalan', $date)
                            ->whereMonth('tgl_surat_jalan', Carbon::now()->month)        
                            ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                            ->count();
            $data = $pengirimanBatalHo + $pengirimanBatalPemasok;
            
        } else if($periode == 'month')
        {
            $date = Carbon::now()->month;
            $pengirimanBatalHo = DB::table('pengiriman_ho')
                            ->where('status', '=', 'dibatalkan')
                            ->whereMonth('tgl_surat_jalan', $date)     
                            ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                            ->count();
            $pengirimanBatalPemasok = DB::table('pemasok_barang')
                            ->where('status', '=', 'dibatalkan')
                            ->whereMonth('tgl_surat_jalan', $date)
                            ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                            ->count();
            $data = $pengirimanBatalHo + $pengirimanBatalPemasok;
            
        } else if($periode == 'year')
        {
            $date = Carbon::now()->year;
            $pengirimanBatalHo = DB::table('pengiriman_ho')
                            ->where('status', '=', 'dibatalkan')
                            ->whereYear('tgl_surat_jalan', $date)
                            ->count();
            $pengirimanBatalPemasok = DB::table('pemasok_barang')
                            ->where('status', '=', 'dibatalkan')
                            ->whereYear('tgl_surat_jalan', $date)
                            ->count();
            $data = $pengirimanBatalHo + $pengirimanBatalPemasok;
        }
        return response()->json(['status' => 200, 'data' => $data], 200);
    }
    // Chart dashboard
public function update_chart_periode(Request $request)
    {
        $periode = $request->input('periode');

        if($periode == 'today')
        {
            $date = NOW();
            $chartProsesHo = DB::table('pengiriman_ho')
                    ->where('status', '=', 'diproses')
                    ->whereDate('tgl_surat_jalan', $date)
                    ->whereMonth('tgl_surat_jalan', Carbon::now()->month)
                    ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                    ->count();

            $chartProsesPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'diproses')
                        ->whereDate('tgl_surat_jalan', $date)
                        ->whereMonth('tgl_surat_jalan', Carbon::now()->month)
                        ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                        ->count();
            $countKirimPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'dikirim')
                        ->whereDate('tgl_kirim_pemasok', $date)
                        ->whereMonth('tgl_kirim_pemasok', Carbon::now()->month)
                        ->whereYear('tgl_kirim_pemasok', Carbon::now()->year)
                        ->count();
            $chartTerimaHo = DB::table('pengiriman_ho')
                        ->where('status', '=', 'diterima')
                        ->whereDate('tgl_diterima_site', $date)
                        ->whereMonth('tgl_diterima_site', Carbon::now()->month)
                        ->whereYear('tgl_diterima_site', Carbon::now()->year)
                        ->count();

            $chartTerimaPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'diterima')
                        ->whereDate('tgl_diterima_site', $date)
                        ->whereMonth('tgl_diterima_site', Carbon::now()->month)
                        ->whereYear('tgl_diterima_site', Carbon::now()->year)
                        ->count();
            $countProses = $chartProsesHo + $chartProsesPemasok;
            $countTerima = $chartTerimaHo + $chartTerimaPemasok;
        } else if($periode == 'month')
        {
            $date = Carbon::now()->month;            
            $chartProsesHo = DB::table('pengiriman_ho')
                    ->where('status', '=', 'diproses')
                    ->whereMonth('tgl_surat_jalan', $date)
                    ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                    ->count();

            $chartProsesPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'diproses')
                        ->whereMonth('tgl_surat_jalan', $date)
                        ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                        ->count();
            $countKirimPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'dikirim')
                        ->whereMonth('tgl_kirim_pemasok', $date)
                        ->whereYear('tgl_kirim_pemasok', Carbon::now()->year)
                        ->count();
            $chartTerimaHo = DB::table('pengiriman_ho')
                        ->where('status', '=', 'diterima')
                        ->whereMonth('tgl_diterima_site', $date)
                        ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                        ->count();

            $chartTerimaPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'diterima')
                        ->whereMonth('tgl_diterima_site', $date)
                        ->whereYear('tgl_surat_jalan', Carbon::now()->year)
                        ->count();
            $countProses = $chartProsesHo + $chartProsesPemasok;
            $countTerima = $chartTerimaHo + $chartTerimaPemasok;
        } else if($periode == 'year')
        {
            $date = Carbon::now()->year;
            $chartProsesHo = DB::table('pengiriman_ho')
                    ->where('status', '=', 'diproses')
                    ->whereYear('tgl_surat_jalan', $date)
                    ->count();

            $chartProsesPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'diproses')
                        ->whereYear('tgl_surat_jalan', $date)
                        ->count();
            $countKirimPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'dikirim')
                        ->whereYear('tgl_kirim_pemasok', $date)
                        ->count();
            $chartTerimaHo = DB::table('pengiriman_ho')
                        ->where('status', '=', 'diterima')
                        ->whereYear('tgl_diterima_site', $date)
                        ->count();

            $chartTerimaPemasok = DB::table('pemasok_barang')
                        ->where('status', '=', 'diterima')
                        ->whereYear('tgl_diterima_site', $date)
                        ->count();
            $countProses = $chartProsesHo + $chartProsesPemasok;
            $countTerima = $chartTerimaHo + $chartTerimaPemasok;
        }
        $data = [$countProses, $countKirimPemasok, $countTerima];
        return response()->json(['status' => 200, 'data' => $data], 200);
    }
    public function adminfaq()
    {
        return view('admin.faq');
    }

    public function suratjalan()
    {
        return view('admin.suratjalan');
    }

    public function adminstatus()
    {
        $pemasok = DB::table('pemasok_barang as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                ->join('ms_ekspedisi as c', 'a.id_ekspedisi', '=', 'c.id')
                ->select('a.*', 'b.perusahaan', 'c.ekspedisi')
                ->orderBy('a.no_faktur', 'DESC')
                ->get();

        $ho = DB::table('pengiriman_ho as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                ->join('ms_ekspedisi as c', 'a.id_ekspedisi', '=', 'c.id')
                ->select('a.*', 'b.perusahaan', 'c.ekspedisi')
                ->orderBy('a.no_faktur', 'DESC')
                ->get();

        $result = $pemasok->concat($ho);

        return view('admin.status', compact('pemasok', 'ho', 'result'));
    }

    public function daftarbarang()
    {
        // $barang = Barang::orderBy('tgl_kedatangan', 'DESC')->get();
        $barang = DB::table('barang as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', '=', 'b.id')
                ->select('a.*', 'b.perusahaan')
                ->orderBy('a.tgl_kedatangan', 'DESC')
                ->get();
    
        return view('admin.item', compact('barang'));
    }

    public function editekspedisi()
    {
        return view('admin.edit-ekspedisi');
    }

    public function additem()
    {
        $perusahaan = Perusahaan::orderBy('perusahaan', 'ASC')->get();
        return view('admin.tambahitem', compact('perusahaan'));
    }

    public function edit_item($id)
    {
        $cek = Barang::findOrFail($id);
        if($cek)
        {
            $perusahaan = Perusahaan::orderBy('perusahaan', 'ASC')->get();
            $barang = Barang::where('id', $id)->first();

            return view('admin.edit-item', compact('barang', 'perusahaan'));
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function simpan_item(Request $request)
    {
        $params = $request->all();
        // dd($params);
        try {
            Barang::create($params);

            return redirect()->to('daftar-barang')->with('success', 'Item berhasil disimpan');
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update_item(Request $request, $id)
    {
        $cek = Barang::findOrFail($id);
        $params = $request->all();
        // dd($params);
        if($cek)
        {
            try {
                $cek->update($params);
    
                return redirect()->to('daftar-barang')->with('success', 'Item berhasil diupdate');
            } catch (\Exception $e) {
                throw new Exception($e->getMessage());
            }
        }        
    }

    public function delete_item($id)
    {
        $cek = Barang::findOrFail($id);

        if($cek)
        {
            try {
                Barang::where('id', $id)->delete();
            } catch (\Exception $e) {
                // Validation failed, handle the error
                return response()->json(['error' => $e->getMessage()], 422);
            }
        } else {
            return redirect()->to('daftarbarang')->with('error', 'Data tidak ditemukan');
        }
    }

    public function detail_pengiriman_site($id)
    {
        $cek = PemasokBarang::findOrFail($id);

        if($cek) 
        {
            $barang = DB::table('pemasok_barang as a')
                    ->join('ms_perusahaan as b', 'a.id_perusahaan', '=', 'b.id')
                    ->join('ms_ekspedisi as c', 'a.id_ekspedisi', '=', 'c.id')
                    ->select('a.*', 'b.perusahaan', 'c.ekspedisi')
                    ->where('a.id', $id)
                    ->first();

            $barang_detail = DB::table('pemasok_barang as a')
                    ->join('pemasok_barang_detail as b', 'a.no_faktur', '=', 'b.no_faktur')
                    ->select('b.*')
                    ->where('a.id', '=', $id)
                    ->get();

            return view('admin.detail', compact('barang', 'barang_detail'));
        }        
        // return view('admin.detail');
    }

    public function detail_pengiriman_ho($id)
    {
        $cek = PengirimanHo::findOrFail($id);

        if($cek) 
        {  
            $barang = DB::table('pengiriman_ho as a')
                    ->join('ms_perusahaan as b', 'a.id_perusahaan', '=', 'b.id')
                    ->join('ms_ekspedisi as c', 'a.id_ekspedisi', '=', 'c.id')
                    ->select('a.*', 'b.perusahaan', 'c.ekspedisi')
                    ->where('a.id', $id)
                    ->first();

            $barang_detail = DB::table('pengiriman_ho as a')
                    ->join('pengiriman_ho_detail as b', 'a.no_faktur', '=', 'b.no_faktur')
                    ->select('b.*')
                    ->where('a.id', '=', $id)
                    ->orderBy('b.tgl_kedatangan', 'ASC')
                    ->get();

            return view('admin.detail_ho', compact('barang', 'barang_detail'));
        }        
        // return view('admin.detail');
    }

    public function update_status_kirim(Request $request, $id)
    {
        $barang = PemasokBarang::findOrFail($id);
        if($barang) 
        {
            try {
                $barang->update([
                    'tgl_kirim_pemasok' => $request->input('tgl_kirim_pemasok'),
                    'status' => 'dikirim',
                ]);
    
                return redirect()->to('adminstatus')->with('success', 'Status berhasil diubah');
            } catch (\Exception $e)
            {
                throw new \Exception($e->getMessage());
            }
        }
    }

    public function update_status_terima(Request $request, $id)
    {
        $barang = PemasokBarang::findOrFail($id);

        if($barang) 
        {
            try {
                $barang->update([
                    'tgl_diterima_site' => $request->input('tgl_diterima_site'),
                    'status' => 'diterima',
                ]);
    
                return redirect()->to('adminstatus')->with('success', 'Status berhasil diubah');
            } catch (\Exception $e)
            {
                throw new \Exception($e->getMessage());
            }
        }
    }

    public function update_status_terima_ho(Request $request, $id)
    {
        $barang = PengirimanHo::findOrFail($id);

        if($barang) 
        {
            try {
                $barang->update([
                    'tgl_diterima_site' => $request->input('tgl_diterima'),
                    'status' => 'diterima',
                ]);
    
                return redirect()->to('adminstatus')->with('success', 'Status berhasil diubah');
            } catch (\Exception $e)
            {
                throw new \Exception($e->getMessage());
            }
        }
    }
    public function update_status_batal_ho(Request $request, $id)
    {
        $ho = PengirimanHo::findOrFail($id);
        $no_faktur = $request->input('no_faktur');
        $getBarang = DB::table('pengiriman_ho_detail as a')
                    ->join('barang as b', 'a.id_barang', '=', 'b.id')
                    ->select('a.id_barang', 'a.jumlah', 'b.jumlah as stok')
                    ->where('a.no_faktur', '=', $no_faktur)
                    ->get();
        if($ho) 
        {
            try {
                $ho->update([
                    'status' => 'dibatalkan',
                ]);

                // Mengembalikan stok barang yang dibatalkan
                foreach($getBarang as $row)
                {
                    $id_barang = $row->id_barang;
                    $jumlah = $row->jumlah;
                    $stok = $row->stok;

                    // Mengembalikan stok barang
                    DB::table('barang')->where('id', $id_barang)->update([
                        'jumlah' => (int) $stok + (int) $jumlah
                    ]);
                }

                return redirect()->to('adminstatus')->with('success', 'Status berhasil diubah');
            } catch (\Exception $e)
            {
                throw new \Exception($e->getMessage());
            }
        }
    }

    public function update_status_batal_pemasok(Request $request, $id)
    {
        $pemasok = PemasokBarang::findOrFail($id);

        if($pemasok) 
        {
            try {
                $pemasok->update([
                    'status' => 'dibatalkan',
                ]);

                return redirect()->to('adminstatus')->with('success', 'Status berhasil diubah');
            } catch (\Exception $e)
            {
                throw new \Exception($e->getMessage());
            }
        }
    }

    // Ekspedisi
    public function view_ekspedisi()
    {
        $ekspedisi = Ekspedisi::orderBy('ekspedisi', 'ASC')->get();
        return view('admin.ekspedisi', compact('ekspedisi'));
    }


    public function save_ekspedisi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ekspedisi' => 'required|string|unique:ms_ekspedisi',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => 'Nama ekspedisi sudah ada'
            ], 422);
        }

        try {
            Ekspedisi::create([
                'ekspedisi' => $request->input('ekspedisi'),
                'pic_eks' => $request->input('pic_eks'),
                'telpon' => $request->input('telpon'),
                'alamat' => $request->input('alamat')
            ]);

            return redirect()->to('ekspedisi')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            // Validation failed, handle the error
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
    public function update_ekspedisi(Request $request, Ekspedisi $ekspedisi, $id)
    {
        $params = $request->all();

        $validator = Validator::make($request->all(), [
            'ekspedisi' => 'required|string|unique:ms_ekspedisi'.',id,'.$ekspedisi->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => 'Nama Ekspedisi sudah ada'
            ], 422);
        }
        
        try {
            Ekspedisi::where('id', $id)->update([
                'ekspedisi' => $request->input('ekspedisi'),
                'pic_eks' => $request->input('pic_eks'),
                'telpon' => $request->input('telpon'),
                'alamat' => $request->input('alamat')
            ]);
            
            return response()->json(['success' => 'Data berhasil diubah'], 200);
            // return redirect()->to('perusahaan')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            // Validation failed, handle the error
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
    public function delete_ekspedisi($id)
    {
        $cek = Ekspedisi::findOrFail($id);

        if($cek)
        {
            try {
                Ekspedisi::where('id', $id)->delete();
            } catch (\Exception $e) {
                // Validation failed, handle the error
                return response()->json(['error' => $e->getMessage()], 422);
            }
        } else {
            return redirect()->to('ekspedisi')->with('error', 'Data tidak ditemukan');
        }
    }

    // Perusahaan
    public function view_perusahaan()
    {
        $perusahaan = Perusahaan::orderBy('perusahaan', 'ASC')->get();
        return view('admin.perusahaan', compact('perusahaan'));
    }

    public function save_perusahaan(Request $request)
    {
        $params = $request->all();

        $validator = Validator::make($request->all(), [
            'perusahaan' => 'required|string|unique:ms_perusahaan',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => 'Nama perusahaan sudah ada'
            ], 422);
        }
        
        try {
            Perusahaan::create([
                'perusahaan' => $params['perusahaan']
            ]);

            return redirect()->to('perusahaan')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            // Validation failed, handle the error
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function update_perusahaan(Request $request, Perusahaan $perusahaan, $id)
    {
        $params = $request->all();

        $validator = Validator::make($request->all(), [
            'perusahaan' => 'required|string|unique:ms_perusahaan'.',id,'.$perusahaan->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => 'Nama perusahaan sudah ada'
            ], 422);
        }
        
        try {
            Perusahaan::where('id', $id)->update([
                'perusahaan' => $request->input('perusahaan')
            ]);
            
            return response()->json(['success' => 'Data berhasil diubah'], 200);
            // return redirect()->to('perusahaan')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            // Validation failed, handle the error
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
    

    public function delete_perusahaan($id)
    {
        $cek = Perusahaan::findOrFail($id);

        if($cek)
        {
            try {
                Perusahaan::where('id', $id)->delete();
            } catch (\Exception $e) {
                // Validation failed, handle the error
                return response()->json(['error' => $e->getMessage()], 422);
            }
        } else {
            return redirect()->to('perusahaan')->with('error', 'Data tidak ditemukan');
        }
    }


    // Laporan
    public function laporan()
    {
        $pemasok = DB::table('pemasok_barang as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                ->join('ms_ekspedisi as d', 'a.id_ekspedisi', 'd.id')
                ->join('pemasok_barang_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                ->select('a.*', 'b.perusahaan', 'c.item', 'c.jumlah', 'c.unit', 'c.nomor_po', 'd.ekspedisi')
                ->orderBy('a.no_faktur', 'ASC')
                ->where('status', '=', 'diproses')
                ->orWhere('status', '=', 'dikirim')
                ->orWhere('status', '=', 'diterima')
                ->get();

        $ho = DB::table('pengiriman_ho as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                ->join('ms_ekspedisi as d', 'a.id_ekspedisi', 'd.id')
                ->join('pengiriman_ho_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                ->select('a.*', 'b.perusahaan', 'c.item', 'c.jumlah', 'c.unit', 'c.nomor_po', 'c.pemasok', 'd.ekspedisi')
                ->orderBy('a.no_faktur', 'ASC')
                ->where('status', '=', 'diproses')
                ->orWhere('status', '=', 'dikirim')
                ->orWhere('status', '=', 'diterima')
                ->get();

        $result = $pemasok->concat($ho);

        // Filter
        if(isset($_GET['start-date']))
        {
            $tgl_mulai = Carbon::parse($_GET['start-date']);
            $tgl_selesai = Carbon::parse($_GET['end-date']);

            $pemasok_filter = DB::table('pemasok_barang as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                ->join('ms_ekspedisi as d', 'a.id_ekspedisi', '=', 'd.id')
                ->join('pemasok_barang_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                ->select('a.tgl_kirim_pemasok', 'a.tgl_surat_jalan', 'a.tgl_diterima_site', 'a.no_faktur', 'a.pemasok',
                        'b.perusahaan', 
                        'c.item', 'c.nomor_po', 'c.jumlah', 'c.unit',
                        'd.ekspedisi')
                ->orderBy('a.no_faktur', 'ASC')
                ->whereBetween('a.tgl_surat_jalan', [$tgl_mulai, $tgl_selesai])
                ->get();

            $ho_filter = DB::table('pengiriman_ho as a')
                    ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                    ->join('ms_ekspedisi as d', 'a.id_ekspedisi', '=', 'd.id')
                    ->join('pengiriman_ho_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                    ->select(DB::raw('NULL as tgl_kirim_pemasok'), 'a.tgl_diterima_site', 'a.tgl_surat_jalan', 'a.no_faktur',
                            'b.perusahaan', 
                            'c.item', 'c.pemasok', 'c.nomor_po', 'c.jumlah', 'c.unit',
                            'd.ekspedisi')
                    ->orderBy('a.no_faktur', 'ASC')
                    ->whereBetween('a.tgl_surat_jalan', [$tgl_mulai, $tgl_selesai])
                    ->get();

            $result_filter = $pemasok_filter->concat($ho_filter);

            return view('admin.laporan', compact('result', 'result_filter'));
        }

        return view('admin.laporan', compact('result'));
    }

    // Laporan
    public function exportDataToCsv()
    {
        $pemasok = DB::table('pemasok_barang as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                ->join('pemasok_barang_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                ->join('ms_ekspedisi as d', 'a.id_ekspedisi', '=', 'd.id')
                ->select('a.tgl_kirim_pemasok', 'a.tgl_surat_jalan', 'a.tgl_diterima_site', 'a.no_faktur', 'a.pemasok',
                        'b.perusahaan', 
                        'c.item', 'c.nomor_po', 'c.jumlah', 'c.unit',
                        'd.ekspedisi')
                ->orderBy('a.no_faktur', 'ASC')
                ->whereMonth('a.tgl_surat_jalan', Carbon::now()->month)
                ->get();

        $ho = DB::table('pengiriman_ho as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                ->join('pengiriman_ho_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                ->join('ms_ekspedisi as d', 'a.id_ekspedisi', '=', 'd.id')
                ->select(DB::raw('NULL as tgl_kirim_pemasok'), 'a.tgl_diterima_site', 'a.tgl_surat_jalan', 'a.no_faktur',
                        'b.perusahaan', 
                        'c.item', 'c.pemasok', 'c.nomor_po', 'c.jumlah', 'c.unit',
                        'd.ekspedisi')
                ->orderBy('a.no_faktur', 'ASC')
                ->whereMonth('a.tgl_surat_jalan', Carbon::now()->month)
                ->get();

        $data = $pemasok->merge($ho);

        // Filter by date
        if(isset($_GET['start-date']))
        {
            $tgl_mulai = Carbon::parse($_GET['start-date']);
            $tgl_selesai = Carbon::parse($_GET['end-date']);

            $pemasok_filter = DB::table('pemasok_barang as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                ->join('ms_ekspedisi as d', 'a.id_ekspedisi', '=', 'd.id')
                ->join('pemasok_barang_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                ->select('a.tgl_kirim_pemasok', 'a.tgl_surat_jalan', 'a.tgl_diterima_site', 'a.no_faktur', 'a.pemasok',
                        'b.perusahaan', 
                        'c.item', 'c.nomor_po', 'c.jumlah', 'c.unit',
                        'd.ekspedisi')
                ->orderBy('a.no_faktur', 'ASC')
                ->whereBetween('a.tgl_surat_jalan', [$tgl_mulai, $tgl_selesai])
                ->get();

            $ho_filter = DB::table('pengiriman_ho as a')
                    ->join('ms_perusahaan as b', 'a.id_perusahaan', 'b.id')
                    ->join('ms_ekspedisi as d', 'a.id_ekspedisi', '=', 'd.id')
                    ->join('pengiriman_ho_detail as c', 'a.no_faktur', '=', 'c.no_faktur')
                    ->select(DB::raw('NULL as tgl_kirim_pemasok'), 'a.tgl_diterima_site', 'a.tgl_surat_jalan', 'a.no_faktur',
                            'b.perusahaan', 
                            'c.item', 'c.pemasok', 'c.nomor_po', 'c.jumlah', 'c.unit',
                            'd.ekspedisi')
                    ->orderBy('a.no_faktur', 'ASC')
                    ->whereBetween('a.tgl_surat_jalan', [$tgl_mulai, $tgl_selesai])
                    ->get();

            $result_filter = $pemasok_filter->concat($ho_filter);

            return Excel::download(new LaporanKpiExport($result_filter), 'laporan_kpi_bulanan_filter.xlsx');
        }

        return Excel::download(new LaporanKpiExport($data), 'laporan_kpi_bulanan.xlsx');
    }
    
}
