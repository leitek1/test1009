<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Конвертор валют</title>
</head>

<body>
    <form action="" method="post">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="row justify-content-start">
                        <div class="col-auto">
                            <h5>Конвертор валют</h5>
                            <h6>
                                <font color="gray">by Lukmanov R.</font>
                            </h6>
                        </div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-auto">
                            <h6>Из валюты:</h6>
                            <select class="form-select" aria-label="Default select example" name="from">
                                <?php foreach ($currenciesList as $key => $value) { ?>
                                    <option <?= $key == $from ? 'selected' : '' ?>>
                                        <?= $key ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-auto">
                            <h6>В валюту:</h6>
                            <select class="form-select" aria-label="Default select example" name="to">
                                <?php foreach ($currenciesList as $key => $value) { ?>
                                    <option <?= $key == $to ? 'selected' : '' ?>>
                                        <?= $key ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-auto">
                            <p>
                            <h6>Введите сумму:</h6>
                            </p>
                            <input class="form-control" name="amount" autocomplete="on" placeholder="Число" pattern="\d+(,\d{2})?" value="<?= $amount ?>">
                        </div>
                    </div>
                    <p></p>
                    <div class="row justify-content-center">
                        <div class="col-auto alert alert-success" role="alert">
                            <h6><?= $result ?></h6>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Конвертировать</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>