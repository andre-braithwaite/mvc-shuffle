<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Welcome to Shuffle</title>

        <!--<relative to -->
        <link rel="stylesheet" type="text/css" href="../public/style.css">

    </head>

    <body>

        <div class="global-style">

            <h1 class="page-heading">Welcome to shuffle</h1>
            <div class="divider"></div>

            <div class="form">
                <form action="process-login" method="get">

                    <input type="text" name="username" placeholder="username"/>
                    <div class="divider"></div>


                    <input type="password" name="password" placeholder="password"/>
                    <div class="divider"></div>

                    <button>login</button>



                    <button>new user</button>


                    <button style="background:darkred" type="button"
                            onmouseout="this.style.backgroundColor='darkred'";
                            onmouseover="this.style.backgroundColor='firebrick'">tools</button>

                </form>
            </div>
        </div>
    </body>
</html>