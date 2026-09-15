@include('errors._error-page', [
    'code' => '429',
    'title' => 'Trop de requêtes',
    'message' => 'Trop de tentatives en peu de temps. Patiente un instant avant de réessayer.',
])
