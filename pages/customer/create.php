<?php

require_once(__DIR__ . '/../../models/Customer.php');

$customer = new Customer;

if (isset($_POST['submit'])) {
    $email = $customer->readByEmail($_POST['email']);

    if ($_POST['password'] == $_POST['confirm-password'] && !$email) {
        $create = $customer->create($_POST);

        if ($create) {
            $_SESSION['msg'] = "Cadastrado com sucesso!";
            header("Location: index.php?page=customer");
        } else {
            echo "Erro ao criar a conta";
        }
    } elseif ($_POST['password'] !== $_POST['confirm-password']) {
        $_SESSION['msg'] = "Digite a senha corretamente!"; ?>

        <div class="flash-message">
            <span class="ms erro"><?= $_SESSION['msg'] ?></span>
        </div>
    <?php unset($_SESSION['msg']);
    } elseif ($email) {
        $_SESSION['msg'] = "Email já cadastrado!"; ?>

        <div class="flash-message">
            <span class="ms erro"><?= $_SESSION['msg'] ?></span>
        </div>
    <?php unset($_SESSION['msg']);
    } else {
        $_SESSION['msg'] = "Algo deu errado :/"; ?>

        <div class="flash-message">
            <span class="ms erro"><?= $_SESSION['msg'] ?></span>
        </div>
<?php unset($_SESSION['msg']);
    }
}

?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<main class="customer-container">
    <h1 class="customer-main-title">Criar conta</h1>

    <div class="customer-form-wrapper">
        <form action="" class="customer-main-form" method="POST" enctype="multipart/form-data">
            <div class="customer-input-wrapper">
                <input type="text" name="name" placeholder="Nome" required>

                <input type="email" name="email" placeholder="E-mail" required>

                <div class="mb-3 customer-image" style="margin: 0 !important;">
                    <label for="formFile">
                        <p>Foto de Perfil</p>
                    </label>
                    <input class="form-control" type="file" accept="image/png, image/gif, image/jpeg, image/jpg, image/webp" id="formFile" name="image" required>
                </div>

                <input type="number" min="1" max="99" name="age" placeholder="Idade" required>

                <input type="password" name="password" placeholder="Senha" required>

                <input type="password" minlength="8" name="confirm-password" placeholder="Confime a senha" required>

                <button type="submit" name="submit" class="customer-main-button">Criar conta</button>
            </div>
        </form>
    </div>
</main>