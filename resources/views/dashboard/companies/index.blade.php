@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Liste des entreprises
                        <!-- Button trigger modal -->
                        <button style="float: right;" data-destination="companies-content" class="btn btn-primary btn-sm btn-pre-create-company" data-toggle="modal" data-target="#modalCreateCompany">
                            Ajouter une entreprise
                        </button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('dashboard/companies/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/companies/actions/create')
    @include('dashboard/companies/actions/edit')
    @include('dashboard/companies/actions/delete')
@endsection
