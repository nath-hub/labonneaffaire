<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <div class="boy">

        <div class="icone">
          <img src="https://raw.githubusercontent.com/nath-hub/caisse0/main/public/logo.png" height="100" width="100">
        </div>
        <div class="corp">
          <h1>CONFIRMATION DE L'ADRESSE E-MAIL </h1>
    
          <div class="hello">
            Hello. Veuillez cliquer sur le bouton ci-dessous pour activer votre compte sur <strong> La bonne affaire</strong>
          </div>
          <p style="display:none">{{$code}}</p>
    
          <div class="button">
            <button id="but"><a href="{{$lieu}}/{{$code}}">Valider mon compte </a> </button>
          </div>
    
    
          <p>&copy; 2023 <a href="labonneaffaire.com" >Labonneaffaire</a></p>
        </div>
      </div>
</body>
</html>