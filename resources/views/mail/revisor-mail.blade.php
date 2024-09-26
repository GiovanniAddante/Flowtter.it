<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>flowtter.it - Diventa revisore</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Kalam:wght@300;400;700&family=Rock+Salt&display=swap');
        *{
            font-family: "Kalam", cursive;
            font-size: 23px;
        }
        body{
            background: linear-gradient(to right, #A9D6E5, #61A5C2);
        }
        .custom-link{
            font-weight: bold;
            text-decoration: none;
            color: #01497C;
            background-color: #ffbf69;
            border-radius: 30px;
            padding: 5px 10px 5px 10px;
        }
    </style>
</head>

<body>
    <div>
        <h1 style="font-weight:bold; font-style:italic; font-size:30px; color: #e39906;"><span style="font-size:30px; color: #013A63;">{{ $user->name }}</span> ha richiesto di collaborare con il nostro
            team</h1>

        <h3 style="color: #e39906;">E-mail utente <span style="color: #01497C;">{{ $user->email }}</span> </h3>
        
        <h3 style="color: #e39906;">Messaggio utente</h3>
        <h5 style="color: #01497C;">{{ $description }}</h5>
        <p style="font-weight:bold; color: #e39906;">Se vuoi renderlo revisore clicca qui</p>
        <a role="button" class="custom-link" href="{{ route('make.revisor', compact('user')) }}">Rendi revisore</a>
    </div>
</body>

</html>
