@extends('layout.app')
@section('content')

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Produk</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
                                    <a href="{{ route('admin.product.create') }}" type="button" class="btn btn-primary waves-effect waves-light mb-3">tambah</a>
                                </div>

                            </div>
                            <!-- table bordered -->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>PRODUK DETAIL</th>
                                            <th>BERAT</th>
                                            <th>HARGA</th>
                                            <th>KATEGORI</th>
                                            <th>STOK</th>
                                            <th>PHOTO</th>
                                            <th >AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->name }}</td>
                                                <td>{{ $p->product_detail }}</td>
                                                <td>{{ $p->weight }}</td>
                                                <td>{{ $p->price }}</td>
                                                <td>{{ $p->category->name }}</td>
                                                <td>{{ $p->stock }}</td>
                                               <td>
                                                    @empty($p->photo)
                                                    <img src="{{url('image/nophoto.jpg')}}"
                                                        alt="project-image" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                                                    @else
                                                    <img src="{{ asset('storage/'. $p->photo) }}"
                                                        alt="project-image" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                                                    @endempty
                                                </td>
                                                <td>
                                                    <a class="btn-edit btn btn-label-warning waves-effect" href="{{ route('admin.product.edit', $p->id) }}"
                                                    {{-- data-id="{{ $p->id }}"
                                                    data-name="{{ $p->name }}"
                                                    data-product_detail="{{ $p->product_detail }}"
                                                    data-weight="{{ $p->weight }}"
                                                    data-price="{{ $p->price }}"
                                                    data-photo="{{ $p->photo }}"
                                                    data-stock="{{ $p->stock }}"
                                                    data-category="{{ $p->category_id }}" --}}
                                                    >
                                                    Edit
                                                </a>
                                                    <button type="button" class="btn btn-label-danger waves-effect btn-delete"
                                                        data-id="{{ $p->id }}">
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
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="product_detail" class="form-label">Produk detail</label>
                            <textarea class="form-control @error('product_detail') is-invalid @enderror" name="product_detail">{{ old('product_detail') }}</textarea>
                            @error('product_detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="weight" class="form-label">Berat</label>
                            <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}">
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                <option value="" {{ old('category_id') ? '' : 'selected' }}>- Select Category -</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
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

    {{-- <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" id="editModal"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label for="edit-name">Nama Produk:</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="edit-product_detail">Detail Produk:</label>
                        <textarea class="form-control" id="edit-product_detail" name="product_detail"></textarea>
                        @error('product_detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="edit-weight">Berat:</label>
                        <input type="number" class="form-control" id="edit-weight" name="weight">
                        @error('weight')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="edit-price">Harga:</label>
                        <input type="number" class="form-control" id="edit-price" name="price">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="edit-stock">Stok:</label>
                        <input type="number" class="form-control" id="edit-stock" name="stock">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="edit-category">Kategori:</label>
                        <select class="form-control" id="edit-category" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="edit-photo">Foto Produk:</label>
                        <input type="file" class="form-control" id="edit-photo" name="photo">
                        <img id="edit-photo-preview" class="rounded mt-2" style="width: 100px; height: auto;">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

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
        // $('.btn-edit').click(function() {
        //     var id = $(this).data('id');
        //     var name = $(this).data('name');
        //     var product_detail = $(this).data('product_detail');
        //     var weight = $(this).data('weight');
        //     var price = $(this).data('price');
        //     var photo = $(this).data('photo');
        //     var stock = $(this).data('stock');
        //     var category_id = $(this).data('category');

        //     console.log("Edit Produk:", name);

        //     // Isi input dalam modal
        //     $('#edit-name').val(name);
        //     $('#edit-product_detail').val(product_detail);
        //     $('#edit-weight').val(weight);
        //     $('#edit-price').val(price);
        //     $('#edit-stock').val(stock);
        //     $('#edit-category').val(category_id);

        //     // Menampilkan foto yang sudah ada jika tersedia
        //     if (photo) {
        //         $('#edit-photo-preview').attr('src', '/storage/' + photo);
        //     } else {
        //         $('#edit-photo-preview').attr('src', '/images/nophoto.jpg');
        //     }

        //     $('#editModal').modal('show');

        //     // Set form action untuk update produk
        //     $('#editForm').attr('action', '/admin/product/' + id);
        // });


        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            console.log("Hapus Produk ID:", id);

            $('#deleteModal').modal('show');
            $('#deleteForm').attr('action', '/admin/product/' + id);
        });
    });
</script>
@endsection
