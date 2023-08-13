<!DOCTYPE html>
<html>
<head>
    <title>اتصل بنا</title>
    <style>
        /* ستايلات CSS */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: grid;
            grid-gap: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Connect Us</h1>
    <div style="display: grid;
      grid-gap: 20px;">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">MESSAGE:</label>
        <textarea id="message" name="message" required></textarea>

        <button onclick="get_price()" id="send_btn" >SEND</button>
    </div>
</div>
</body>



<script>
    function get_price(){
        if (document.getElementById("name").value!="" && document.getElementById("email").value!="" && document.getElementById("message").value!=""){
            document.getElementById("send_btn").innerText="loadin";

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "https://9hztbl7p89.execute-api.us-east-1.amazonaws.com/api/api-form");


            const body = JSON.stringify({
                name:  document.getElementById("name").value,
                email:document.getElementById("email").value,
                message:document.getElementById("message").value

            });

            xhr.send(body);
            send_mail();





            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    document.getElementById("send_btn").innerText="Send done";
                    consol.log(xhr)
                }
            }

        }else{alert("Error in data")}}

        function send_mail() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "https://97e8dkcmj9.execute-api.us-east-1.amazonaws.com/default/ses-test");


            const body = JSON.stringify({
                name:  document.getElementById("name").value,
                email:document.getElementById("email").value,
                message:document.getElementById("message").value

            });

            xhr.send(body);
        }
</script>


</html>
