@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12 mb-5">
            <h2><strong>Edit your profile here</strong></h2>
        </div>
        <div class="col-md-3 mb-5">
            <div id="uploadlah" style="cursor:pointer;width: 100%;padding: 3.5rem;height: auto;border-radius: 3rem;background: #ddd;text-align-last: center;font-weight: bold;font-size: 5rem;">
                <span onclick="click_gambar()">+</span>
            </div>
            <div class="text-center mt-2">
                <strong>Add your photo here</strong>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-8">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <b-form method="POST" enctype="multipart/form-data" action="{{ route('update') }}">
                @csrf
                <input type="file" name="file" id="file" accept="image/jpg,image/png" onchange="preview_image(event)" hidden />
                <b-form-group label="Name">
                    <b-input type="text" name="name" placeholder="Name" value="{{ Auth::user()->name}}" />
                </b-form-group>
                <b-form-group label="Email">
                    <b-input type="text" name="email" placeholder="Email" value="{{ Auth::user()->email}}" />
                </b-form-group>
                <b-form-group label="Password">
                    <b-input type="password" name="password" placeholder="Password" />
                </b-form-group>
                <b-form-group label="Phone Number">
                    <b-input type="text" placeholder="Phone Number" name="phone" value="{{ Auth::user()->phone}}" />
                </b-form-group>
                <b-form-group label="Date of Birth">
                    <b-form-datepicker id="datepicker" name="date" placeholder="Date of Birth" value="{{ Auth::user()->date_of_birth}}" class="mb-2"></b-form-datepicker>
                </b-form-group>
                <div>
                    <b-button class="ungu" type="submit">Submit</b-button>
                    <b-link class="btn btn-outline-secondary" href="{{ url('profile') }}">Cancel</b-link>
                </div>
            </b-form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
function click_gambar() {
    document.getElementById('file').click();
}

function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('gambar');
        // output.src = reader.result;
        document.getElementById('uploadlah').style.backgroundImage = 'url(' + reader.result + ')';
        document.getElementById('uploadlah').style.backgroundPosition = 'center center';
        document.getElementById('uploadlah').style.backgroundSize = 'cover';

    }
    reader.readAsDataURL(event.target.files[0]);
}
document.getElementById('uploadlah').style.backgroundImage = 'url(<?= asset(Storage::url(Auth::user()->photo)); ?>)';
document.getElementById('uploadlah').style.backgroundPosition = 'center center';
document.getElementById('uploadlah').style.backgroundSize = 'cover';

</script>
@endpush
