@extends('layouts.dashboard')

@section('content')
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Mon profil
                        </div>
                        @include('dashboard/profile/actions/list')
                    </div>
                </div>
            </div>
    </div>
@endsection