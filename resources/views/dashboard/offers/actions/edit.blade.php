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
                        <h3 class="boxEffectTitle">Éditer une annonce</h3>
                    </div>
                    <form name="editOffer" role="form" method="post" action="/dashboard/offers/{{ $offer->id }}/edit">
                        <div class="boxEffectContent">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-xs-12 col-md-8 col-lg-8">
                                    <div class="inputGroup" id="select-company">
                                        <label for="edit_company_id">Entreprise *</label>
                                        <div class="formSelect">
                                            <select id="edit_company_id" name="edit_company_id" required="required">
                                                <option disabled selected value="">Sélectionner une entreprise</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}" @if(old('edit_company_id') == $company->id) selected @elseif($offer->user_id == $company->id) selected @endif>{{ $company->email }} {{ $company->name ? '(' . $company->name . ')' : '(NC)' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('edit_company_id'))
                                            <div class="error">{{ $errors->first('edit_company_id') }}</div>
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
                                        <label for="edit_title">Titre de l'annonce *</label>
                                        <input type="text" id="edit_title" name="edit_title" required="required" value="{{ old('edit_title') ? old('edit_title') : $offer->title }}" />
                                    </div>
                                    @if ($errors->has('edit_title'))
                                        <div class="error">{{ $errors->first('edit_title') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="edit_description">Description de l'annonce *</label>
                                        <textarea id="edit_description" name="edit_description" required="required" rows="5">{{ old('edit_description') ? old('edit_description') : $offer->description }}</textarea>
                                    </div>
                                    @if ($errors->has('edit_description'))
                                        <div class="error">{{ $errors->first('edit_description') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_contract_type">Type de contrat *</label>
                                        <div class="formSelect">
                                            <select id="edit_contract_type" name="edit_contract_type" required="required">
                                                <option disabled selected value="">Sélectionner un type de contrat</option>
                                                <?php $contract_types = \Illuminate\Support\Facades\Lang::get('vocabulary.contract_type'); ?>
                                                @foreach($contract_types as $key => $contract_type)
                                                    <option value="{{ $key }}" @if(old('edit_contract_type') == $key) selected @elseif($offer->contract_type == $key) selected @endif><?= $contract_type ?></option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('edit_contract_type'))
                                            <div class="error">{{ $errors->first('edit_contract_type') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_duration">Durée *</label>
                                        <input type="text" id="edit_duration" name="edit_duration" required="required" placeholder="Ex : 6 mois" value="{{ old('edit_duration') ? old('edit_duration') : $offer->duration }}" />
                                    </div>
                                    @if ($errors->has('edit_duration'))
                                        <div class="error">{{ $errors->first('edit_duration') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_remuneration">Rémunération * (taux horaire)</label>
                                        <input type="number" id="edit_remuneration" name="edit_remuneration" required="required" value="{{ old('edit_remuneration') ? old('edit_remuneration') : $offer->remuneration }}" placeholder="Ex : 10€/h" />
                                    </div>
                                    @if ($errors->has('edit_remuneration'))
                                        <div class="error">{{ $errors->first('edit_remuneration') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_city">Lieu du poste * (Ville)</label>
                                        <input type="text" id="edit_city" name="edit_city" required="required" value="{{ old('edit_city') ? old('edit_city') : $offer->city }}" />
                                    </div>
                                    @if ($errors->has('edit_city'))
                                        <div class="error">{{ $errors->first('edit_city') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="edit_sector">Secteur d'activité *</label>
                                        <div class="formSelect">
                                            <select id="edit_sector" name="edit_sector" required="required">
                                                <option disabled selected value="">Sélectionner un secteur</option>
                                                <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.sector_activity'); ?>
                                                @foreach($sectors as $key => $sector)
                                                    @if ($sector['display'] == 1)
                                                    <option value="{{ $key }}" @if(old('edit_sector') == $key) selected @elseif($offer->sector == $key) selected @endif>{{ $sector['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($errors->has('edit_sector'))
                                        <div class="error">{{ $errors->first('edit_sector') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_contact_email">Adresse mail à contacter *</label>
                                        <input type="text" id="edit_contact_email" name="edit_contact_email" required="required" value="{{ old('edit_contact_email') ? old('edit_contact_email') : $offer->contact_email }}" />
                                    </div>
                                    @if ($errors->has('edit_contact_email'))
                                        <div class="error">{{ $errors->first('edit_contact_email') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_contact_phone">Téléphone à contacter *</label>
                                        <input type="text" id="edit_contact_phone" name="edit_contact_phone" required="required" value="{{ old('edit_contact_phone') ? old('edit_contact_phone') : $offer->contact_phone }}" />
                                    </div>
                                    @if ($errors->has('edit_contact_phone'))
                                        <div class="error">{{ $errors->first('edit_contact_phone') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="boxEffectFooter">
                            <input type="hidden" name="create_valid" id="edit_valid" value="{{ $offer->valid }}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('dashboardIndexOffers') }}" type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</a>
                            <button type="submit" class="buttonActionLg bgPrimary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/companies/actions/create')
@endsection
