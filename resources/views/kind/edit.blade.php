@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <kind-edit :current-kind="{{ $kind }}"></kind-edit>
        </div>
    </section>
@endsection
