@if (session('success'))
    <div class="alert alert-card alert-success" role="alert">
        <strong class="text-capitalize">Sukses!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
@if (session('failed'))
<div class="alert alert-card alert-danger" role="alert">
    <strong class="text-capitalize">Gagal!</strong> {{ session('failed') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif


