<?php

$env = getenv('APP_ENV');

$config = [
    'local-dev-git-access' => [
        'enabled' => $env === 'local',
        'repo_url' => 'https://github.com/Echo-EpxCode/iTrackRent.git',
        'token' => getenv('GIT_TOKEN')
    ]
];

if ($config['local-dev-git-access']['enabled']) {
    // Allow Git operations
    echo "Git access allowed (local only)";
} else {
    // Block access
    echo "Git access denied (non-local environment)";
}
