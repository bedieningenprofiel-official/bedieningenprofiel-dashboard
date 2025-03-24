<?php

return [
    'headers' => [
        'localization' => [
            'header' => 'Languages',
            'subheader' => 'Select your preferred language',

            'button' => 'Save',
        ],
        'account_information' => [
            'header' => 'Account information',
            'subheader' => 'Update your account information',

            'fields' => [
                'avatar' => [
                    'header' => 'Click to upload or drag and drop an image',
                    'subheader' => 'PNG, JPG up to 2MB, MAX. 800px x 400px',
                ],
                'username' => 'Username',
                'name' => 'Full Name',
                'email' => 'Email',
                'password' => 'Password',
            ],

            'button' => 'Save',
        ],
        'current_plan' => [
            'header' => 'Current plan',
            'subheader' => 'View your current plan',

            'free' => 'Free',
            'pro' => 'Pro',
            'pro_plus' => 'Pro+',
            'admin_state' => 'Super Admin',

            'team_limit' => 'Teams: :current_amount / :plan_limit',
            'team_limit_exceeded' => 'You have exceeded the team limit for your current plan',
            'change_plan' => 'Change plan',
        ],
        'background_color' => [
            'header' => 'Background color',
            'subheader' => 'Select your preferred background color',

            'radio_group' => [
                'light' => 'Light',
                'dark' => 'Dark',
            ],

            'notification' => 'Your background color preference has been saved successfully',

            'button' => 'Save',
        ],
        'disband_church' => [
            'header' => 'Church',
            'subheader' => 'Various church settings',
        ],
    ],
];
