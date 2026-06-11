<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ $title ?? 'Form Builder' }}</title>
  @include('includes.css')
  <link href="{{ asset('css/form-builder.css') }}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

@include('includes.navigation')

@yield('content')

<footer class="footer">
  <div class="container">
    <div class="row align-items-center flex-row-reverse">
      <div class="col-lg-12 col-sm-12 mt-3 mt-lg-0 text-center">
        Copyright &copy; {{ date('Y') }}
        <a href="javascript:void(0)" class="fs-14 text-primary">EduNet Foundation</a>.
        All rights reserved.
      </div>
    </div>
  </div>
</footer>

<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

@include('includes.js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
@stack('scripts')
</body>
</html>
