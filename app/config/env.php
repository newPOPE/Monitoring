<?php

return [
  'github'     => [
    'appId'     => getenv('GITHUB_APPID'),
    'appSecret' => getenv('GITHUB_APPSECRET'),
  ],
  'parameters' => [
    'administratorTeamId' => getenv('PARAMETERS_ADMINISTRATOR_TEAM_ID'),
    'slack'               => [
      'hookUrl' => getenv('SLACK_HOOKURL'),
    ],
  ],
  'console'    => [
    'url' => getenv('APP_URL'),
  ],
];

