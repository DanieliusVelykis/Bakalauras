<?php
$userRole = "";
?>
@if (Auth::check()) 
	<?php $userRole = auth()->user()->role; ?>
@endif


@extends('layout')
@section('title', 'Danieliaus paslaugos')
@section('content')
<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="user-list">
        @foreach($reservations as $reservation)
            <div class="user-item" data-user-id="{{$reservation->id}}">
                <div class="user-details">
                <h3 style="margin-bottom:15px;">{{$reservation->name}}</h3>
                        <label class="label">Klientas:</label>
                        <p>{{$reservation->userName}}</p>
                        <label class="label">Paslauga:</label>
                        <p>{{$reservation->serviceName}}</p>
                        <label class="label">Kaina:</label>
                        <p>{{$reservation->price}}</p>
                        <label class="label">Rezervacijos data ir laikas:</label>
                        <p>{{$reservation->reservedDate}} laikas: {{$reservation->reservedTime}}</p>
                        <label class="label">Statusas:</label>
                        <p>{{$reservation->reservationStatus}}</p>
                        <a>------------</a><br>
                        <a href="#" onclick="additionalService({{$reservation->id}})" style="color:blue">Papildomos paslaugos</a>
                        <div id="additional_{{$reservation->id}}"></div>
                </div>
                <div class="button-container">
                    <div class="action-buttons">
                        <button onclick="showEditPopup({{$reservation->id}})">Koreguoti</button>
                    </div>
                    <div class="action-buttons">
                        <button onclick="commentsWindow({{$reservation->id}},{{auth()->user()->id}})">Komentarai</button>
                    </div>
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
                <label>Klientas</label>
                <input type="text" id="client" clientId="" name="client" placeholder="Name">
                <label>Paslaugos pavadinimas</label>
                <input type="text" id="service" serviceId="" name="service" placeholder="Name">
                <label>Rezervuota data</label>
                <input type="text" id="reservedDate" name="reservedDate" placeholder="Name">
                <label>Rezervuotas laikas</label>
                <input type="text" id="reservedTime" name="reservedTime" placeholder="Name">
                <label>Apmokėjimo tipas</label>
                <input type="text" id="paymentType" name="paymentType" placeholder="Name">
                <label>Statusas</label>
                <select id="userRole" name="userRole">
                <option value="acive-paid-notconfirmed">Pateikta apmokėta</option>
                <option value="acive-paid-confirmed">Pateikta patvirtinta</option>
                <option value="acive-paid-confirmed">Pateikta dalinai apmokėta</option>
                <option value="acive-paid-confirmed">Pateikta dalinai apmokėta patvirtinta</option>
                <option value="acive-paid-cancelled">Atlikta</option>
                <option value="acive-paid-cancelled">Atšaukta</option>
                <option value="acive-paid-declined">Atmesta</option>
                </select>
                <button type="submit">Išsaugoti</button>
            </form>
        </div>
    </div>

    <div id="commentsModal" class="modal">
			<div style="display:none" id="user"></div>
			<div style="display:none" id="reservation"></div>
			<span class="close" onclick="closeCommentPopup()">&times;</span>
			<div class="modal-content">
			<div class="commentModal">
			</div>
			<label>Palikite komentarą</label>
			<textarea id="comment" name="longText" rows="4" cols="50"></textarea> 
			<button class="reserve" onclick="addNewComment()">Pridėti</button>
			</div>
		</div>


