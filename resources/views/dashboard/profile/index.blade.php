@extends('layouts.dashboard')

@section('content')
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-10 col-xs-12">
                    <div class="card">
                        <div class="card-header">Mon profil
                            <a style="float: right;" href="{{ route('dashboardEditProfilePage') }}" class="btn btn-primary btn-sm">
                                Modifier mes informations
                            </a>
                        </div>
                        <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('dashboard/profile/actions/list')
                    </div>
                </div>
            </div>
    </div>
@endsection