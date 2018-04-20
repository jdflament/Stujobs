@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardIndexOffers') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Créer une nouvelle annonce</h3>
                    </div>

                    <form name="createOffer" role="form" method="post" action="/dashboard/offers">
                        <div class="boxEffectContent">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-xs-12 col-md-8 col-lg-8">
                                    <div class="inputGroup" id="select-company">
                                        <label for="create_company_id">Entreprise *</label>
                                        <div class="formSelect">
                                            <select id="create_company_id" name="create_company_id" required="required">
                                                <option disabled selected value="">Sélectionner une entreprise</option>
                                                @foreach ($companies as $company)
                                                <option @if(old('create_company_id') && old('create_company_id') == $company->id) selected="selected" @endif value="{{ $company->id }}">{{ $company->name }} {{ $company->email ? '(' . $company->email . ')' : '(NC)' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('create_company_id'))
                                            <div class="error">{{ $errors->first('create_company_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-4" style="text-align: center">
                                    <p class="small">L'entreprise n'existe pas ?</p>
                                    <button type="button" data-destination="select-company" class="buttonActionLg bgPrimary btn-pre-create-company" data-toggle="modal" data-target="#modalCreateCompany">
                                        <i class="fa fa-plus"></i> Créer
                                    </button>
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="create_title">Titre de l'annonce *</label>
                                        <input type="text" id="create_title" name="create_title" required="required" value="{{ old('create_title') }}" placeholder="Ex : Développeur Web Junior..." />
                                        @if ($errors->has('create_title'))
                                            <div class="error">{{ $errors->first('create_title') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="create_description">Description de l'annonce *</label>
                                        <textarea placeholder="Ex : Nous recherchons un développeur..." id="create_description" name="create_description" rows="5" required="required">{{ old('create_description') }}</textarea>
                                        @if ($errors->has('create_description'))
                                            <div class="error">{{ $errors->first('create_description') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_contract_type">Type de contrat *</label>
                                        <div class="formSelect">
                                            <select id="create_contract_type" name="create_contract_type" required="required">
                                                <option disabled selected value="">Sélectionner un type de contrat</option>
                                                <?php $contract_types = \Illuminate\Support\Facades\Lang::get('vocabulary.contract_type'); ?>
                                                @foreach($contract_types as $key => $contract_type)
                                                    <option @if(old('create_contract_type') && old('create_contract_type') == $key) selected="selected" @endif value="{{ $key }}">{{ $contract_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('create_contract_type'))
                                            <div class="error">{{ $errors->first('create_contract_type') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_duration">Durée *</label>
                                        <input type="text" id="create_duration" name="create_duration" required="required" placeholder="Ex : 6 mois" value="{{ old('create_duration') }}" />
                                    </div>
                                    @if ($errors->has('create_duration'))
                                        <div class="error">{{ $errors->first('create_duration') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_remuneration">Rémunération * (taux horaire)</label>
                                        <input type="number" id="create_remuneration" name="create_remuneration" required="required" placeholder="Ex : 10" value="{{ old('create_remuneration') }}" />
                                    </div>
                                    @if ($errors->has('create_remuneration'))
                                        <div class="error">{{ $errors->first('create_remuneration') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_city">Lieu du poste (Ville) *</label>
                                        <input type="text" id="create_city" name="create_city" required="required" placeholder="Ex : Lille" value="{{ old('create_city') }}" />
                                    </div>
                                    @if ($errors->has('create_city'))
                                        <div class="error">{{ $errors->first('create_city') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="create_sector">Secteur d'activité *</label>
                                        <div class="formSelect">
                                            <select id="create_sector" name="create_sector" required="required">
                                                <option disabled selected value="">Sélectionner un secteur</option>
                                                <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.sector_activity'); ?>
                                                @foreach($sectors as $key => $sector)
                                                    <option value="{{ $key }}" <?php if (old('create_sector') && old('create_sector') == $key): ?>selected="selected"<?php endif; ?>>{{ $sector }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($errors->has('create_sector'))
                                        <div class="error">{{ $errors->first('create_sector') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_contact_email">Adresse mail à contacter *</label>
                                        <input type="text" id="create_contact_email" name="create_contact_email" required="required" placeholder="Ex : contact@test.fr" value="{{ old('create_contact_email') }}" />
                                    </div>
                                    @if ($errors->has('create_contact_email'))
                                        <div class="error">{{ $errors->first('create_contact_email') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_contact_phone">Téléphone à contacter *</label>
                                        <input type="text" id="create_contact_phone" name="create_contact_phone" required="required" placeholder="Ex : 0601020304" value="{{ old('create_contact_phone') }}" />
                                    </div>
                                    @if ($errors->has('create_contact_phone'))
                                        <div class="error">{{ $errors->first('create_contact_phone') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="boxEffectFooter">
                            <input type="hidden" name="create_valid" id="create_valid" value="false" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('dashboardIndexOffers') }}" type="button" class="buttonActionLg bgDefault">Annuler</a>
                            <button type="submit" class="buttonActionLg bgPrimary submit-btn">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/companies/actions/create')
@endsection
