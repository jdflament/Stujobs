@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Mon profil
                        <a style="float: right; margin-right: 10px;" href="{{ route('editProfilePage') }}" class="btn btn-primary btn-sm">
                            Modifier mes informations
                        </a>
                    </div>

                    <div class="card-body">
                        @include('website/profile/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
