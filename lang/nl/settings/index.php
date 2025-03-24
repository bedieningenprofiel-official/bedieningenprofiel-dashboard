<?php

return [
    'headers' => [
        'localization' => [
            'header' => 'Taalinstellingen',
            'subheader' => 'Selecteer uw voorkeurstaal',

            'button' => 'Opslaan',
        ],
        'account_information' => [
            'header' => 'Accountinformatie',
            'subheader' => 'Werk je accountinformatie bij',

            'fields' => [
                'avatar' => [
                    'header' => 'Klik om een afbeelding te uploaden of sleep en zet neer',
                    'subheader' => 'PNG, JPG tot 2MB, MAX. 800px x 400px',
                ],
                'username' => 'Gebruikersnaam',
                'name' => 'Volledige naam',
                'email' => 'E-mail',
                'password' => 'Wachtwoord',
            ],

            'button' => 'Opslaan',
        ],
        'current_plan' => [
            'header' => 'Huidig plan',
            'subheader' => 'Bekijk uw huidige plan',

            'free' => 'Gratis',
            'pro' => 'Pro',
            'pro_plus' => 'Pro+',
            'admin_state' => 'Super Admin',

            'team_limit' => 'Teams: :current_amount / :plan_limit',
            'team_limit_exceeded' => 'U heeft de teamlimiet voor uw huidige plan overschreden',
            'change_plan' => 'Verander plan',
        ],
        'background_color' => [
            'header' => 'Achtergrondkleur',
            'subheader' => 'Selecteer uw voorkeursachtergrondkleur',

            'radio_group' => [
                'light' => 'Licht',
                'dark' => 'Donker',
            ],

            'notification' => 'Uw achtergrondkleurvoorkeur is succesvol opgeslagen',

            'button' => 'Opslaan',
        ],
    ],
];
