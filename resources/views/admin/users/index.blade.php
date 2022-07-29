@extends('layouts.master')

@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content') 

<div class="card">
  <div class="card-body">
    <h3 style="text-align: center">DATA USERS</h3>
    <div style="margin-bottom: 20px; margin-top:20px">
      <button type="button" class="btn btn-info" id="btn-modal-add-user"><i class="bi bi-person-plus-fill">Tambah</i></button>
    </div>
    <div class="table-responsive">
      <table class="table table-striped" id="userTable">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Email</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelurahan</th>
            <th scope="col" >Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $index => $item  )
          <tr>
            <td scope="row">{{ $index + 1}}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->kelurahan->nama_kel_desa }}</td>
            <td>
              <a href=# type="button" class="btn btn-primary btn-sm "><i class="bi bi-diagram-3"></i>Show</a> 
              <button type="button" class="btn btn-info btn-sm btn-edit-user" id="btnEditUser" data-item="{{ $item }}"><i class="bi bi-pencil-square"></i> Edit</button>
              <a href="users/delete/{{ $item->id }}" type="button" class="btn btn-danger btn-sm" ><i class="bi bi-backspace"></i>Delete</a>
            </td>
          </tr>
          @endforeach   
        </tbody>
      </table>  
  
    </div>
  </div>
</div>

<!-- Modal Tambah Users -->
<div class="modal fade " id="tambahusers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="btn btn-warning"  onclick="dismissModal()"><i class="bi bi-box-arrow-in-left"></i>Close</button>
            </div>
            <div class="modal-body">
                <div>
                  <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <table style="width: 100%">
                        <tr>
                            <td >Nama  </td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="name"></td>
                        </tr>
                        <tr>
                          <td >NIK  </td>
                          <td>:</td>
                          <td><input type="nik" class="form-control" name="nik"></td>
                      </tr>
                        <tr>
                            <td >Email  </td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="email"></td>
                        </tr>
                        <tr> 
                            <td >Password</td>
                            <td>:</td>
                            <td><input type="password" class="form-control" name="password"></td>
                        </tr>
                        <tr>
                          <td>Roles</td>
                          <td>:</td>
                          <td>
                            <select name="role" class="form-control" id="role">
                              @foreach ($role as $item)
                                <option value='{{ $item->id }}'>{{ $item->name }}</option>
                              @endforeach
                            </select>
                          </td>                         
                        </tr>
                        <tr id="kel">
                          <td>Kelurahan</td>
                          <td>:</td>
                          <td>
                            <select name="id_kel_desa" class="form-control" required>
                              @foreach ($kelurahan as $row)
                                <option value='{{ $row->id }}'>{{ $row->nama_kel_desa }}</option>
                              @endforeach
                            </select>
                          </td>                         
                        </tr>
                    </table>
                </div>
            </div> 
            <div class="modal-footer bg-danger">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
    </div>
</div>
<!-- End Tambah Users -->

<!-- Modal Edit Users -->
<div class="modal fade " id="editusers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn btn-warning btn-sm"  onclick="dismissModal()"><i class="bi bi-box-arrow-in-left"></i> Close</button>
            </div>
            <div class="modal-body">
                <div>
                  <form id="edit_user_form" action="{{ route('users.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <table style="width: 100%">
                        <tr>
                            <td >Nama  </td>
                            <td>:</td>
                            <td><input type="text" name="name" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td >Email</td>
                            <td>:</td>
                            <td><input type="text"  name="email" class="form-control" required></td>
                        </tr>
                        <tr>
                          <td>Roles</td>
                          <td>:</td>
                          <td>
                            <select name="role" class="form-control" id="role" required>
                              @foreach ($role as $item)
                                 <option value='{{ $item->id }}'>{{ $item->name }}</option>
                              @endforeach
                            </select>
                          </td>                         
                        </tr>
                        <tr id="kel">
                          <td>Kelurahan</td>
                          <td>:</td>
                          <td>
                            <select name="id_kel_desa" class="form-control" required>
                                @foreach ($kelurahan as $row)
                                  <option value='{{ $row->id }}'>{{ $row->nama_kel_desa }}</option>
                                @endforeach
                            </select>
                          </td>                         
                        </tr>
                        <tr style="visibility: hidden"> 
                          <td >Password</td>
                          <td>:</td>
                          <td><input type="hidden" name="password"  required></td>
                        </tr>
                    </table>
                </div>
            </div> 
            <div class="modal-footer bg-danger">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
    </div>
</div>
<!-- End Edit Users -->

@endsection

<!-- JS -->
@section('bottom-js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready( function () {

      $('#userTable').DataTable();

    });

    $('.btn-edit-user').on('click', function () {
      
      item = $(this).data('item');

      $('#edit_user_form input[name="id"]').val(item.id);
      $('#edit_user_form input[name="name"]').val(item.name);
      $('#edit_user_form input[name="email"]').val(item.email);
      $('#edit_user_form select[name="role"]').val(item.roleuser.id).change();
      $('#edit_user_form select[name="id_kel_desa"]').val(item.kelurahan.id).change();
      $('#editusers').modal('show');

    });

    $('#btn-modal-add-user').on('click', function(){
      $('#tambahusers').modal('show');
    })
    

    function dismissModal(){
        $('#editusers').modal('hide');
        $('#tambahusers').modal('hide');
    };

</script>
<!-- END JS -->

@endsection