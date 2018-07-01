@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xs-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Créer une nouvelle offre d'emploi</h3>
                    </div>
                    <form name="createOffer" role="form" method="post" action="/profile/offer/create">
                        <div class="boxEffectContent">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="create_title">Titre de l'offre *</label>
                                        <input type="text" id="create_title" name="create_title" required="required" value="{{ old('create_title') }}"/>
                                        @if ($errors->has('create_title'))
                                            <div class="error">{{ $errors->first('create_title') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="create_description">Description de l'offre *</label>
                                        <textarea id="create_description" name="create_description" required="required" rows="5">{{ old('create_description') }}</textarea>
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
                                        @if ($errors->has('create_duration'))
                                            <div class="error">{{ $errors->first('create_duration') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_remuneration">Rémunération * (taux horaire)</label>
                                        <input type="number" id="create_remuneration" name="create_remuneration" required="required" placeholder="Ex : 10" value="{{ old('create_remuneration') }}" />
                                        @if ($errors->has('create_remuneration'))
                                            <div class="error">{{ $errors->first('create_remuneration') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_city">Lieu du poste * (Ville)</label>
                                        <input type="text" id="create_city" name="create_city" required="required" placeholder="Ex : Lille" value="{{ old('create_city') }}" />
                                        @if ($errors->has('create_city'))
                                            <div class="error">{{ $errors->first('create_city') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_contact_email">Adresse mail à contacter *</label>
                                        <input type="text" id="create_contact_email" name="create_contact_email" required="required" placeholder="Ex : contact@test.fr" value="{{ old('create_contact_email') }}" />
                                        @if ($errors->has('create_contact_email'))
                                            <div class="error">{{ $errors->first('create_contact_email') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="create_contact_phone">Téléphone à contacter *</label>
                                        <input type="text" id="create_contact_phone" name="create_contact_phone" required="required" placeholder="Ex : 06050610233" value="{{ old('create_contact_phone') }}" />
                                        @if ($errors->has('create_contact_phone'))
                                            <div class="error">{{ $errors->first('create_contact_phone') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="create_sector">Secteur d'activité *</label>
                                        <div class="formSelect">
                                            <select id="create_sector" name="create_sector" required="required">
                                                <option disabled selected value="">Sélectionner un secteur</option>
                                                <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.sector_activity'); ?>
                                                @foreach($sectors as $key => $sector)
                                                    @if ($sector['display'] == 1)
                                                    <option @if(old('create_sector') && old('create_sector') == $key) selected="selected" @endif value="{{ $key }}">{{ $sector['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('create_sector'))
                                            <div class="error">{{ $errors->first('create_sector') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="inputGroup">
                                    <label for="create_terms">En créant cette offre vous acceptez de ne pas divulger les informations qui vous seront transmises en cas de candidature à celle-ci.</label>
                                </div>
                                <input type="checkbox" name="create_terms" id="create_terms" class="checkboxInput" {{ old('create_terms') ? 'checked' : '' }}>
                                @if ($errors->has('create_terms'))
                                    <div class="error">{{ $errors->first('create_terms') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="boxEffectFooter">
                            <input type="hidden" name="create_valid" id="create_valid" value="false" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('indexOffers') }}" type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</a>
                            <button type="submit" class="buttonActionLg bgPrimary submit-btn">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
