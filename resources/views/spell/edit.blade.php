@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <spell-edit :current-spell="{{ $spell }}"></spell-edit>
        </div>
    </section>
@endsection
