@extends('layouts.app')

@section('title', 'View')

@section('content')
    <div class="columns">
        <div class="column is-6">
            <div class="box">
                <p>Time to search</p>
            </div>
        </div>
        <div class="column is-6">
            @foreach ($shoes as $shoe)
                @include('partials.shoe')
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        $('.delete-shoe').click(function (e) {
            $(this).parent().parent().find('.modal').addClass('is-active');
        });

        $('.modal-close, .modal-background, .cancel-delete').click(function (e) {
            $('.modal').removeClass('is-active');
        });
    </script>
@endsection