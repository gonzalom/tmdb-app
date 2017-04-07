@include('errors._error', [
    'title' => 'Page not found',
    'description' => 'Error 404. The requested URL was not found in this server.',
    'message' => $exception->getMessage(),
])
