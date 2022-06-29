<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.adminrecommendationshead')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body>
<div id="admin">
    @include('includes.usernav')

    <main class="py-4 my-wrapper">
        @section('main-content')
        @show
    </main>
    @include('includes.adminfooter')
</div>

</body>
</html>
