@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardIndexApplies') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
                <a href="{{ '/dashboard/applies/' . $apply->apply_id . '/show' }}" class="buttonActionLg bgDark"><i class="fa fa-arrow-left"></i> Retour sur la candidature</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Historique de la candidature de : <span class="colorPrimary">{{ $apply->apply_firstname }} {{ $apply->apply_lastname }}</span></h3>
                    </div>

                    <div class="boxEffectContent">
                        <div id="timeline" class="timelineContainer">
                            <div class="timelineBlock">
                                <div class="timelineIcon bgSuccess">
                                    <div><i class="fa fa-plus"></i></div>
                                </div>
                                <div class="timelineContent">
                                    <h2 class="boxEffectTitle colorPrimary">
                                        Création de la candidature
                                    </h2>
                                    <p>
                                        Par le candidat <span class="colorPrimary">{{ $apply->apply_firstname }} {{ $apply->apply_lastname }}</span>
                                        @if ($apply->apply_cv_filename)
                                            <a href="{{ asset('storage/cv') . '/' . $apply->apply_cv_filename }}" target="_blank" class="buttonActionLg bgPrimary"><i class="fa fa-file-text"></i> Voir le CV</a>
                                        @endif
                                    </p>

                                    <?php
                                    $date_apply = new \Carbon\Carbon($apply->apply_created_at);
                                    $date_apply::setLocale('fr');
                                    ?>
                                    <span class="timelineDate">Le {{ $date_apply->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>
                            @foreach ($history as $value)
                                <div class="timelineBlock">
                                    <div class="timelineIcon @if($value->history_column_value == 1) bgSuccess @elseif ($value->history_column_value == 2) bgDanger @endif">
                                        @if ($value->history_column_change == 'valid' && $value->history_column_value == 1)
                                            <div><i class="fa fa-check"></i></div>
                                        @elseif ($value->history_column_change == 'valid' && $value->history_column_value == 2)
                                            <div><i class="fa fa-times"></i></div>
                                        @endif
                                    </div>
                                    <div class="timelineContent">
                                        <h2 class="boxEffectTitle colorPrimary">
                                            La candidature a été
                                            @if ($value->history_column_change == 'valid' && $value->history_column_value == 1)
                                                acceptée et envoyée
                                            @elseif ($value->history_column_change == 'valid' && $value->history_column_value == 2)
                                                refusée
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