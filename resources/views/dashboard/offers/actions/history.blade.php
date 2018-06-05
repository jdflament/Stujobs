@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardIndexOffers') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
                <a href="{{ '/dashboard/offers/' . $offer->offer_id . '/show' }}" class="buttonActionLg bgDark"><i class="fa fa-arrow-left"></i> Retour sur l'offre</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Historique de l'offre : <span class="colorPrimary">{{ $offer->title }}</span></h3>
                    </div>

                    <div class="boxEffectContent">
                        <div id="timeline" class="timelineContainer">
                            <div class="timelineBlock">
                                <div class="timelineIcon bgSuccess">
                                    <div><i class="fa fa-plus"></i></div>
                                </div>
                                <div class="timelineContent">
                                    <h2 class="boxEffectTitle colorPrimary">
                                        Création de l'offre
                                    </h2>
                                    <p>
                                        Par l'entreprise <a href="{{ "/dashboard/companies/" . $offer->user_id . "/show" }}"><span class="colorPrimary">{{ $offer->company_name ? $offer->company_name : $offer->user_email }}</span></a>
                                    </p>

                                    <?php
                                    $date_offer = new \Carbon\Carbon($offer->created_at);
                                    $date_offer::setLocale('fr');
                                    ?>
                                    <span class="timelineDate">Le {{ $date_offer->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>
                            @foreach ($history as $value)
                            <div class="timelineBlock">
                                <div class="timelineIcon @if($value->history_column_value == 1) bgSuccess @elseif ($value->history_column_change == 'complete' && $value->history_column_value == 0) bgWarning @else bgDanger @endif">
                                    @if ($value->history_column_change == 'valid' && $value->history_column_value == 1)
                                        <div><i class="fa fa-check"></i></div>
                                    @elseif ($value->history_column_change == 'valid' && $value->history_column_value == 0)
                                        <div><i class="fa fa-times"></i></div>
                                    @elseif ($value->history_column_change == 'complete' && $value->history_column_value == 1)
                                        <div><i class="fa fa-ban"></i></div>
                                    @elseif ($value->history_column_change == 'complete' && $value->history_column_value == 0)
                                        <div><i class="fa fa-refresh"></i></div>
                                    @endif
                                </div>
                                <div class="timelineContent">
                                    <h2 class="boxEffectTitle colorPrimary">
                                       L'offre a été
                                        @if ($value->history_column_change == 'valid' && $value->history_column_value == 1)
                                            approuvée
                                        @elseif ($value->history_column_change == 'valid' && $value->history_column_value == 0)
                                            désapprouvée
                                        @elseif ($value->history_column_change == 'complete' && $value->history_column_value == 1)
                                            terminée
                                        @elseif ($value->history_column_change == 'complete' && $value->history_column_value == 0)
                                            réactivée
                                        @endif
                                    </h2>
                                    <p>
                                        Par
                                        @if ($value->history_user_role == 'company')
                                            l'entreprise <a href="{{ "/dashboard/companies/" . $value->history_user_id . "/show" }}"><span class="colorPrimary">{{ $value->company_name ? $value->company_name : $value->history_user_email }}</span></a>
                                        @else
                                            l'administrateur <a href="{{ "/dashboard/admins/" . $value->history_user_id . "/show" }}"><span class="colorPrimary">{{ $value->admin_firstname ? $value->admin_firstname : $value->history_user_email }} {{ $value->admin_lastname ? $value->admin_lastname : '' }}</span></a>
                                        @endif
                                    </p>
                                    @if (null !== $value->history_reason)
                                    <p>
                                        <?php $reason = $value->history_reason; ?>
                                        <b>Raison : </b><?php echo nl2br($reason) ?>
                                    </p>
                                    @endif
                                    <?php
                                    $value_date = new \Carbon\Carbon($value->history_created_at);
                                    $value_date::setLocale('fr');
                                    ?>
                                    <span class="timelineDate">Le {{ $value_date->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection