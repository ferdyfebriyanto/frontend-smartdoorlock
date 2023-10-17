@extends('layouts.app')

@section('title', 'Advanced Forms')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User Detail</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Users</div>
                </div>
            </div>

            <div class="section-body">
                
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>User Detail : {{ $data['name'] }}</h4>
                            </div>
                            <form action="/user/{{ $data['id'] }}/edit" id="edit-form-{ $data['id'] }}/" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                    <div class="form-group">
                                    <label>ID</label>
                                    <input type="text"
                                        class="form-control" name="id" value="{{ $data['id'] }}" disabled>
                                    </div>

                                    <div class="form-group">
                                    <label>Name</label>
                                    <input type="text"
                                        class="form-control" name="name" value="{{ $data['name'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text"
                                            class="form-control" name="email" value="{{ $data['email'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input type="text"
                                                class="form-control phone-number" name="phone" value="{{ $data['phone'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Job</label>
                                        <input type="text" class="form-control" name="job" value="{{ $data['job'] }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Face</label><br>
                                        <input type="file"
                                            class="form-control" name="image" src="{{$data['image']}}">
                                        <img src="{{$data['image']}}" alt="gambar wajah" width="100px">
                                    </div>
                                    <div class="form-group">
                                    <a href="/users" class="btn btn-primary">Back</a>
                                    </div>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection



                                        

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
