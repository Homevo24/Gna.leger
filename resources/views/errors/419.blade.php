@include('errors._error-page', [
    'code' => '419',
    'title' => 'Session expirée',
    'message' => 'Ta session a expiré, probablement parce que la page est restée ouverte trop longtemps. Réessaie.',
])
