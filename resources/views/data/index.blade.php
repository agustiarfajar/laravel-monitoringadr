@extends('admin.master')

@section('sidebar')
@endsection

@section('content')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail DO</h5>
                    
                    <div class="card-body">
                        @foreach($data as $item)
                        <div class="row">
                        <div class="col-lg-3 col-md-4 "><b>Nama Perusahaan</b></div>
                        <div class="col-lg-9 col-md-8">{{ $item->perusahaan }}</div>
                        </div>

                        <div class="row">
                        <div class="col-lg-3 col-md-4 "><b>Person In Charge</b></div>
                        <div class="col-lg-9 col-md-8">{{ $item->pic }}</div>
                        </div>

                        <div class="row">
                        <div class="col-lg-3 col-md-4 "><b>Ekspedisi</b></div>
                        <div class="col-lg-9 col-md-8">{{ $item->ekspedisi }}</div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User Purchase</th>
                                    <th>Pemasok</th>
                                    <th>Item Barang</th>
                                    <th>Jumlah</th>
                                    <th>Unit</th>
                                    <th>Nomor PO/PR</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody id="table-body">
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->user }}</td>
                                    <td>{{ $item->suplier }}</td>
                                    <td>{{ $item->item }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ $item->nomor }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{  url()->previous() }}"><i class="bi bi-arrow-left">Kembali</i></a>
@endsection