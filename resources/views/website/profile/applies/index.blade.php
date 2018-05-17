@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Liste des candidatures</h3>
                    </div>

                    <div class="boxEffectContent">
                        <div class="rowActions">
                            <div class="formSelect largeSelect">
                                <select class="selectInput" id="filterApplies">
                                    <option value="all" @if(!isset($offerIdFilter)) selected="selected" @endif>Toutes</option>
                                    @foreach($offers as $offer)
                                        <option value="{{ $offer->id }}" @if(isset($offerIdFilter) && $offerIdFilter == $offer->id) selected="selected" @endif>{{ $offer->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @include('website/profile/applies/actions/list')
                    </div>

                    <div class="boxEffectFooter paginationBlock">
                        {{ $applies->links('website/templates/pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
