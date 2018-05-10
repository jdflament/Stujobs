@extends('layouts.website')

@section('content')
<div class="errorPage">
    <div class="boxError">
        <div class="boxErrorHeader">
            <h1 class="boxErrorTitle">{{ $exception->getStatusCode() }}</h1>
        </div>
        <div class="boxErrorContent">
            <p>La page demandée est introuvable</p>
        </div>
        <div class="boxErrorFooter">
            <a href="{{ url()->previous() }}" class="buttonActionLg bgPrimary largeButton"><i class="fa fa-arrow-left"></i> Retour</a>
        </div>
    </div>
</div>
@endsection