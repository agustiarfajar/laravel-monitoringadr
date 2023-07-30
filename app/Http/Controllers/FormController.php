<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\PemasokBarang;
use App\Models\PemasokBarangDetail;
use App\Models\PengirimanHo;
use App\Models\PengirimanHoDetail;
use DB;
use Illuminate\Support\Facades\Date;
use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Arr;
use App\Models\Perusahaan;
use App\Models\Ekspedisi;

class FormController extends Controller
{
    private function noPemasokOtomatis(){
        $kode = "SP/".date('Y').'/';
        $currentKode = date('Y');
        $lastDigit = DB::table('pemasok_barang')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(no_faktur, 9, 6)), 0)+1 digit"))
            ->where(DB::raw("SUBSTRING(no_faktur, 4, 4)"), '=', $currentKode)
            ->first();
        $lastDigit = json_decode(json_encode($lastDigit), true);

        $kode .= sprintf("%04s", $lastDigit['digit']);

        return $kode;
    }

    private function noPengirimanOtomatis(){
        $kode = "SJ/".date('Y').'/';
        $currentKode = date('Y');
        $lastDigit = DB::table('pengiriman_ho')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(no_faktur, 9, 6)), 0)+1 digit"))
            ->where(DB::raw("SUBSTRING(no_faktur, 4, 4)"), '=', $currentKode)
            ->first();
        $lastDigit = json_decode(json_encode($lastDigit), true);

        $kode .= sprintf("%04s", $lastDigit['digit']);

        return $kode;
    }
    public function index()
    {
        $ekspedisi = Ekspedisi::orderBy('ekspedisi', 'ASC')->get();
        $perusahaan = Perusahaan::orderBy('perusahaan', 'ASC')->get();
        return view('form.form_pemasok', compact('perusahaan', 'ekspedisi'));
    }

    public function get_item(Request $request)
    {   
        $perusahaan = $request->input('perusahaan');

        $item = DB::table('barang as a')
                ->join('ms_perusahaan as b', 'a.id_perusahaan', '=', 'b.id')
                ->select('a.*', 'b.perusahaan')
                ->where('a.id_perusahaan', '=', $perusahaan)
                ->where('a.jumlah', '>', 0)
                ->get();

        return response()->json(['data' => $item]);
        
    }

    public function index2()
    {
        $perusahaan = Perusahaan::orderBy('perusahaan', 'ASC')->get();
        $ekspedisi = Ekspedisi::orderBy('ekspedisi', 'ASC')->get();
        return view('form.form_ho', compact('perusahaan', 'ekspedisi'));
    }

    public function form()
    {
        return view('form.first');
    }

    public function save_barang(Request $request)
    {
        $params = $request->all();
         // dd($params);
        $brg = $params['id_barang'];
        $no_faktur = $this->noPemasokOtomatis();
        try {
            // Store ke tabel barang
            $res = PemasokBarang::create([
                'no_faktur' => $no_faktur,
                'id_perusahaan' => $params['id_perusahaan'],
                'pic' => $params['pic'],
                'id_ekspedisi' => $params['id_ekspedisi'],
                'pemasok' => $params['pemasok'],
                // 'alamat' => $params['alamat'],
                'telpon' => $params['telpon'],
                'status' => 'diproses',
                'tgl_surat_jalan' => Date::now(),
            ]);

            // Store ke tabel detail barang
            for($i = 0; $i < count($brg); $i++) 
            {
                $res_detail = PemasokBarangDetail::create([
                    'no_faktur' => $no_faktur,
                    'user' => $params['user'][$i],
                    'item' => $params['item'][$i],
                    'jumlah' => $params['jumlah'][$i],
                    'unit' => $params['unit'][$i],
                    'nomor_po' => $params['nomor_po'][$i]
                ]);
            }

            return redirect()->to('adminstatus')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function simpan_pengiriman_ho(Request $request)
    {
        $params = $request->all();
        // dd($params);    
        
        $no_faktur = $this->noPengirimanOtomatis();

        if(Arr::has($params, 'id_barang'))
        {
            $brg = $params['id_barang'];
            try {
                // Store ke tabel barang
                $res = PengirimanHo::create([
                    'no_faktur' => $no_faktur,
                    'id_perusahaan' => $params['id_perusahaan'],
                    'pic' => $params['pic'],
                    'id_ekspedisi' => $params['id_ekspedisi'],
                    'status' => 'diproses',
                    'tgl_surat_jalan' => Date::now(),
                ]);
    
                // Store ke tabel detail barang
                for($i = 0; $i < count($brg); $i++) 
                {
                    $res_detail = PengirimanHoDetail::create([
                        'no_faktur' => $no_faktur,
                        'user' => $params['user'][$i],
                        'pemasok' => $params['pemasok'][$i],
                        'id_barang' => $params['id_barang'][$i],
                        'item' => $params['item'][$i],
                        'unit' => $params['unit'][$i],
                        'jumlah' => $params['jumlah'][$i],
                        'nomor_po' => $params['nomor_po'][$i],
                        'tgl_kedatangan' => $params['tgl_kedatangan'][$i],
                    ]);
    
                }
    
                $barang = DB::table('barang')->whereIn('id', $params['id_barang'])->get();
                $i = 0;
                foreach($barang as $row)
                {
                    $stok = $row->jumlah;
                    $jml_kirim = $params['jumlah'][$i];
    
                    DB::table('barang')->where('id', $params['id_barang'][$i])->update([
                        "jumlah"=> (int) $stok - (int) $jml_kirim
                    ]);

                    // hapus barang ketika stok 0
                    // DB::table('barang')
                    //     ->where('id', $params['id_barang'][$i])
                    //     ->where('jumlah', '=', 0)
                    //     ->delete();
    
                    $i++;
                }
    
                return redirect()->to('adminstatus')->with('success', 'Data berhasil disimpan');
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        } else {
            return redirect()->to('adminstatus')->with('error', 'Data gagal disimpan, data barang tidak ada');
        }
        
    }

    public function reset()
    {
        // Menghapus data yang ditampilkan di tabel
        FormData::query()->delete();

        return redirect()->route('form.form_pemasok');
    }

    public function deleteData($id)
    {
        // Lakukan tindakan penghapusan data berdasarkan ID yang diterima
        // Contoh menggunakan Eloquent ORM pada Laravel:
        FormData::where('id', $id)->delete();
        // Anda dapat menyesuaikan logika penghapusan data sesuai dengan kebutuhan Anda
    
        // Setelah berhasil menghapus data, Anda dapat mengembalikan respons atau melakukan tindakan lain yang diperlukan
        return response()->json(['message' => 'Data berhasil dihapus']);
    }





}

