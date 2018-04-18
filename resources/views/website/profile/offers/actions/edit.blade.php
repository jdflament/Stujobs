@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Éditer une annonce
                    </div>
                    <form name="editOffer" role="form" method="post" action="/profile/offers/{{ $offer->id }}/edit">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_title">Titre de l'annonce</label>*
                                        <input type="text" class="form-control" id="edit_title" name="edit_title" required="required" value="{{ $offer->title }}" />
                                    </div>
                                    @if ($errors->has('edit_title'))
                                        <div class="error">{{ $errors->first('edit_title') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_description">Description de l'annonce</label>*
                                        <textarea class="form-control" id="edit_description" name="edit_description" required="required" rows="5">{{ $offer->description }}</textarea>
                                    </div>
                                    @if ($errors->has('edit_description'))
                                        <div class="error">{{ $errors->first('edit_description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_contract_type">Type de contrat</label>*
                                        <select class="form-control" id="edit_contract_type" name="edit_contract_type" required="required">
                                            <option disabled selected value="">Sélectionner un type de contrat</option>
                                            <?php $contract_types = \Illuminate\Support\Facades\Lang::get('vocabulary.contract_type'); ?>
                                            @foreach($contract_types as $key => $contract_type)
                                                <option value="{{ $key }}" @if($offer->contract_type == $key) selected="selected" @endif>{{ $contract_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('edit_contract_type'))
                                        <div class="error">{{ $errors->first('edit_contract_type') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_duration">Durée</label>*
                                        <input type="text" class="form-control" id="edit_duration" name="edit_duration" placeholder="Ex : 6 mois" value="{{ $offer->duration }}" />
                                    </div>
                                    @if ($errors->has('edit_duration'))
                                        <div class="error">{{ $errors->first('edit_duration') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_remuneration">Rémunération</label>* (taux horaire)
                                        <input type="text" class="form-control" id="edit_remuneration" name="edit_remuneration" required="required" value="{{ $offer->remuneration }}" placeholder="Ex : 10€/h" />
                                    </div>
                                    @if ($errors->has('edit_remuneration'))
                                        <div class="error">{{ $errors->first('edit_remuneration') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="edit_city">Lieu du poste</label>* (Ville)
                                        <input type="text" class="form-control" id="edit_city" name="edit_city" required="required" value="{{ $offer->city }}" />
                                    </div>
                                    @if ($errors->has('edit_city'))
                                        <div class="error">{{ $errors->first('edit_city') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="edit_contact_email">Adresse mail à contacter</label>*
                                        <input type="text" class="form-control" id="edit_contact_email" name="edit_contact_email" required="required" value="{{ $offer->contact_email }}" />
                                    </div>
                                    @if ($errors->has('edit_contact_email'))
                                        <div class="error">{{ $errors->first('edit_contact_email') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="edit_contact_phone">Téléphone à contacter</label>*
                                        <input type="text" class="form-control" id="edit_contact_phone" name="edit_contact_phone" required="required" value="{{ $offer->contact_phone }}" />
                                    </div>
                                    @if ($errors->has('edit_contact_phone'))
                                        <div class="error">{{ $errors->first('edit_contact_phone') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="edit_sector">Secteur d'activité</label>*
                                        <select class="form-control" id="edit_sector" name="edit_sector" required="required">
                                            <option disabled selected value="">Sélectionner un secteur</option>
                                            <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.sector_activity'); ?>
                                            @foreach($sectors as $key => $sector)
                                                <option value="{{ $key }}" <?php if ($offer->sector == $key): ?>selected="selected"<?php endif; ?>>{{ $sector }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('edit_sector'))
                                        <div class="error">{{ $errors->first('edit_sector') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: right">
                            <input type="hidden" name="create_valid" id="edit_valid" value="{{ $offer->valid }}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('indexOffers') }}" type="button" class="btn btn-default" data-dismiss="modal" style="-webkit-appearance: initial; color:black">Annuler</a>
                            <button type="submit" class="btn btn-primary submit-btn">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
