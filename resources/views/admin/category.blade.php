@extends('layout.app')
@section('content')

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Category</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <!-- Bordered table start -->
        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-content">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">tambah</button>
                                </div>

                            </div>
                            <!-- table bordered -->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAME</th>
                                            <th width="380px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $c)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $c->name }}</td>
                                                <td>
                                                    <button class="btn-edit btn btn-label-warning waves-effect"
                                                        data-id="{{ $c->id }}"
                                                        data-name="{{ $c->name }}">Edit
                                                        {{-- <i class="bi bi-pencil-square"></i> --}}
                                                    </button>
                                                    <button type="button" class="btn btn-label-danger waves-effect btn-delete"
                                                        data-id="{{ $c->id }}">
                                                        Hapus
                                                    </button>


                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="name">Nama Kategori</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tutup</button>
                        <button type="submit" class="btn btn-primary">simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" id="editModal"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label for="name">Nama : </label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="edit-name" name="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tutup</button>
                        <button type="submit" class="btn btn-primary">simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">
                        Hapus Produk
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <form id="deleteForm" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');

            console.log(name);

            // Isi input dalam modal
            $('#edit-name').val(name);
            $('#editModal').modal('show');
            // Set form action agar sesuai dengan kategori yang akan diedit
            $('#editForm').attr('action', '/admin/category/' + id);
        });

        $('.btn-delete').click(function() {
            var id = $(this).data('id');

            $('#deleteModal').modal('show');
            // Set form action agar sesuai dengan kategori yang akan diedit
            $('#deleteForm').attr('action', '/admin/category/' + id);
        });
    });
</script>
@endsection
