@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <spell-create :current-kinds="{{ $kinds }} "></spell-create>
            {{--<spell-create></spell-create>--}}

        </div>
    </section>
@endsection
