<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>



    <!-- <h1>{{ $details['subject'] }}</h1> -->
    <!-- <h1>{{ $details['title'] }}</h1> -->
    <p>
    	cliquez ici pour réinitialiser votre mot de passe <a href="{{ route('varifyEmailToken', $details['body']) }}">Cliquez sur</a>

    </p>
    <p>Thank you</p>
</body>
</html>