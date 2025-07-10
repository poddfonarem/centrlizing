<div class="site-section">
    <div class="container">
        <div class="justify-content-center text-center mb-5">
            <div class="col-md-12">
                <div class="heading-39101 mb-5">
                    <span class="backdrop text-center">ЗАЯВКА</span>
                    <span class="text-yellow bg-black font-weight-bold text-uppercase">Оформлення</span>
                    <h3>Заявки на Лізинг</h3>
                </div>
            </div>
        </div>
        <div class="site-section bg-image overlay my-rounded box-shadow" style="background-image: url('/assets/images/hero2.jpg')">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 ml-0 mb-5">
                        <form action="/incs/handlers/orders/add_order_handler.php" method="POST">
                            <div class="form-group row">
                                <div class="col-md-6 mb-4 mb-lg-0">
                                    <label for="name" class="d-none"></label>
                                    <input id="name" autocomplete="off" type="text" class="form-control box-shadow"
                                           name="user_name"
                                           placeholder="Введіть Ваше Імя" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="surname" class="d-none"></label>
                                    <input id="surname" type="text" class="form-control box-shadow" name="user_surname"
                                           placeholder="Введіть Ваше Прізвище" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="phone" class="d-none"></label>
                                    <input id="phone" autocomplete="off" type="tel" maxlength="12" class="form-control box-shadow"
                                           name="user_phone"
                                           placeholder="Введіть Ваш номер телефона" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="link" class="d-none"></label>
                                    <input id="link" type="text" class="form-control box-shadow" name="user_link"
                                           placeholder="Вставте посилання де знайшли авто" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="message" class="d-none"></label>
                                    <textarea id="message" name="user_message" class="form-control box-shadow"
                                              placeholder="Напишіть про бажану суму та стратегію повернення"
                                              cols="30" rows="8"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 mr-auto">
                                    <input type="submit" class="btn btn-primary text-white w-100 box-shadow"
                                           value="Відправити заявку">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 ml-auto">
                        <div class="bg-white p-5 p-md-5 mr-2 box-shadow my-rounded">
                            <ul class="list-unstyled footer-link">
                                <li class="d-block mb-3 text-black font-weight-bold">
                                    <i class="icon-pencil"></i> Приклад заповнення:
                                </li>
                                <li class="d-block mb-1">
                                    <span class="font-weight-bold text-uppercase">Ім'я:</span> Іван
                                    <span class="font-weight-bold text-uppercase">Прізвище:</span> Іванов
                                </li>
                                <li class="d-block mb-1">
                                    <span class="font-weight-bold text-uppercase">Телефон:</span> 380667654321
                                </li>
                                <li class="d-block mb-1">
                                    <span class="font-weight-bold text-uppercase">Посилання:</span>
                                    https://website.com/jetta7tsi
                                </li>
                                <li class="d-block mb-1">
                                    <span class="font-weight-bold text-uppercase">Опис:</span>
                                    Хочу отримати 8000$ на авто, повертатиму частинами, кожного місяця по
                                    800$, беру кошти на 10 місяців
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>