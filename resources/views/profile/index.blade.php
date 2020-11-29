@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-3">
    	<div class="col-md-12 mb-5">
    		<h2><strong>PROFILE</strong></h2>
    	</div>
        <div class="col-md-3">
            <div id="image" style="width: 100%;padding:7.5rem;height:auto;border-radius: 3rem;background: #ddd;"></div>
            <div class="text-center">
                <b-link class="btn btn-primary ungu mt-4" href="{{ url('profile/ubah') }}">Edit Profile</b-link>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-8">
        	<strong>Name</strong>
        	<p>{{ Auth::user()->name }}</p>

        	<strong>Email</strong>
        	<p>{{ Auth::user()->email }}</p>

        	<strong>Phone Number</strong>
        	<p>{{ empty(Auth::user()->phone) ? '-' : Auth::user()->phone }}</p>

        	<strong>Date of Birth</strong>
        	<p>{{ empty(Auth::user()->date_of_birth) ? '-' : Auth::user()->date_of_birth }}</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('image').style.backgroundImage = 'url(<?= asset(Storage::url(Auth::user()->photo)); ?>)';
document.getElementById('image').style.backgroundPosition = 'center center';
document.getElementById('image').style.backgroundSize = 'cover';

</script>
@endpush
