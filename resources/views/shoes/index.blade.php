@extends('layouts.app')

@section('title', 'View')

@section('content')
    <div class="box">
        <div class="columns">
            <div class="column is-4">
                @include('partials.view-aside')
            </div>

            <div class="column is-8">
                @include('partials.shoes')
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.delete-shoe').click(function (e) {
            $(this).parent().parent().find('.modal').addClass('is-active');
        });

        $('.modal-close, .modal-background, .cancel-delete').click(function (e) {
            $('.modal').removeClass('is-active');
        });

        $('#view-menu li a').click(function (e) {
            $('#view-menu li a').removeClass('is-active');
            $(this).addClass('is-active');

            $('.js-shoe-view').addClass('is-hidden');
            $('#'+$(this).attr('data-id')).removeClass('is-hidden');
        });
    </script>
@endsection