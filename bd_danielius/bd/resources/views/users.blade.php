@extends('layout')
@section('title', 'Danieliaus paslaugos')
@section('content')
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="user-list">
                @foreach($users as $user)
                    <div class="user-item" data-user-id="{{$user->id}}">
                        <div class="user-details">
                        <h3>{{$user->name}}</h3>
                        <p>{{$user->email}}</p>
                        <p>{{$user->phoneNumber}}</p>
                        <p><b>Vartotojo teisės: </b>{{$user->role}}</p>
                        </div>
                        <div class="action-buttons">
                    <button onclick="showEditPopup({{$user->id}})">Koreguoti</button>
                </div>
                    </div>
                @endforeach
            </div>

            <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditPopup()">&times;</span>
            <h2>Koreguoti vartotoją</h2>
            <form id="editForm">
                <div id="errorMessage" style="display: none; color: red; margin-bottom:10px;"></div>
                <input type="hidden" id="userId" name="userId">
                <input type="text" id="userName" name="userName" placeholder="Name">
                <input type="email" id="userEmail" name="userEmail" placeholder="Email">
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="phoneNumber">
                <select id="userRole" name="userRole">
                    @foreach($roles as $option)
                            <option value="{{$option->id}}">{{$option->roleName}}</option>
                    @endforeach
                </select>
                <button type="submit">Išsaugoti</button>
            </form>
        </div>
    </div>

<script>
    // klaidų atvaizdavimui funkcija
    function displayErrorMessage(message) {
        const errorMessageElement = document.getElementById('errorMessage');
        errorMessageElement.textContent = message;
        errorMessageElement.style.display = 'block';
    }

    // klaidų išvalymui skirta funkcija
    function clearErrorMessage() {
        const errorMessageElement = document.getElementById('errorMessage');
        errorMessageElement.textContent = '';
        errorMessageElement.style.display = 'none';
    }

    // atvaizduoti vartotojo koregavimo papildomą langą
    function showEditPopup(userId) {
        var currentRole;
        document.getElementById('editModal').style.display = 'block';
        fetch(`/getUserById/${userId}`) 
        .then(response => response.json())
        .then(data => {
            document.getElementById('userId').value = data.id;
            document.getElementById('userName').value = data.name;
            document.getElementById('userEmail').value = data.email;
            document.getElementById('phoneNumber').value = data.phoneNumber;
        })
        .catch(error => console.error('Klaida išgaunant duomenis:', error));
    }

    // uždaryti papildomą koregavimo langą
    function closeEditPopup() {
        document.getElementById('editModal').style.display = 'none';
    }

    // laukiama kol bus baigtas koregavimas ir vartotojas išsaugos pakitimus
    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const selectedOption = document.getElementById('userRole').options[document.getElementById('userRole').selectedIndex];
        const roleRealName = selectedOption.textContent;
        const formData = {
            user_id: document.getElementById('userId').value,
            name: document.getElementById('userName').value,
            email: document.getElementById('userEmail').value,
            phoneNumber: document.getElementById('phoneNumber').value,
            role: roleRealName
        };

        fetch('/editUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Klaida koreguojant duomenis');
            }
            return response.json();
        })
        .then(data => {
            const uID = document.getElementById('userId').value;
            const userElement = document.querySelector(`.user-item[data-user-id="${uID}"]`);
            if (userElement) {
                userElement.querySelector('h3').textContent = document.getElementById('userName').value;
                userElement.querySelector('p:nth-of-type(1)').textContent = document.getElementById('userEmail').value;
                userElement.querySelector('p:nth-of-type(2)').textContent = document.getElementById('phoneNumber').value;
                userElement.querySelector('p:nth-of-type(3)').innerHTML = '<b>Vartotojo teisės:</b> ' + roleRealName;        
            }
            closeEditPopup();
        })
        .catch(error => {
            console.error('Klaida koreguojant duomenis:', error);
            displayErrorMessage('Klaida koreguojant vartotojo duomenis');
        });
    });
    </script>

    </body>
</html>
@endsection