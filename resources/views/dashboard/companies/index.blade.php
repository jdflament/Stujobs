@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <!-- Button trigger modal -->
                <button data-destination="companies-content" class="buttonActionLg bgPrimary btn-pre-create-company" data-toggle="modal" data-target="#modalCreateCompany">
                    <i class="fa fa-plus"></i> Ajouter une entreprise
                </button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Liste des entreprises</h3>
                    </div>

                    <div class="boxEffectContent">
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
