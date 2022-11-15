@extends('layouts.app')

@section('title')
    Data Kandidat
@endsection

@section('judul')
    Kandidat {{$kandidat->id}}
@endsection

@push('css')
  <link rel="stylesheet" href="{{asset('assets/node_modules/summernote/dist/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('assets/node_modules/selectric/public/selectric.css')}}">
  <link rel="stylesheet" href="{{asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">
@endpush

@push('js')
  <script src="{{asset('assets/node_modules/summernote/dist/summernote-bs4.js')}}"></script>
  <script src="{{asset('assets/node_modules/selectric/public/jquery.selectric.min.js')}}"></script>
  <script src="{{asset('assets/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js')}}"></script>
  <script src="{{asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
  <script src="{{asset('assets/js/page/features-post-create.js')}}"></script>
@endpush

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Data Kandidat {{$kandidat->id}}</h4>
        </div>
        <form action="{{ route('kandidat.update', $kandidat->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Ketua</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control" name="ketua" value="{{$kandidat->ketua}}">
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Wakil</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control" name="wakil" value="{{$kandidat->wakil}}">
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
              <div class="col-sm-12 col-md-7">
                <textarea class="summernote-simple" name="deskripsi">{{$kandidat->deskripsi}}</textarea>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Update Gambar Kandidat</label>
              <div class="col-sm-12 col-md-7">
                <div id="image-preview" class="image-preview">
                  <label for="image-upload" id="image-label">Choose File</label>
                  <input type="file" name="image" id="image-upload"/>
                </div>
              </div>
            </div>
            {{-- <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Update Gambar Kandidat</label>
              <div class="col-sm-12 col-md-7">
                <img id="preview-image-before-upload" class="img-fluid col-sm-5">
                
                <input type="file" name="image" placeholder="Choose image" id="image">
              </div>
            </div> --}}
            {{-- @if ($kandidat->image)
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar Kandidat</label>
              <div class="col-sm-12 col-md-7">
                <div id="image-preview" class="image-preview">
                  <img src="{{Asset('storage/' . $kandidat->image)}}" width="100%"/>
                </div>
              </div>
            </div>
            @endif
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Update Gambar Kandidat</label>
              <div class="col-sm-12 col-md-7">
                <div id="image-preview" class="image-preview">
                  <label for="image-upload" id="image-label">Choose File</label>
                  <input type="file" name="image" id="image-upload"/>
                </div>
              </div>
            </div> --}}
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
              <div class="col-sm-12 col-md-7">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{asset('assets/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>
  
  @if(count($errors)>0)
  swal('Gagal!', 'Data Harus Diisi!', 'error');
  @endif
  $(document).ready(function (e) {
 
   
 $('#image').change(function(){
          
  let reader = new FileReader();

  reader.onload = (e) => { 

    $('#preview-image-before-upload').attr('src', e.target.result); 
  }

  reader.readAsDataURL(this.files[0]); 
 
 });
 
});
</script>
@endpush