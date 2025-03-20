<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .flip-clock {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .flip-clock div {
            background: #333;
            color: #fff;
            padding: 20px;
            margin: 5px;
            font-size: 2em;
            border-radius: 5px;
            text-align: center;
            width: 70px;
        }

        .label {
            display: block;
            font-size: 0.5em;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="flip-clock" id="countdown">
        <div>
            <span id="days">00</span>
            <span class="label">Days</span>
        </div>
        <div>
            <span id="hours">00</span>
            <span class="label">Hours</span>
        </div>
        <div>
            <span id="minutes">00</span>
            <span class="label">Minutes</span>
        </div>
        <div>
            <span id="seconds">00</span>
            <span class="label">Seconds</span>
        </div>
    </div>

    <script>
    function countdown(endDate) {
        let days, hours, minutes, seconds;

        endDate = new Date(endDate).getTime();

        if (isNaN(endDate)) return;

        setInterval(calculate, 1000);

        function calculate() {
            let startDate = new Date().getTime();
            let timeRemaining = parseInt((endDate - startDate) / 1000);

            if (timeRemaining >= 0) {
                days = parseInt(timeRemaining / 86400);
                timeRemaining = timeRemaining % 86400;

                hours = parseInt(timeRemaining / 3600);
                timeRemaining = timeRemaining % 3600;

                minutes = parseInt(timeRemaining / 60);
                timeRemaining = timeRemaining % 60;

                seconds = parseInt(timeRemaining);

                document.getElementById("days").textContent = parseInt(days, 10);
                document.getElementById("hours").textContent = ("0" + hours).slice(-2);
                document.getElementById("minutes").textContent = ("0" + minutes).slice(-2);
                document.getElementById("seconds").textContent = ("0" + seconds).slice(-2);
            } else {
                return;
            }
        }
    }

    (function () { 
        countdown("2025-03-27T00:00:00"); // Updated to March 27, 2025
    })();
</script>
</body>
</html>
