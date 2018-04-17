@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Créer une nouvelle annonce
                    </div>

                    <form name="createOffer" role="form" method="post" action="/dashboard/offers">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" id="select-company">
                                        <label for="create_company_id">Entreprise</label>*
                                        <select class="form-control" id="create_company_id" name="create_company_id" required="required">
                                            <option disabled selected value="">Sélectionner une entreprise</option>
                                            @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }} {{ $company->email ? '(' . $company->email . ')' : '(NC)' }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('create_company_id'))
                                            <div class="error">{{ $errors->first('create_company_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4" style="text-align: center">
                                    <p class="small">L'entreprise n'existe pas ?</p>
                                    <button type="button" data-destination="select-company" class="btn btn-primary btn-sm btn-pre-create-company" data-toggle="modal" data-target="#modalCreateCompany">
                                        Créer
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="create_title">Titre de l'annonce</label>*
                                        <input type="text" class="form-control" id="create_title" name="create_title" required="required"/>
                                        @if ($errors->has('create_title'))
                                            <div class="error">{{ $errors->first('create_title') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="create_description">Description de l'annonce</label>*
                                        <textarea class="form-control" id="create_description" name="create_description" rows="5" required="required"></textarea>
                                        @if ($errors->has('create_description'))
                                            <div class="error">{{ $errors->first('create_description') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="create_contract_type">Type de contrat</label>*
                                        <select class="form-control" id="create_contract_type" name="create_contract_type" required="required">
                                            <option disabled selected value="">Sélectionner un type de contrat</option>
                                            <option value="nc">Non précisé</option>
                                            <option value="ctt">Intérim</option>
                                            <option value="sj">Job Étudiant</option>
                                            <option value="stage">Stage</option>
                                            <option value="ca">Contrat d'apprentissage</option>
                                            <option value="cp">Contrat de professionnalisation</option>
                                            <option value="cdd">CDD</option>
                                            <option value="cdi">CDI</option>
                                        </select>
                                        @if ($errors->has('create_contract_type'))
                                            <div class="error">{{ $errors->first('create_contract_type') }}</div>
                                        @endif
                                    </div>
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
                                        <input type="text" class="form-control" id="create_remuneration" name="create_remuneration" required="required" placeholder="Ex : 10€/h" />
                                    </div>
                                    @if ($errors->has('create_remuneration'))
                                        <div class="error">{{ $errors->first('create_remuneration') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="create_contact_email">Adresse mail à contacter</label>*
                                        <input type="text" class="form-control" id="create_contact_email" name="create_contact_email" required="required" placeholder="Ex : contact@test.fr" />
                                    </div>
                                    @if ($errors->has('create_contact_email'))
                                        <div class="error">{{ $errors->first('create_contact_email') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="create_contact_phone">Téléphone à contacter</label>*
                                        <input type="text" class="form-control" id="create_contact_phone" name="create_contact_phone" required="required" placeholder="Ex : 06050610233" />
                                    </div>
                                    @if ($errors->has('create_contact_phone'))
                                        <div class="error">{{ $errors->first('create_contact_phone') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: right">
                            <input type="hidden" name="create_valid" id="create_valid" value="false" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('dashboardIndexOffers') }}" type="button" class="btn btn-default" data-dismiss="modal" style="-webkit-appearance: initial; color:black">Annuler</a>
                            <button type="submit" class="btn btn-primary submit-btn">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/companies/actions/create')
@endsection
