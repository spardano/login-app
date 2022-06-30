@extends('layouts.master')

@section('main-content') 

<div class="card">
    <div class="card-body">

        <div class="row">
            <!-- ICON BG -->
            @role('admin || adminkelurahan || pejabat')
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Business-Man"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Data Penduduk</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $penduduk }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Data Pengguna</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $users }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Pen-2"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Pejabat Kelurahan</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $pejabat }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endrole

            @role('admin')
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Building"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Data Kelurahan</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $kelurahan }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Checked-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Data Roles User</p>
                            <p class="text-primary text-24 line-height-1 mb-2">80</p>
                        </div>
                    </div>
                </div>
            </div>
            @endrole

            @role('adminkelurahan')
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-File"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Pengajuan Surat</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $suratumum }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endrole    

            @role('pejabat')
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Download"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Surat Masuk</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $suratkepejabat }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
</div>


@endsection
