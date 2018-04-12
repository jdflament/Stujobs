@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-xs-12">
                <div class="card">
                    <div class="card-header">Liste des candidatures</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('dashboard/applies/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/applies/actions/delete')
@endsection