<script>

    // užkrauti papildomas paslaugas pagal tam tikrą rezervaciją
    function additionalService(reservationId){
        event.preventDefault();
        fetch(`/additional-service/${reservationId}`, {
				method: 'GET',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				}
		})
		.then(response => {
			if (!response.ok) {
				throw new Error('Klaida gaunant rezervacijos papildomus duomenis');
			}
			return response.json();
		})
		.then(data => {
            const workerServices = data.workerServices;
            workerServices.forEach(service => {
                const reservationId = service.reservationId;
                const additionalDiv = document.getElementById('additional_' + reservationId);
                const listItem = document.createElement('li');
                listItem.textContent = service.additionalServiceName;
                additionalDiv.appendChild(listItem);
            });
		});
    }

    // pridėti papildomą komentarą prie paslaugos rezervacijos
    function addNewComment(){
        const userRoleLogged = <?php echo json_encode($userRole); ?>;
        const window = document.getElementById('commentsModal');
        const comment = document.getElementById('comment').value;
        const reservationIdentification = document.getElementById('reservation').textContent;
        const userIdentification = document.getElementById('user').textContent;
        const modalContent = window.querySelector('.commentModal');

        fetch(`/addComment`,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                reservationId:reservationIdentification,
                userId: userIdentification,
                comment: comment
            })
        }).then(response => {
            if(!response.ok){
                throw new Error('Klaida gaunant komentarus: ' + response.statusText);
            }else{
            fetch(`/getComments`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                userId: userIdentification,
                reservationId: reservationIdentification
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Klaida gaunant komentarus: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            modalContent.innerHTML = '';
            document.getElementById('comment').value = "";
            data.forEach(comment => {
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('comment');

                const commentText = document.createElement('p');
                commentText.textContent = comment.comment;

                const commentDate = document.createElement('span');
                commentDate.classList.add('comment-date');
                commentDate.textContent = new Date(comment.created_at).toLocaleString();

                const commenter = document.createElement('span');
                if(comment.admin === "yes") commenter.textContent = "-Fotografas";
                else{
                    if(userRoleLogged === "Fotografas") commenter.textContent = "-Klientas";
                    else commenter.textContent = "-Aš";
                }

                commenter.style.fontSize = '10px';
                commenter.style.fontWeight = 'bold';

                commentDiv.appendChild(commentText);
                commentDiv.appendChild(commentDate);
                commentDiv.appendChild(commenter);

                modalContent.appendChild(commentDiv);
            });
            window.style.display = 'block';
        })
        .catch(error => {
            console.error('Klaida:', error);
        });
            }
        })
    }

    // uždaryti komentaro pridėjimo papildomą langą
    function closeCommentPopup(){
        const window =document.getElementById('commentsModal');
        window.style.display = 'none';
    }

    // komentarų lango valdymas
    function commentsWindow(resID, userId) {
        const userRoleLogged = <?php echo json_encode($userRole); ?>;
        const window = document.getElementById('commentsModal');
        const modalContent = window.querySelector('.commentModal');
        const userIdentification = document.getElementById('user');
        userIdentification.textContent = userId;
        const reservationIdentification = document.getElementById('reservation');
        reservationIdentification.textContent = resID;
        fetch(`/getComments`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                userId: userId,
                reservationId: resID
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Klaida gaunant komentarus: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            modalContent.innerHTML = '';

            data.forEach(comment => {
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('comment');

                const commentText = document.createElement('p');
                commentText.textContent = comment.comment;

                const commentDate = document.createElement('span');
                commentDate.classList.add('comment-date');
                commentDate.textContent = new Date(comment.created_at).toLocaleString();

                const commenter = document.createElement('span');
                if(comment.admin === "yes") commenter.textContent = "-Fotografas";
                else{
                    if(userRoleLogged === "Fotografas") commenter.textContent = "-Klientas";
                    else commenter.textContent = "-Aš";
                }

                commenter.style.fontSize = '10px';
                commenter.style.fontWeight = 'bold';
                
                commentDiv.appendChild(commentText);
                commentDiv.appendChild(commentDate);
                commentDiv.appendChild(commenter);

                modalContent.appendChild(commentDiv);
            });
            window.style.display = 'block';
        })
        .catch(error => {
            console.error('Klaida:', error);
        });
    }

    // rezervacijos koregavimo atvaizdavimas išgaunant visus duomenis
    function showEditPopup(userId) {
        var currentRole;
        document.getElementById('editModal').style.display = 'block';
        fetch(`/getReservationById/${userId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('userId').value = data.id;
            document.getElementById('client').value = data.userName;
            document.getElementById('service').value = data.serviceName;
            document.getElementById('reservedDate').value = data.reservedDate;
            document.getElementById('reservedTime').value = data.reservedTime;
            document.getElementById('paymentType').value = data.paymentType;
            const inputElement = document.getElementById('client');
            inputElement.setAttribute('clientId', data.userId);
            const inputElements = document.getElementById('service');
            inputElements.setAttribute('serviceId', data.serviceId);
        })
        .catch(error => console.error('Klaida:', error));
    }

    // laukiama, kol klientas paspaus išsaugojimo mygtuką, kad išsaugoti naujus duomenis (siunčiama į vidinį serverį)
    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const selectedOption = document.getElementById('userRole').options[document.getElementById('userRole').selectedIndex];
        const roleRealName = selectedOption.textContent;
        console.log(roleRealName);
        const findUserId = document.getElementById('client');
        const actualUserId =findUserId.getAttribute('clientId');
        const findService = document.getElementById('service');
        const actualServiceId =findService.getAttribute('serviceId');
        const formData = {
            id: document.getElementById('userId').value,
            userId: actualUserId,
            serviceId: actualServiceId,
            reservedDate: document.getElementById('reservedDate').value,
            reservedTime: document.getElementById('reservedTime').value,
            paymentType: document.getElementById('paymentType').value,
            reservationStatus:roleRealName
        };

        fetch('/editReservation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to update user data');
            }
            return response.json();
        })
        .then(data => {
            const uID = document.getElementById('userId').value;
            console.log(uID);
            const userElement = document.querySelector(`.user-item[data-user-id="${uID}"]`);
            if (userElement) {
                // Update the content of the user element with the updated data
                userElement.querySelector('p:nth-of-type(5)').innerHTML = roleRealName;         }
                closeEditPopup();
        })
        .catch(error => {
            console.error('Klaida koreguojant', error);
            displayErrorMessage('Klaida koreguojant rezervacijos duomenis.');
        });
    });

    // uždaryti koregavimo papildomą langą
    function closeEditPopup() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>
</body>
@endsection
