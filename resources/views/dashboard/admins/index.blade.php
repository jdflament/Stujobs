@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <!-- Button trigger modal -->
                <button data-destination="admins-content" class="buttonActionLg bgPrimary btn-pre-create-admin" data-toggle="modal" data-target="#modalCreateAdmin">
                    <i class="fa fa-plus"></i> Ajouter un administrateur
                </button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Liste des administrateurs</h3>
                    </div>

                    <div class="boxEffectContent">
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
