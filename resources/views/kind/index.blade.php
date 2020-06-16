@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            {{--<kind-list :current-kinds="{{ $kinds }} "></kind-list>--}}
            <kind-list></kind-list>

        </div>
    </section>
@endsection
