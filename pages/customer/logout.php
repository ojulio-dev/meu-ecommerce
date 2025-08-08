<?php

unset($_SESSION['customer']);

unset($_SESSION['cart']);

header("Location: index.php?page=customer");