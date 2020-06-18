@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">

            <spell-show :current-spell="{{ $spell }}"></spell-show>
        </div>
    </section>
@endsection
