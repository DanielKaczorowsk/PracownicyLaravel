@extends('layouts.index')
@section('listy')
@if(Auth::check())
<script>
  window.laravel = {!!json_encode([
      'zalogowany' => true,
      'user' => Auth::user(),
      'role' => Auth::user()->roles->first(),
      'zlecenia' => Auth::user()->obecne->all()
  ])!!}
</script>
@else
<script>
  window.laravel = {!!json_encode([
      'zalogowany' => false
  ])!!}
</script>
@endif
<div id='app'>
</div>
@endsection
