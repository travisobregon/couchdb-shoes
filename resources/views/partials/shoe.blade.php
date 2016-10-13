<div class="card is-fullwidth shoe">
    <header class="card-header">
        <p class="card-header-title">
            {{ $shoe['_id'] }}
        </p>
        
        <a class="card-header-icon" style="padding-right: 10px; width: auto;">
            @if ($shoe['on_sale'])
                <span class="tag is-info">On Sale</span>
                &nbsp;
            @endif

            <span class="tag is-success">${{ $shoe['price'] }}</span>
        </a>
    </header>

    <div class="card-content">
        <div class="content">
            This shoe is supplied by <a target="_blank" href="{{ $shoe['vendor']['website'] }}">{{ $shoe['vendor']['name'] }}</a> and it is designed for {{ lcfirst(str_plural($shoe['gender'])) }}.

            {{ $shoe['quantity_sold'] }} pairs have been sold.<br>

            The following sizes are available:
            <ul>
                @foreach ($shoe['inventory'] as $pair)
                    <li>{{ $pair['size'] }} - {{ $pair['count'] }} left</li>
                @endforeach
            </ul>

            <small>Released {{ $shoe['date_released'] }}</small>
        </div>
    </div> 

    <footer class="card-footer">
        <a href="{{ url('shoes/'.$shoe['_id'].'/edit') }}" class="card-footer-item"><i class="fa fa-pencil"></i> &nbsp; Update</a>
        <a class="card-footer-item delete-shoe"><i class="fa fa-trash"></i> &nbsp; Delete</a>
    </footer>

    <div id="{{ $shoe['_id'] }}-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <section class="modal-card-body" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                <p>Are you sure you want to delete {{ $shoe['_id'] }}?</p>
            </section>
            <footer class="modal-card-foot">
                <form action="{{ url('shoes/'.$shoe['_id'].'/'.$shoe['_rev']) }}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    
                    <button type="submit" class="button is-danger">I'm sure</button>
                    <button type="button" class="button is-secondary cancel-delete">Nope</button>
                </form>
            </footer>
        </div>
        <button class="modal-close"></button>
    </div>
</div>