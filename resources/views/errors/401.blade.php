@include('errors._error', [
    'title' => 'Unauthorized Access',
    'description' => 'You shouldn\'t be here o.O',
    'message' => $exception->getMessage(),
])
