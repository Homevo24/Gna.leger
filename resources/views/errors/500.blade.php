@include('errors._error-page', [
    'code' => '500',
    'title' => 'Erreur serveur',
    'message' => "Une erreur inattendue s'est produite. Réessaie dans un instant.",
])
