@include('errors._error', [
    'title' => 'Server Error',
    'description' => 'It\'s not you, it\'s us. Give it another try.',
    // 'message' => $exception->getMessage(), // We don't want to saw a server error.
])
