@extends('layouts.website')

@section('content')
<div class="containerLg">
    <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Paramètres et outils de confidentialité</h3>
                        <br />
                        <p class="paragraphe">Pour des raisons de confidentialité, vous êtes en droit de demander la copie ou l'effacement de certaines informations personnelles vous concernant.</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4 marginTop">
                <div class="boxEffect">
                    <h3 class="boxTitle centerContent">Télécharger vos informations</h3>
                    <p class="paragraphe">Vous pouvez télécharger une copie de vos informations à tout moment. Le téléchargement de vos informations est un processus protégé par un mot de passe connu de vous uniquement. Si vous souhaitez télécharger vos informations, cliquez sur Télécharger mes informations.</p> 
                    <a data-toggle="modal" data-target="#modalDownloadData" href="" class="buttonActionLg bgPrimary"><i class="fa fa-download"></i> Télécharger mes informations</a>                   
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4 marginTop">
                <div class="boxEffect">
                    <h3 class="boxTitle centerContent">Supprimer votre compte</h3>
                    <p class="paragraphe">Si vous ne pensez jamais réutiliser Stujobs et souhaitez effacer complètement votre compte, nous pouvons nous en charger. Sachez cependant que vous ne pourrez ni réactiver votre compte ni récupérer son contenu ou ses informations. Si vous souhaitez tout de même supprimer votre compte, cliquez sur Supprimer mon compte.</p> 
                    <a data-toggle="modal" data-target="#modalDeleteAccount" href="" class="buttonActionLg bgDanger"><i class="fa fa-trash"></i> Supprimer mon compte</a>                   
                </div>
            </div>
        </div>
    </div>
</div>
    @include('website/profile/settings/delete')
    @include('website/profile/settings/download')
@endsection