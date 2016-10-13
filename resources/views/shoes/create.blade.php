@extends('layouts.app')

@section('title', 'Add')

@section('content')
    <div class="box">
        <h1 class="title">Add Shoe</h1>

        <form action="{{ url('shoes') }}" method="POST">
            {{ csrf_field() }}

            <div class="columns">
                <div class="column is-6">
                    <label for="sku" class="label">SKU</label>
                    <p class="control">
                        <input id="sku" class="input" type="text" name="sku">
                    </p>
                </div>

                <div class="column is-6">
                    <label class="label">Date Released</label>
                    <p class="control">
                        <input class="input" type="text" name="date_released">
                    </p>
                </div>
            </div>

            <div class="columns">
                <div class="column is-4">
                    <label class="label">Gender</label>
                    <p class="control">
                        <span class="select is-fullwidth">
                            <select name="gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </span>
                    </p>
                </div>

                <div class="column is-4">
                    <label class="label">Quantity Sold</label>
                    <p class="control">
                        <input class="input" type="text" name="quantity_sold">
                    </p>
                </div>

                <div class="column is-4">
                    <label class="label">Price</label>
                    <p class="control">
                        <input class="input" type="text" name="price">
                    </p>
                </div>
            </div>

            <label class="label">Vendor</label>
            <div class="columns">
                <div class="column is-6">
                    <p class="control">
                        <input class="input" type="text" placeholder="Name" name="vendor_name">
                    </p>
                </div>

                <div class="column is-6">
                    <p class="control">
                        <input class="input" type="text" placeholder="Website" name="vendor_website"> 
                    </p>
                </div>
            </div>

            <label class="label">Inventory</label>
            <div id="inventory" class="control">
                <div class="columns inventory-item">
                    <div class="column is-6">
                        <input type="text" class="input" placeholder="Size" name="sizes[]">
                    </div>

                    <div class="column is-6">
                        <input type="text" class="input" placeholder="Count" name="counts[]">
                    </div>
                </div>
            </div>

            <template id="inventory-item-template">
                <div class="columns inventory-item">
                    <div class="column is-6">
                        <input type="text" class="input" placeholder="Size" name="sizes[]">
                    </div>

                    <div class="column is-6">
                        <input type="text" class="input" placeholder="Count" name="counts[]">
                    </div>
                </div>
            </template>

            <p class="control">
                <button id="add-size" type="button" class="button is-success">Add another size</button>
            </p>

            <p class="control">
                <label class="checkbox">
                    <input type="checkbox" name="on_sale">
                    On Sale
                </label>
            </p>

            <p class="control">
                <a href="{{ url('/') }}" class="button is-secondary">Cancel</a>
                <button class="button is-primary is-pulled-right">Submit</button>
            </p>
        </form>
    </div>

    <script type="text/javascript">
        $('#add-size').click(function (e) {
            $('#inventory').append(
                $('#inventory-item-template').html()
            );
        });
    </script>
@endsection