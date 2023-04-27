<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tech-service of Barangay North Signal</title>
</head>
<body>
    <h3>Good day our dear resident! Your vaccination schedule is {{$update['status']}}</h3>
    <p>Hello Sir/Ma'am {{$update['name']}}, your schedule for the vaccination of <span style="font-weight:bolder;">{{$update['vaccineName']}}</span> is on <span style="font-weight:bolder;">{{$update['date']}}</span> <span style="font-weight:bolder;">{{$update['time']}}</span>. Please <span style="font-weight:bolder; color:green;">SHOW THIS EMAIL NOTIFICATION</span> when you go to the health center for verification purposes.</p>
    <br>
    <p>Thank you and have a blessed day!</p>
    <p>Barangay North Signal Village</p>


</body>
</html>