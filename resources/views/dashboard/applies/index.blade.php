@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Liste des candidatures</h3>
                    </div>

                    <div class="boxEffectContent">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="rowActions">
                            <div class="formSelect largeSelect">
                                <select class="selectInput" id="filterApplies">
                                    <option value="all" selected>Toutes</option>
                                    @foreach($offers as $offer)
                                        <option value="{{ $offer->id }}" @if(isset($offerIdFilter) && $offerIdFilter === $offer->id) selected="selected" @endif>{{ $offer->title }} (par {{ $offer->company_name }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @include('dashboard/applies/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/applies/actions/delete')
@endsection
