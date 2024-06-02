@extends('layout')
@section('title','Apie mane')
@section('content')
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-image {
            width: 200px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        section {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
            width: 100%;
            max-width: 600px;
        }
        h2 {
            margin-top: 0;
        }
        .contact-info {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Mano Fotografijos Paslaugos</h1>
    </header>
    <div class="container">
        <img src="images/foto.jpg" alt="Mano nuotrauka" class="profile-image">
        <section>
            <h2>Apie Mane</h2>
            <p>Esu profesionalus fotografijos specialistas, specializuojantis į įvairias fotosesijas: šeimos, vestuvių, gamtos ir daugiau.</p>
        </section>
        <section>
            <h2>Teikiamos Paslaugos</h2>
            <ul>
                <li>Šeimos Fotosesijos</li>
                <li>Vestuvių Fotografavimas</li>
                <li>Gamtoje Fotografavimas</li>
                <!-- Pridėkite daugiau paslaugų pagal savo poreikius -->
            </ul>
        </section>
        <section>
            <h2>Kontaktai</h2>
            <p class="contact-info">Telefono numeris: <a href="tel:+37012345678">+370 123 45678</a></p>
            <p class="contact-info">El. paštas: <a href="mailto:info@fotografas.lt">danielius32123@gmail.com</a></p>
            <p class="contact-info">Fotostudijos adresas: Žirmūnų 102-13 Vilnius, Lietuva</p>
        </section>
    </div>
</body>
@endsection