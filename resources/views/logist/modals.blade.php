<div class="modal-body">
    <div class="form-group">
        <label for="">Продукт</label>
        <select data-search="true" required name="product" placeholder="Выберите Продукт" data-silent-initial-value-set="true">
            @foreach(\App\Models\Product::get() as $product)
                <option value="{{$product->id}}">{{$product->sku}} {{$product->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Количество дней</label>
        <input type="number" class="form-control" name="count_days" value="0" min="0">
    </div>
    <div class="form-group">
        <label for="">Склады</label>
        @foreach($wareHouses as $warehouse)
            <div class="form-check">
                <input class="form-check-input" name="warehouses[]" value="{{$warehouse->id}}" type="checkbox" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{$warehouse->name}}
                </label>
            </div>
        @endforeach
    </div>
    <div class="form-group mt-3">
        <button type="button" class="btn btn-primary">Рассчитать</button>

        <div class="form-group">
            <label for="">Рассчитанное количество</label>
            <input type="number" disabled step=".1" class="form-control">
        </div>
    </div>
</div>
