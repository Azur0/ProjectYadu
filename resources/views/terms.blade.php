@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="col-sm">
            <h2>
                <b>{{__('terms.title')}}</b>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-left">
            {!! __('terms.content') !!}
        </div>
    </div>
@endsection
