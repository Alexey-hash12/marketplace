<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создание рекламной компании</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="">Тип</label>
                        <select class="form-control" name="TYPE" required id="">
                            <option value="П">П</option>
                            <option value="К">К</option>
                            <option value="КТ">КТ</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Управление</label>
                        <select class="form-control" name="CONTROL" required id="">
                            <option value="А">А</option>
                            <option value="Р">Р</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Артикул</label>
                        <input class="form-control" type="text" name="SKU" value="{{$id ?? ''}}" required placeholder="Укажите Артикул">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Нужное место</label>
                        <input class="form-control" type="text" name="POSMAX" placeholder="Укажите Нужное место">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Макс Ставка</label>
                        <input class="form-control" type="text" name="BIDMAX" required placeholder="Укажите Макс Ставку">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Период Показа</label>
                        <input class="form-control" type="text" name="PERIOD" required placeholder="Укажите Период Показа">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Бюджет</label>
                        <input class="form-control" type="text" name="BUDGET" required placeholder="Укажите Бюджет">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Примечание</label>
                        <input class="form-control" type="text" name="NOTES" placeholder="Укажите Примечание">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="update-product" action="" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Изменение рекламной компании</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="">Статус</label>
                        <input id="status-field"  disabled readonly class="form-control" type="text">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Тип</label>
                        <input id="type-field" disabled readonly class="form-control" type="text" name="TYPE" required placeholder="Укажите Тип">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Управление</label>
                        <input id="control-field" class="form-control" type="text" name="CONTROL" required placeholder="Укажите Управление">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Артикул</label>
                        <input readonly disabled id="article-field" class="form-control" type="text" name="SKU" value="{{$id ?? ''}}" required placeholder="Укажите Артикул">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Нужное место</label>
                        <input id="pos-max-field" class="form-control" type="text" name="POSMAX" placeholder="Укажите Нужное место">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Макс Ставка</label>
                        <input id="bid-max-field" class="form-control" type="number" name="BIDMAX" placeholder="Укажите Макс Ставку">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Период Показа</label>
                        <input id="period-field" class="form-control" type="text" name="PERIOD" placeholder="Укажите Период Показа">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Бюджет</label>
                        <input id="budget-field" class="form-control" type="text" name="BUDGET" placeholder="Укажите Бюджет">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Примечание</label>
                        <input id="notes-field" class="form-control" type="text" name="NOTES" placeholder="Укажите Примечание">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex" style="justify-content: space-between;width: 100%;">
                        <div class="d-flex" style="column-gap: 8px;">
                                <a id="btn-stop" class="btn btn-warning">Приостановить</a>
                                <a id="btn-start" class="btn btn-success">Запустить</a>
                                <a id="btn-archive" class="btn btn-danger">Остановить</a>
                        </div>
                        <div>
                            <div class="d-flex" style="column-gap: 8px;">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

