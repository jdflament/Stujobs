@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xs-12 col-lg-12">
                <div class="card">
                    <div class="card-header">Créer une nouvelle offre d'emploi
                    </div>

                    <form name="createOffer" role="form" method="post" action="/profile/offer/create">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_title">Titre de l'offre</label>*
                                    <input type="text" class="form-control" id="create_title" name="create_title" required="required"/>
                                </div>
                                @if ($errors->has('create_title'))
                                    <div class="error">{{ $errors->first('create_title') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_description">Description de l'offre</label>*
                                    <textarea class="form-control" id="create_description" name="create_description" required="required" rows="5"></textarea>
                                </div>
                                @if ($errors->has('create_description'))
                                    <div class="error">{{ $errors->first('create_description') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="create_contract_type">Type de contrat</label>*
                                    <select class="form-control" id="create_contract_type" name="create_contract_type" required="required">
                                        <option disabled selected value="">Sélectionner un type de contrat</option>
                                        <?php $contract_types = \Illuminate\Support\Facades\Lang::get('vocabulary.contract_type'); ?>
                                        @foreach($contract_types as $key => $contract_type)
                                            <option value="{{ $key }}">{{ $contract_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('create_contract_type'))
                                    <div class="error">{{ $errors->first('create_contract_type') }}</div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="create_duration">Durée</label>*
                                    <input type="text" class="form-control" id="create_duration" name="create_duration" required="required" placeholder="Ex : 6 mois" />
                                </div>
                                @if ($errors->has('create_duration'))
                                    <div class="error">{{ $errors->first('create_duration') }}</div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="create_remuneration">Rémunération</label>* (taux horaire)
                                    <input type="number" class="form-control" id="create_remuneration" name="create_remuneration" required="required" placeholder="Ex : 10" />
                                </div>
                                @if ($errors->has('create_remuneration'))
                                    <div class="error">{{ $errors->first('create_remuneration') }}</div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="create_city">Lieu du poste</label>* (Ville)
                                    <input type="text" class="form-control" id="create_city" name="create_city" required="required" placeholder="Ex : Lille" />
                                </div>
                                @if ($errors->has('create_city'))
                                    <div class="error">{{ $errors->first('create_city') }}</div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="create_contact_email">Adresse mail à contacter</label>*
                                    <input type="text" class="form-control" id="create_contact_email" name="create_contact_email" required="required" placeholder="Ex : contact@test.fr" />
                                </div>
                                @if ($errors->has('create_contact_email'))
                                    <div class="error">{{ $errors->first('create_contact_email') }}</div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="create_contact_phone">Téléphone à contacter</label>*
                                    <input type="text" class="form-control" id="create_contact_phone" name="create_contact_phone" required="required" placeholder="Ex : 06050610233" />
                                </div>
                                @if ($errors->has('create_contact_phone'))
                                    <div class="error">{{ $errors->first('create_contact_phone') }}</div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="create_sector">Secteur d'activité</label>*
                                    <select class="form-control" id="create_sector" name="create_sector" required="required">
                                        <option disabled selected value="">Sélectionner un secteur</option>
                                        <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.sector_activity'); ?>
                                        @foreach($sectors as $key => $sector)
                                            <option value="{{ $key }}">{{ $sector }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('create_sector'))
                                    <div class="error">{{ $errors->first('create_sector') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: right">
                        <input type="hidden" name="create_valid" id="create_valid" value="false" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('indexOffers') }}" type="button" class="btn btn-default" data-dismiss="modal" style="-webkit-appearance: initial; color:black">Annuler</a>
                        <button type="submit" class="btn btn-primary submit-btn">Créer</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
