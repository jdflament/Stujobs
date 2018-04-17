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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_description">Description de l'offre</label>*
                                    <textarea class="form-control" id="create_description" name="create_description" required="required" rows="5"></textarea>
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
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="create_duration">Durée</label>*
                                    <input type="text" class="form-control" id="create_duration" name="create_duration" required="required" placeholder="Ex : 6 mois" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="create_remuneration">Rémunération</label>* (taux horaire)
                                    <input type="number" class="form-control" id="create_remuneration" name="create_remuneration" required="required" placeholder="Ex : 10" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="create_remuneration">Lieu du poste</label>* (Ville)
                                    <input type="text" class="form-control" id="create_city" name="create_city" required="required" placeholder="Ex : Lille" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="create_contact_email">Adresse mail à contacter</label>*
                                    <input type="text" class="form-control" id="create_contact_email" name="create_contact_email" required="required" placeholder="Ex : contact@test.fr" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="create_contact_phone">Téléphone à contacter</label>*
                                    <input type="text" class="form-control" id="create_contact_phone" name="create_contact_phone" required="required" placeholder="Ex : 06050610233" />
                                </div>
                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
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
