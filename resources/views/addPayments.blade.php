@extends('payments')
@section('content')
    <div class="col-6">
        <div class="card text-center">
            <div class="card-header">
                Tambah Data
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="fa fa-check-circle"></i> Data Berhasil Disimpan!
                </div>
            @endif
            <div class="card-body">
                <form action="{{route('payment.store')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <input type="text" name="name" class="col-sm-10">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</buton>
                </form>
            </div>
        </div>
    </div>
@endsection