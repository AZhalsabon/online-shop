<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Reistration Form</title>
</head>
<body>
<form action="/add-product" method="POST">
    < class="container">
    <div>
        <h1>Добавить товар в корзину.</h1>
        <?php  if (isset($_SESSION['user_id'])) {print_r("пользователь не авторизован.");}?>

        <label for="product_id"><b>Product_id</b></label>
            <?php if(isset($errors['product_id'])) {print_r ($errors['product_id']);}?>
        <input type="text" name="product_id" placeholder="Enter Product_id" required>

        <label for="amount"><b>Amount</b></label>
            <?php if(isset($errors['amount'])) {print_r ($errors['amount']);}?>
        <input type="text" placeholder="Enter amount" name="amount" required>

        <br>

        <div class="clearfix">

            <button type="submit" class="btn">Добавить в корзину</button>
        </div>
    </div>
    <a href="/catalog">каталог</a>
    <a href="/bascet">корзина</a>
</form>


</body>
</html>

<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500&display=swap');

    body {
        font-family: Montserrat,Arial, Helvetica, sans-serif;
        background-color:#f7f7f7;
    }
    * {box-sizing: border-box}

    /* Add padding to container elements */
    .container {
        padding: 20px;
        width:500px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border:1px solid #ccc;
        border-radius:10px;
        background:white;
        -webkit-box-shadow: 2px 1px 21px -9px rgba(0,0,0,0.38);
        -moz-box-shadow: 2px 1px 21px -9px rgba(0,0,0,0.38);
        box-shadow: 2px 1px 21px -9px rgba(0,0,0,0.38);
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f7f7f7;
        font-family: Montserrat,Arial, Helvetica, sans-serif;
    }
    select {
        width: 18%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f7f7f7;
        font-family: Montserrat,Arial, Helvetica, sans-serif;
    }

    input[type=phone] {
        width: 81%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f7f7f7;
    }

    input[type=text]:focus, input[type=password]:focus, input[type=phone]:focus, select:focus {
        background-color: #ddd;
        outline: none;
    }



    /* Set a style for all buttons */
    button {
        background-color: #0eb7f4;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
        font-size:16px;
        font-family: Montserrat,Arial, Helvetica, sans-serif;
        border-radius:10px;
    }

    button:hover {
        opacity:1;
    }


    /* Change styles for signup button on extra small screens */
    @media screen and (max-width: 300px) {
        .signupbtn {
            width: 100%;
        }
    }

    .youtubeBtn{
        position: fixed;
        right: 20px;
        transform:translatex(-50%);
        top: 20px;
        cursor: pointer;
        transition: all .3s;
        vertical-align: middle;
        text-align: center;
        display: inline-block;
        background:#000;
        padding:2px 10px;
        border-radius:5px;
    }
    .youtubeBtn i{
        font-size:20px;
        float:left;
    }
    .youtubeBtn a{
        color:#ff0000;
        animation: youtubeAnim 1000ms linear infinite;
        float:right;
    }
    .youtubeBtn a:hover{
        color:#c9110f;
        transition:all .3s ease-in-out;
    }
    .youtubeBtn i:active{
        transform:scale(.9);
        transition:all .3s ease-in-out;
    }
    .youtubeBtn span{
        font-family: 'Lato';
        font-weight: bold;
        color: #fff;
        display: block;
        font-size: 12px;
        float: right;
        line-height: 20px;
        padding-left: 5px;

    }

    @keyframes youtubeAnim{
        0%,100%{
            color:#c9110f;
        }
        50%{
            color:#ff0000;
        }
    }
</style>