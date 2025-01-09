<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Calendar</title>
    <link rel="stylesheet" href="Styles/Book_appointment_Style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .calendar { width: 100%; }
        .calendar th, .calendar td { padding: 10px; text-align: center; }
        .calendar .header { background-color: #f2f2f2; }
        .calendar-cell { cursor: pointer; }
        .today { background-color: #ffe0b2; }
    </style>
    <script>
        $(document).ready(function() {
            $('.calendar-cell').click(function() {
                var date = $(this).data('date');
                window.location.href = 'index.php?page=Booked_tables_form&date=' + date;
            });
        });
    </script>
</head>
<body>

    <div class="calendar-container">
        <?php
            include("DB_Connect.php");

            function build_calendar($conn, $month, $year) {
                $stmt = $conn->prepare("SELECT DISTINCT DATE(Reservation_settings) AS booking_date FROM Reservation WHERE MONTH(Reservation_settings) = ? AND YEAR(Reservation_settings) = ?");
                $stmt->bind_param('ii', $month, $year);
                $bookedDates = array();

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $bookedDates[] = $row['booking_date'];
                    }
                    $stmt->close();
                }

                $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
                $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
                $numberDays = date('t', $firstDayOfMonth);
                $dateComponents = getdate($firstDayOfMonth);
                $monthName = $dateComponents['month'];
                $dayOfWeek = $dateComponents['wday'];
                $datetoday = date('Y-m-d');
                $calendar = "<table class='calendar table table-bordered'>";
                $calendar .= "<center><h2>$monthName $year</h2>";
                $calendar .= "<a class='btn btn-xs btn-primary' href='?page=Booked_tables&month=" . date('m', mktime(0, 0, 0, $month-1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month-1, 1, $year)) . "'>Previous Month</a> ";
                $calendar .= " <a class='btn btn-xs btn-primary' href='?page=Booked_tables&month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a> ";
                $calendar .= "<a class='btn btn-xs btn-primary' href='?page=Booked_tables&month=" . date('m', mktime(0, 0, 0, $month+1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month+1, 1, $year)) . "'>Next Month</a></center><br>";
                $calendar .= "<tr>";

                foreach ($daysOfWeek as $day) {
                    $calendar .= "<th class='header'>$day</th>";
                }

                $currentDay = 1;
                $calendar .= "</tr><tr>";

                if ($dayOfWeek > 0) {
                    for ($k = 0; $k < $dayOfWeek; $k++) {
                        $calendar .= "<td class='empty'></td>";
                    }
                }

                $month = str_pad($month, 2, "0", STR_PAD_LEFT);

                while ($currentDay <= $numberDays) {
                    if ($dayOfWeek == 7) {
                        $dayOfWeek = 0;
                        $calendar .= "</tr><tr>";
                    }

                    $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
                    $date = "$year-$month-$currentDayRel";
                    $today = $date == date('Y-m-d') ? "today" : "";

                    if (in_array($date, $bookedDates)) {
                        $calendar .= "<td class='calendar-cell $today' data-date='$date'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Booked</button></td>";
                    } else {
                        $calendar .= "<td class='calendar-cell $today' data-date='$date'><h4>$currentDay</h4> <button class='btn btn-primary btn-xs'>Available</button></td>";
                    }

                    $currentDay++;
                    $dayOfWeek++;
                }

                if ($dayOfWeek != 7) {
                    $remainingDays = 7 - $dayOfWeek;
                    for ($l = 0; $l < $remainingDays; $l++) {
                        $calendar .= "<td class='empty'></td>";
                    }
                }

                $calendar .= "</tr>";
                $calendar .= "</table>";

                echo $calendar;
            }

            $dateComponents = getdate();
            $month = isset($_GET['month']) ? $_GET['month'] : $dateComponents['mon'];
            $year = isset($_GET['year']) ? $_GET['year'] : $dateComponents['year'];

            build_calendar($conn, $month, $year);
        ?>
    </div>
    <br><br>
</body>
</html>
<?php
include("DB_Connect.php");

if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Retrieve reservations for the specified date
    $stmt = $conn->prepare("SELECT * FROM Reservation WHERE DATE(Reservation_settings) = ?");
    $stmt->bind_param('s', $date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Reservations for " . date("F d, Y", strtotime($date)) . "</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Reservation ID: " . $row['Reservation_ID'] . ", Customer ID: " . $row['Customer_ID'] . ", People: " . $row['People_number'] . ", Message: " . $row['Reservation_message'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h2>No reservations for " . date("F d, Y", strtotime($date)) . "</h2>";
    }

    $stmt->close();
}

$conn->close();
?>
