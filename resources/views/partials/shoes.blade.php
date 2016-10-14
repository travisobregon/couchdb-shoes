<div id="all-shoes" class="js-shoe-view">
    @foreach ($allShoes as $shoe)
        @include('partials.shoe')
    @endforeach    
</div>

<div id="on-sale-shoes" class="js-shoe-view is-hidden">
    @foreach ($onSaleShoes as $shoe)
        @include('partials.shoe')
    @endforeach
</div>

<div id="popular-vendor-shoes" class="js-shoe-view is-hidden">
    <ul>
        @foreach ($popularVendorShoes as $shoe)
            <li><strong>{{ $shoe['key'] }}</strong> has sold {{ $shoe['value'] }} pairs</li>
        @endforeach
    </ul>
</div>

<div id="most-money-made-shoes" class="js-shoe-view is-hidden">
    <ul>
        @foreach ($mostMoneyMadeShoes as $shoe)
            <li><strong>{{ $shoe['key'] }}</strong> has made ${{ $shoe['value'] }}</li>
        @endforeach
    </ul>
</div>

<div id="most-pairs-available-shoes" class="js-shoe-view is-hidden">
    <ul>
        @foreach ($mostPairsAvailableShoes as $shoe)
            <li><strong>{{ $shoe['key'] }}</strong> has {{ $shoe['value'] }} total pairs left</li>
        @endforeach
    </ul>
</div>
