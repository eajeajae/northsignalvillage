<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tech-service of Barangay North Signal</title>
</head>
<body>
    <h3>Good day our dear resident! Your complaint is {{$update['status']}}</h3>
    <p>Hello Sir/Ma'am {{$update['name']}}, your complaint to the respondent <span style="font-weight:bolder;">{{$update['respondentName']}}</span> about the <span style="font-weight:bolder;">{{$update['complaintDesc']}}</span> at #{{$update['locationAddress']}}, North Signal Village.
    <br>
    <p>Your first hearing is scheduled in <span style="font-weight:bolder;">{{$update['mediationSchedule']}},</span> and we will also notify the respondent regarding this first hearing.</p>
    <br>
    <p>Thank you for your patience and have a blessed day!</p>
    <p>Barangay North Signal Village</p>


</body>
</html>