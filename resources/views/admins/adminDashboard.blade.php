@extends('layout')
@section('main')

@if(Auth::guard('admin')->check())
    <p>Welcome, Admin!</p>
    <iframe class="w-full h-screen sm:h-[500px] md:h-[700px] lg:h-screen" title="myApp" width="600" height="373.5" src="https://app.powerbi.com/view?r=eyJrIjoiZTk0NTA4ODktMmE5Ny00ZTkyLTlhNzUtYzA2OTAyMjY3MmE2IiwidCI6ImRiZDY2NjRkLTRlYjktNDZlYi05OWQ4LTVjNDNiYTE1M2M2MSIsImMiOjl9" frameborder="0" allowFullScreen="true"></iframe>
@endif

@if(Auth::guard('admin')->guest())
    <p>Please log in.</p>
@endif

@endsection
