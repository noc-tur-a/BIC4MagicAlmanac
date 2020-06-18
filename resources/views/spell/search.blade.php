@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <spell-search :current-spells="{{ $spells }}" ></spell-search>
        </div>
    </section>
@endsection
