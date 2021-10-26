@extends('layouts.app')

@section('content')

{{$nom}}

{{$courriel}}

{{$date_naissance}}
<div class="row">
    <div class="col s7 push-s5"><span class="flow-text">This div is 7-columns wide on pushed to the right by 5-columns.</span></div>
    <div class="col s5 pull-s7"><span class="flow-text">5-columns wide pulled to the left by 7-columns.</span></div>
</div>

@endsection