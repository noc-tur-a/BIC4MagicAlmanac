@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <kind-show :current-kind="{{ $kind  }}"></kind-show>
        </div>
    </section>
@endsection

