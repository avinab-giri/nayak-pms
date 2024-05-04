<?php
include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');


if (isset($_SESSION['ADMIN_ID'])) {
    redirect('index.php');
    die();
}

if(isset($_GET['access'])){
    $_SESSION['SUPER_ADMIN_ID'] = $_GET['access'];
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        $password = $_GET['pass'];
    
    
        $ipAddres = get_IP_address();
    
        if (!empty($username) || !empty($password)) {
    
            $sql = mysqli_query($conDB, "select * from hoteluser where ( userId='$username' OR email = '$username' OR phone = '$username') ");
            if (mysqli_num_rows($sql) > 0) {
    
                $sql = mysqli_query($conDB, "select * from hoteluser where ( userId='$username' OR email = '$username' OR phone = '$username') and password = '$password'");
    
                if ($password != '') {
                    if (mysqli_num_rows($sql) > 0) {
                        $sql = mysqli_query($conDB, "select * from hoteluser where ( userId='$username' OR email = '$username' OR phone = '$username') and password = '$password' and status='1'");
                        if (mysqli_num_rows($sql) > 0) {
                            $row = mysqli_fetch_assoc($sql);
                            $id = $row['id'];
                            $_SESSION['ADMIN_ID'] = $id;
                            $_SESSION['HOTEL_ID'] = hotelDetail($row['hotelMainId'])['hotelId'];                        
                            $alert = "<b>$username</b> username is login.";
                            $addBy = dataAddBy();
                            
                            setActivityFeed($_SESSION['HOTEL_ID'], '1', '', '', '', '', $ipAddres, 'success', $alert, $addBy);
                            $data = [
                                'error' => 'no',
                                'target' => 'success',
                                'msg' => ''
                            ];
    
                            redirect('index.php');
                            die();
                        } else {
                            setActivityFeed('', '1', '', '', '', '', $ipAddres, 'failed', 'Deactivate account', '');
                            $data = [
                                'error' => 'yes',
                                'target' => 'no',
                                'msg' => 'Deactivate your account!'
                            ];
                        }
                    } else {
                        setActivityFeed('', '1', '', '', '', '', $ipAddres, 'failed', 'Password not match', '');
                        $data = [
                            'error' => 'yes',
                            'target' => 'password',
                            'msg' => 'Password not match!'
                        ];
                    }
                }
            } else {
                setActivityFeed('', '1', '', '', '', '', $ipAddres, 'failed', 'Username not exist', '');
                $data = [
                    'error' => 'yes',
                    'target' => 'username',
                    'msg' => 'Username not exist!'
                ];
            }
        } else {
            $data = [
                'error' => 'yes',
                'target' => 'no',
                'msg' => 'All Fields Are Required'
            ];
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="favicons/img-apple-icon.png">
    <link rel="icon" type="image/png" href="favicons/img-favicon.png">

    <title> </title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link id="pagestyle" href="<?php echo FRONT_SITE ?>/css/getbootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo FRONT_SITE ?>/css/sweetalert.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <style>
        .login_section .signin_details h5 {
            font-size: 32px;
            font-weight: 800;
        }

        .login_section .signin_details .login_btn {
            text-align: center;
            padding: 30px 0px;
        }

       .login_section .signin_details .login_btn button {
            background-color: red;
            padding: 7px 47px;
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            border-radius: 24px;
            border: none;
        }
        .login_section .signin_details .login_btn button:hover {
            background-color: #454443;
            transition: 0.5s ease-in-out;
        }

        .login_section .forgot_sec ul {
            display: flex;
            justify-content: space-evenly;
        }

        .login_section .forgot_sec ul li {
            list-style-type: none;
        }

        .login_section .signin_details h5 {
            text-align: center;
        }

        .login_section .form {
            width: 63%;
            margin: auto;
            padding: 15px 38px;
            border-radius: 15px;
            background: linear-gradient(to right, #fa9c92 0%, #fac09d 100%);
        }
        .forgot_sec ul li a {
            text-decoration: none;
            color: #000;
            font-weight: 600;
            margin-right: 27px;
        }

        .forgot_sec ul li a:hover {
            color: red;
            transition: 0.5s ease-in-out;
        }

        .form label {
            font-size: 15px;
            font-weight: 700;
            line-height: 2.4;
            margin-left: 16px;
        }

        .form input {
            padding: 7px 27px;
            border-radius: 17px;
            background-color: #f1f1f1;
            border: aliceblue;
            width: -webkit-fill-available;
        }

        * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .calender_body body {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: 0 10px;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            min-height: 100vh;
            background: #ADD8E6;
            font-family: 'Helvetica Neue', sans-serif;
        }

        .wrapper header {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: 1px 34px 10px;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            background: #ffffff;
            border-radius: 10px 10px 0 0;
        }

        header .icons {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        header .icons span {
            height: 38px;
            width: 38px;
            margin: 0 1px;
            cursor: pointer;
            color: #878787;
            text-align: center;
            font-size: 1.9rem;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border-radius: 50%;
        }

        .icons span:last-child {
            margin-right: -10px;
        }

        header .icons span:hover {
            background: #f2f2f2;
        }

        header .current-date {
            font-size: 1.45rem;
            font-weight: 500;
            margin: auto;
            color: black;
            font-weight: 600;
        }
        .calender_body {
            height: 600px;
        }

        .calendar {
            padding: 20px;
        }

        .calendar ul {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            list-style: none;
            text-align: center;
        }

        .calendar .days {
            margin-bottom: 20px;
        }

        .calendar li {
            color: #333;
            width: calc(100% / 7);
            font-size: 1.07rem;
        }

        .calendar .weeks li {
            font-weight: 500;
            cursor: default;
        }

        .calendar .days li {
            z-index: 1;
            cursor: pointer;
            position: relative;
            margin-top: 30px;
        }

        .days li.inactive {
            color: #aaa;
        }

        .days li.active {
            color: #fff;
        }

        .days li::before {
            position: absolute;
            content: "";
            left: 50%;
            top: 50%;
            height: 40px;
            width: 40px;
            z-index: -1;
            border-radius: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .days li.active::before {
            background: #1e90ff;
        }

        .days li:not(.active):hover::before {
            background: #f2f2f2;
        }

        .flower_icon .flowers_img {
            position: fixed;
            left: 19px;
            bottom: 5px;
        }

        @import url("https://fonts.googleapis.com/css2?family=Lato&display=swap");

        .time_sec html {
            font-size: 62.5%;
        }

        .time_sec * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .time_sec body {
            font-family: "Lato", sans-serif;
            background: #272727;
            color: #ffd868;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .display-date {
            text-align: center;
            margin-bottom: 10px;
            font-size: 1.6rem;
            font-weight: 600;
        }

        .display-time {
            display: flex;
            font-size: 2rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: ease-in-out 0.1s;
            transition-property: background, box-shadow, color;
            -webkit-box-reflect: below 2px linear-gradient(transparent, rgba(255, 255, 255, 0.05));
            text-align: center;
            justify-content: center;
        }

        i {
            margin-left: -30px;
            cursor: pointer;
        }

        .login_section .row {
            height: 100vh;
            align-items: center;
        }
   
        .leaf_logo {
            text-align: left;
            position: absolute;
            left: 0;
        }
        .bg-gray-100 {
            background-color: #ffffff !important;
        }
        .retrod_logo {
            position: absolute;
            left: 0;
            right: 5%;
            text-align: end;
            top: 5%;
        }

</style>
</head>

<body class="g-sidenav-show  bg-gray-100">
			
    <section class="login_section">
        <div class="container">
		<div class="leaf_logo">
		    <img class="leaf_lg" src="img/tree_branch.png" alt="tree_branch">

		</div>
		<div class="retrod_logo">
				    <img class="retrod_lg" src="img/retrod_logos.png" alt="retrod_logos">
                                </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="calender_body my-5">
                        <div class="wrapper">
                            <header>
                                <p class="current-date"></p>
                                <div class="icons">
                                    <span id="prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                                        </svg>
                                    </span>

                                    <span id="next">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                        </svg>
                                    </span>
                                </div>
                            </header>

                            <div class="calendar">
                                <ul class="weeks">
                                    <li>Sun</li>
                                    <li>Mon</li>
                                    <li>Tue</li>
                                    <li>Wed</li>
                                    <li>Thu</li>
                                    <li>Fri</li>
                                    <li>Sat</li>
                                </ul>
                                <ul class="days">
                                    <ul class="days">
                                        <li class="inactive">26</li>
                                        <li class="inactive">27</li>
                                        <li class="inactive">28</li>
                                        <li class="inactive">29</li>
                                        <li class="inactive">30</li>
                                        <li class="">1</li>
                                        <li class="">2</li>
                                        <li class="">3</li>
                                        <li class="">4</li>
                                        <li class="">5</li>
                                        <li class="">6</li>
                                        <li class="">7</li>
                                        <li class="">8</li>
                                        <li class="">9</li>
                                        <li class="">10</li>
                                        <li class="">11</li>
                                        <li class="">12</li>
                                        <li class="">13</li>
                                        <li class="">14</li>
                                        <li class="">15</li>
                                        <li class="">16</li>
                                        <li class="">17</li>
                                        <li class="">18</li>
                                        <li class="">19</li>
                                        <li class="active">20</li>
                                        <li class="">21</li>
                                        <li class="">22</li>
                                        <li class="">23</li>
                                        <li class="">24</li>
                                        <li class="">25</li>
                                        <li class="">26</li>
                                        <li class="">27</li>
                                        <li class="">28</li>
                                        <li class="">29</li>
                                        <li class="">30</li>
                                        <li class="">31</li>
                                        <li class="inactive">1</li>
                                        <li class="inactive">2</li>
                                        <li class="inactive">3</li>
                                        <li class="inactive">4</li>
                                        <li class="inactive">5</li>
                                        <li class="inactive">6</li>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                        <div class="time_sec">
                            <div class="display-date">
                                <span id="day">day</span>,
                                <span id="daynum">00</span>
                                <span id="month">month</span>
                                <span id="year">0000</span>
                            </div>
                            <div class="display-time"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="signin_details my-5">
				
                        <form id="loginform" class="form">
                            <h5>Sign in</h5>
                            <label class="username" for="email"><br>Email</label>
                            <br>
                            <input type="text" placeholder="Enter email ID." id="username" name="username" required>
                            <br>
                            <label class="password" for="psw">Password</label>
                            <br>
                            <input type="password" placeholder="Enter password" name="password" required id="password">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>

                            <div class="login_btn">
                                <button type="submit">Login</button>
                            </div>
                            <div class="forgot_sec">
                                <ul>
                                    <li><a href="">Forget Password ?</a></li>
                                </ul>
                            </div>
                        </form>


                    </div>


                </div>
            </div>
            <div class="flower_icon">
                <img class="flowers_img" src="<?= FRONT_SITE_IMG ?>/dainty_flower_bouquet.png" alt="dainty_flower_bouquet">
            </div>
        </div>
    </section>

    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>

    <script>
        const daysTag = document.querySelector(".days");
        const currentDate = document.querySelector(".current-date");
        const prevNextIcon = document.querySelectorAll(".icons span");

        let currYear = new Date().getFullYear();
        let currMonth = new Date().getMonth();

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        const renderCalendar = () => {
            const date = new Date(currYear, currMonth, 1);
            let firstDayofMonth = date.getDay();
            let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
            let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay();
            let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();

            let liTag = "";

            for (let i = firstDayofMonth; i > 0; i--) {
                liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
            }

            for (let i = 1; i <= lastDateofMonth; i++) {
                let isToday = i === new Date().getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
                liTag += `<li class="${isToday}">${i}</li>`;
            }

            for (let i = lastDayofMonth; i < 6; i++) {
                liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
            }

            currentDate.innerText = `${months[currMonth]} ${currYear}`;
            daysTag.innerHTML = liTag;
        };

        renderCalendar();

        prevNextIcon.forEach(icon => {
            icon.addEventListener("click", () => {
                currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

                if (currMonth < 0 || currMonth > 11) {
                    currYear = icon.id === "prev" ? currYear - 1 : currYear + 1;
                    currMonth = currMonth < 0 ? 11 : 0;
                }

                renderCalendar();
            });
        });

        const displayTime = document.querySelector(".display-time");
        // Time
        function showTime() {
            let time = new Date();
            displayTime.innerText = time.toLocaleTimeString("en-US", {
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
            });
            setTimeout(showTime, 1000);
            // console.log(time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }));
        }

        showTime();

        // Date
        function updateDate() {
            let today = new Date();

            // return number
            let dayName = today.getDay(),
                dayNum = today.getDate(),
                month = today.getMonth(),
                year = today.getFullYear();

            const months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];
            const dayWeek = [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ];
            // value -> ID of the html element
            const IDCollection = ["day", "daynum", "month", "year"];
            // return value array with number as a index
            const val = [dayWeek[dayName], dayNum, months[month], year];
            for (let i = 0; i < IDCollection.length; i++) {
                document.getElementById(IDCollection[i]).firstChild.nodeValue = val[i];
            }
        }

        updateDate();

        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        // prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function(e) {
            e.preventDefault();
        });


        function checkLogin($username = '', $pass = '', $submit = '') {
            var username = $username;
            var pass = $pass;
            var submit = $submit;
            var usernameError = $('#usernameError');
            var passwordError = $('#passwordError');
            usernameError.html('');
            passwordError.html('');

            $.ajax({
                url: "<?= FRONT_SITE . '/include/ajax/login.php' ?>",
                type: 'post',
                data: {
                    type: 'checkLogin',
                    username: username,
                    pass: pass,
                    submit: submit,
                },
                success: function(data) {
                    var result = JSON.parse(data);
                    var error = result.error;
                    var target = result.target;
                    var msg = result.msg;

                    if (error == 'yes') {
                        sweetAlert(msg, 'error');
                    }

                    if (error == 'no') {
                        if (target == 'success') {
                            window.location.href = "<?= FRONT_SITE ?>";
                        }
                    }
                }
            });
        }

        $(document).on('submit', '#loginform', function(e) {
            e.preventDefault();
            var username = $('#username').val().trim();
            var password = $('#password').val().trim();
            checkLogin(username, password, 'yes');
        });
    </script>
</body>

</html>