<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Vocabulary for the website
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match the
    | differents words than you can find in the website, according to job offers.
    |
    */

    // Offers type
    'offers_type' => [
        "all" => "Toutes",
        "valid" => "Approuvées",
        "invalid" => "Désapprouvées",
        "complete" => "Clôturées",
        "incomplete" => "En cours"
    ],

    // Contract type
    'contract_type' => [
        'nc' => 'Non précisé',
        'sj' => 'Job Étudiant',
        'ctt' => 'Intérim',
        'stage' => 'Stage',
        'ca' => 'Contrat d\'apprentissage',
        'cp' => "Contrat de professionnalisation",
        'cdd' => 'CDD',
        'cdi' => "CDI"
    ],

    'contract_type_bgcolors' => [
        'nc' => 'bgDefault',
        'sj' => 'bgWarning',
        'ctt' => 'bgDark',
        'stage' => 'bgPrimary',
        'ca' => 'bgPurple',
        'cp' => 'bgDanger',
        'cdd' => 'bgInfo',
        'cdi' => 'bgSuccess',
    ],

    'contract_type_colors' => [
        'nc' => 'colorDefault',
        'sj' => 'colorWarning',
        'ctt' => 'colorDark',
        'stage' => 'colorPrimary',
        'ca' => 'colorPurple',
        'cp' => 'colorDanger',
        'cdd' => 'colorInfo',
        'cdi' => 'colorSuccess',
    ],

    // Sector activity
//    'sector_activity' => [
//        'administration' => 'Administration / Gestion / Secrétariat',
//        'aviation' => 'Aéronautique',
//        'agriculture' => "Agriculture",
//        'food' => 'Agroalimentaire',
//        'architecture' => 'Architecture',
//        'art' => 'Art / Culture / Loisirs',
//        'association' => 'Associations / Bénévolat',
//        'insurance' => 'Assurance / Mutualité',
//        'audiovisual' => 'Audiovisuel',
//        'other' => 'Autres',
//        'bank' => 'Banques / Finances',
//        'construction' => 'BTP / Construction',
//        'juridical' => 'Cabinet / Services Juridiques',
//        'chemistry' => 'Chimie',
//        'trade' => 'Commerce',
//        'communication' => 'Communication',
//        'design' => 'Design',
//        'education' => 'Enseignement',
//        'large_distribution' => 'Grande Distribution',
//        'hotel' => 'Hôtellerie',
//        'immovable' => 'Immobilier',
//        'industry_production' => 'Industrie : Production',
//        'industry_maintenance' => 'Industrie : Maintenance',
//        'data_processing_hardware' => 'Informatique : Hardware',
//        'data_processing_services' => 'Informatique : Services',
//        'data_processing_web_development' => 'Informatique : Développement Web',
//        'data_processing_ecommerce' => 'Informatique : E-Commerce',
//        'internet' => 'Internet',
//        'journalism' => 'Journalisme',
//        'management' => 'Management',
//        'marketing' => 'Marketing / Merchandising',
//        'recruitment' => 'Recrutement',
//        'network' => 'Réseaux / Télécommunications',
//        'restoration' => 'Restauration',
//        'health' => 'Santé / Médical',
//        'sector_public' => 'Secteur Public',
//        'security' => 'Sécurité / Surveillance',
//        'sport' => 'Sport / Coaching',
//        'tourism' => 'Tourisme / Voyages',
//        'transport' => 'Transports',
//    ],

    'sector_activity' => [
        'administration' => [
            'name' => 'Administration / Gestion / Secrétariat',
            'display' => 1,
        ],
        'aviation' => [
            'name' => 'Aéronautique',
            'display' => 0,
        ],
        'agriculture' => [
            'name' => 'Agriculture',
            'display' => 0,
        ],
        'food' => [
            'name' => 'Agroalimentaire',
            'display' => 0,
        ],
        'architecture' => [
            'name' => 'Architecture',
            'display' => 0,
        ],
        'art' => [
            'name' => 'Art / Culture / Loisirs',
            'display' => 0,
        ],
        'association' => [
            'name' => 'Associations / Bénévolat',
            'display' => 1,
        ],
        'insurance' => [
            'name' => 'Assurance / Mutualité',
            'display' => 0,
        ],
        'audiovisual' => [
            'name' => 'Audiovisuel',
            'display' => 1,
        ],
        'other' => [
            'name' => 'Autres',
            'display' => 1,
        ],
        'bank' => [
            'name' => 'Banques / Finances',
            'display' => 0,
        ],
        'construction' => [
            'name' => 'BTP / Construction',
            'display' => 0,
        ],
        'juridical' => [
            'name' => 'Cabinet / Services Juridiques',
            'display' => 0,
        ],
        'chemistry' => [
            'name' => 'Chimie',
            'display' => 0,
        ],
        'trade' => [
            'name' => 'Commerce',
            'display' => 1,
        ],
        'communication' => [
            'name' => 'Communication',
            'display' => 1,
        ],
        'design' => [
            'name' => 'Design',
            'display' => 1,
        ],
        'education' => [
            'name' => 'Enseignement',
            'display' => 0,
        ],
        'large_distribution' => [
            'name' => 'Grande Distribution',
            'display' => 0,
        ],
        'hotel' => [
            'name' => 'Hôtellerie',
            'display' => 0,
        ],
        'immovable' => [
            'name' => 'Immobilier',
            'display' => 0,
        ],
        'industry_production' => [
            'name' => 'Industrie : Production',
            'display' => 0,
        ],
        'industry_maintenance' => [
            'name' => 'Industrie : Maintenance',
            'display' => 0,
        ],
        'data_processing_hardware' => [
            'name' => 'Informatique : Hardware',
            'display' => 1,
        ],
        'data_processing_services' => [
            'name' => 'Informatique : Services',
            'display' => 1,
        ],
        'data_processing_web_development' => [
            'name' => 'Informatique : Développement Web',
            'display' => 1,
        ],
        'data_processing_ecommerce' => [
            'name' => 'Informatique : E-Commerce',
            'display' => 1,
        ],
        'internet' => [
            'name' => 'Internet',
            'display' => 1,
        ],
        'journalism' => [
            'name' => 'Journalisme',
            'display' => 1,
        ],
        'management' => [
            'name' => 'Management',
            'display' => 1,
        ],
        'marketing' => [
            'name' => 'Marketing / Merchandising',
            'display' => 1,
        ],
        'recruitment' => [
            'name' => 'Recrutement',
            'display' => 0,
        ],
        'network' => [
            'name' => 'Réseaux / Télécommunications',
            'display' => 1,
        ],
        'restoration' => [
            'name' => 'Restauration',
            'display' => 0,
        ],
        'health' => [
            'name' => 'Santé / Médical',
            'display' => 0,
        ],
        'sector_public' => [
            'name' => 'Secteur Public',
            'display' => 0,
        ],
        'security' => [
            'name' => 'Sécurité / Surveillance',
            'display' => 0,
        ],
        'sport' => [
            'name' => 'Sport / Coaching',
            'display' => 0,
        ],
        'tourism' => [
            'name' => 'Tourisme / Voyages',
            'display' => 0,
        ],
        'transport' => [
            'name' => 'Transports',
            'display' => 0,
        ],
    ],

];
