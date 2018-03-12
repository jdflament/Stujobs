@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste des administrateurs
                    <!-- Button trigger modal -->
                    <button style="float: right;" data-destination="admins-content" class="btn btn-primary btn-sm btn-pre-create-admin" data-toggle="modal" data-target="#modalCreateAdmin">
                        Ajouter un administrateur
                    </button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('dashboard/admins/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/admins/actions/create')
    @include('dashboard/admins/actions/edit')
    @include('dashboard/admins/actions/delete')
@endsection
