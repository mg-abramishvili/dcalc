<template>
    <div>
        <h1 class="h3 mb-4">Новый пользователь</h1>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Имя</label>
                    <input type="name" class="form-control" placeholder="Имя">
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-control" placeholder="E-mail">
                </div>

                <div class="mb-3 row">
					<label class="col-form-label col-sm-6 text-sm-right pt-sm-0">Может создавать расчеты</label>
                    <div class="col-sm-6">
                        <label class="form-check m-0">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label"></span>
                        </label>
                    </div>
				</div>

                <div class="mb-3 row">
					<label class="col-form-label col-sm-6 text-sm-right pt-sm-0">Может создавать КП</label>
                    <div class="col-sm-6">
                        <label class="form-check m-0">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label"></span>
                        </label>
                    </div>
				</div>

                <div class="mb-3 row">
					<label class="col-form-label col-sm-6 text-sm-right pt-sm-0">Может редактировать каталог</label>
                    <div class="col-sm-6">
                        <label class="form-check m-0">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label"></span>
                        </label>
                    </div>
				</div>

                <div class="mb-3 row">
					<label class="col-form-label col-sm-6 text-sm-right pt-sm-0">Может назначать задачи другим пользователям</label>
                    <div class="col-sm-6">
                        <label class="form-check m-0">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label"></span>
                        </label>
                    </div>
				</div>

                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </div>
</template>