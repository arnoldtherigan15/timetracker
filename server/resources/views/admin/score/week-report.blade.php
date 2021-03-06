<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Report Week 1</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/alphardex/aqua.css@master/dist/aqua.min.css'>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #eceffc;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 0;
            overflow: hidden;
        }

        .btn::before {
            position: absolute;
            content: "";
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, var(--primary-color), transparent);
            transform: translateX(-100%);
            transition: 0.6s;
        }

        .btn:hover {
            background: transparent;
            box-shadow: 0 0 20px 10px rgba(51, 152, 219, 0.5);
        }

        .btn:hover::before {
            transform: translateX(100%);
        }

        .form-input-material {
            --input-default-border-color: white;
            --input-border-bottom-color: white;
        }

        .form-input-material input {
            color: white;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 0px;
            color: white;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            box-shadow: 0 0.4px 0.4px rgba(128, 128, 128, 0.109), 0 1px 1px rgba(128, 128, 128, 0.155), 0 2.1px 2.1px rgba(128, 128, 128, 0.195), 0 4.4px 4.4px rgba(128, 128, 128, 0.241), 0 12px 12px rgba(128, 128, 128, 0.35);
        }

        .login-form h1 {
            margin: 0 0 24px 0;
        }

        .login-form .form-input-material {
            margin: 15px 0;
        }

        .login-form .btn {
            width: 100%;
            margin: 18px 0 9px 0;
        }
    </style>

</head>

<body>
    <div style="width:25em">
        <!-- partial:index.partial.html -->
        <form class="login-form" action="javascript:void(0);">
            <div class="">
                <img src="./badge-gold.png" alt="" style="width: 20%; display: block; margin: auto;">
            </div>
            <br>
            <h1>Report Week 1</h1>
            <div class="form-input-material">
                <input type="text" name="username" id="username" placeholder=" " value="Teddy koerniadi"
                    autocomplete="off" class="form-control-material" required disabled style="font-size: larger;" />
                <label for="username">Student Name</label>
            </div>

            <div class="form-input-material">
                <input type="text" name="username" id="username" placeholder=" " value="RMT-10" autocomplete="off"
                    class="form-control-material" required disabled style="font-size: larger;" />
                <label for="username">Batch</label>
            </div>

            <div class="form-input-material">
                <input type="text" name="username" id="username" placeholder=" " value="Saved" autocomplete="off"
                    class="form-control-material" required disabled style="font-size: larger; color: green;" />
                <label for="username">Status</label>
            </div>

            <div class="form-input-material">
                <input type="text" name="username" id="username" placeholder=" " value="80 - 90" autocomplete="off"
                    class="form-control-material" required disabled style="font-size: larger;" />
                <label for="username">Week Range Score </label>
            </div>

            <div class="form-input-material">
                <input type="text" name="username" id="username" placeholder=" " value="0 - 0" autocomplete="off"
                    class="form-control-material" required disabled style="font-size: larger;" />
                <label for="username">Absent - Late</label>
            </div>
        </form>

        <br>
        <h1>Notes:</h1>
        <p style="width: auto;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto ut similique molestiae reiciendis, odio distinctio quisquam! Quae libero deserunt officia dolorum excepturi eius impedit ipsum, corrupti accusantium molestias eum enim!</p>
    </div>
</body>

</html>