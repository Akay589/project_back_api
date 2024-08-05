<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
</head>
<body>
       <p>Bonjour,</p>
      <p>{{ $data['body1'] }}</p>
      <p>{{ $data['body2'] }}</p>
     <a href="{{ $data['url'] }}">Reinitialiser</a>
       <p>Merci.</p>

</body>
</html>
