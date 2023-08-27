<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div>
            <h1 id="name">
                Client
            </h1>
        </div>
        <div id="status">
            Not connected
        </div>
        <div class="guilds">
        </div>
    </div>
    <script>
        async function load(userId, token, accessToken) {
            openSocket(userId);
            
            
            fetch("https://discord.com/api/users/@me/guilds", {
                headers: {
                    authorization: `${token} ${accessToken}`,
                },
            })
                .then(result => result.json())
                .then(response => {
                    console.log(response)
                    //$(".guilds").append("<button>" + guild.name + "</button>");
                    let idsToCheck = "checkBeebot-"+userId+"-";
                    let ids ="";
                    response.forEach((guild) => {
                        if (guild.permissions == "2147483647")
                            ids += guild.id + "/";
                    });
                    sendMsg(idsToCheck+ids)

                })
                .catch(console.error);
        }


    </script>
    <?php
        require __DIR__ . '/database.php';

        $user_id = $_SESSION['id'];
        $token = $_SESSION['tokenType'];
        $accessToken = $_SESSION['accessToken'];
        //getUserSounds($user_id);
        //getGuildSettings('474935164451946506');
        echo '<script>load("'. $user_id .'", "'. $token .'", "'. $accessToken .'");</script>';
    ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+3&display=swap');
        body{
            font-family: 'Source Sans 3', sans-serif;
            background-color: #272934;
            color:white;
        }
        .guilds{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 40px;
            width: 100%;
            margin-top: 57px;
            margin-bottom: 60px;
        }
        @media (max-width: 1037px){
            .guilds {
                grid-template-columns: 1fr 1fr;
            }
            .container{
                width: unset !important;
            }
        }

        @media (max-width: 670px){
            .guilds {
                grid-template-columns: 1fr;
                margin-top: 40px;
            }
            .container {
                margin-top: 24px;
            }
        }
        .guild{
            width: 100%;
            background: #121212;
            border-radius: 10px;
            color: white;
            font-size: 25px; 
        }
        .guild:hover{
            background: #696969;
        }
        .imgGuild{
            object-fit: cover;
            height: 103px;
            width: 119px;
            position: relative;
            left: -2.1px;
            top: -1.1px;
        }

        .imgGuild img{
            width: 100%;
            height: 102%;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .container{
            margin: 40px auto 0px;
            width: min(100%, 932px);
            padding: 0px 40px;
            display: flex;
            flex-direction: column;
            -webkit-box-align: center;
            align-items: center;
            z-index: 1;
            position: relative;
        }

        table{
            border-collapse: collapse;
            height: 103px;
        }
    </style>
</body>

</html>