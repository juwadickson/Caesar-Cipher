<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caeser Cipher By Akinyooye Toheeb</title>
</head>
<style>
    *{
        padding: 0;
        margin: 0;
    }
    .container{
        background-color: rgb(0, 0, 0);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .contain{
        background-color: white;
        display: flex;
        flex-direction: column;
        gap:1rem;
        width: 48rem;
        padding: 3rem;
        border-radius: 5px;
        border-radius: 1px 5px 5px rgba(0, 0, 0, 0.281);
    }.input{
        display: flex;
        flex-direction: row;
        border: 1px solid #ccc;
        padding: 2rem;
    }
    .details{
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .details span{
        font-size: 12px;
        opacity: 0.7;
    }
    form{
        flex: 1;
        padding: 0 3rem ;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    h1{
        text-align: center;
        color: rgb(126, 0, 0);
    }
    h4{
        font-size:20px;
        color: green;
    }
    label{
        font-size: 20px;
        font-weight: 700;
    }
    input[type="text"]{
        padding: 0.7rem;
        border: none;
        outline: none;
        border-radius: 3px;
        background-color: rgba(0, 0, 0, 0.192);
        font-size: 16px;
    }
    input[type="submit"]{
        padding: 0.7rem;
        background-color: rgb(255, 145, 163);
        color: white;
        border-radius: 3px;
        border: none;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
    }
    input[type="submit"]:hover{
        background-color: rgb(250, 90, 116);
    }
    .output{
        width: 100%;
        padding: 1rem;
        background-color: #ccc;
    }
</style>
<body>
    <div class="container">
        <div class="contain">
            <div class="input">
                <div class="details">
                    <h1>Caesar Cipher</h1>
                    <span>
                        <b>Input File Format:</b><br>
                        [Shift Count]:[Encrypt/De-crypt]:[Alphabet 0-4]:Plain text/Cipher Text <br><br>
                        <b>Shift Count:</b> Number of shift
                        <b>Encrypt-></b>0 <b>Decrypt-></b> 1
                        <b>Alphabet(English-></b>0 <b>French-></b> 1 <b>Spanish-></b>2 <b>Turkey-></b> 3) <br><br>
                        <p>Input File Example - 4:0:0:Hello world</p>
                    </span>
                </div>
                <hr>
                <form action="" method="post">
                    <label for="inputFile">Input File :</label>
                    <input type="text" name="inputFile" id="inputFile" value="<?php if(isset($_POST['cipher'])){echo $_POST['inputFile'];}?>">
                    <input type="submit" value="Cipher" name="cipher">
                </form>
            </div>
            <div class="output">
                <span><b>Output: </b><?php include('cipher.php');?></span>
            </div>
        </div>
    </div>
    <script src="app.js"></script>
</body>
</html>