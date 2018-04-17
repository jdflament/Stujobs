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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_description">Description de l'annonce</label>*
                                        <textarea class="form-control" id="edit_description" name="edit_description" required="required" rows="5">{{ $offer->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_contract_type">Type de contrat</label>*
                                        <select class="form-control" id="edit_contract_type" name="edit_contract_type" required="required">
                                            <option disabled selected value="">Sélectionner un type de contrat</option>
                                            <?php
                                            $contracts = [
                                                "nc" => "Non précisé",
                                                "ctt" => "Intérim",
                                                "sj" => "Job Étudiant",
                                                "stage" => "Stage",
                                                "ca" => "Contrat d'apprentissage",
                                                "cp" => "Contrat de professionnalisation",
                                                "cdd" => "CDD",
                                                "cdi" => "CDI"
                                            ]
                                            ?>
                                            <?php foreach($contracts as $key => $contract): ?>
                                            <option value="<?= $key ?>" @if($offer->contract_type == $key) selected @endif><?= $contract ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_duration">Durée</label>*
                                        <input type="text" class="form-control" id="edit_duration" name="edit_duration" required="required" placeholder="Ex : 6 mois" value="{{ $offer->duration }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_remuneration">Rémunération</label>* (taux horaire)
                                        <input type="text" class="form-control" id="edit_remuneration" name="edit_remuneration" required="required" value="{{ $offer->remuneration }}" placeholder="Ex : 10€/h" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_remuneration">Lieu du poste</label>* (Ville)
                                        <input type="text" class="form-control" id="edit_city" name="edit_city" required="required" value="{{ $offer->city }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_contact_email">Adresse mail à contacter</label>*
                                        <input type="text" class="form-control" id="edit_contact_email" name="edit_contact_email" required="required" value="{{ $offer->contact_email }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_contact_phone">Téléphone à contacter</label>*
                                        <input type="text" class="form-control" id="edit_contact_phone" name="edit_contact_phone" required="required" value="{{ $offer->contact_phone }}" />
                                    </div>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
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
