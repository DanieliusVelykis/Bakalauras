<?php

?>


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
							<br><a>------------</a><br>
							<label class="label">Nuotraukų failas</label>
							@if ($reservation->reservationStatus == "Atlikta")
								<a href="{{$reservation->file}}" download>Atsisiųsti</a>
							@else
								<p>Užsakymas dar nėra įvygdytas</p>
							@endif
					</div>
					@if($reservation->reservationStatus == "Atlikta")
						<div class="action-buttons">
							<button onclick="showFeedbackPopup({{$reservation->serviceId}})">Palikti atsiliepimą</button>
						</div>
					@endif
					<?php
						// išgaunama rezervacijos data
						$reservedDate = new DateTime($reservation->reservedDate);
						// išgaunama šiandienos data
						$today = new DateTime();
						// suskaičiuojamas dienų skirtumas tarp rezervacijos ir šiandienos
						$interval = $reservedDate->diff($today);
						$daysDifference = $interval->days;
						// naudojama, kad patikrinti ar klientas vis dar gali atšaukti vizitą
					?>

					@if($daysDifference > 7)
						<div class="button-container">
							<div class="action-buttons">
								<button onclick="openWindow({{$reservation->id}})">Atšaukti vizitą</button>
							</div>
							<div class="action-buttons">
								<button onclick="commentsWindow({{$reservation->id}},{{auth()->user()->id}})">Komentarai</button>
							</div>
						</div>
					@endif
			</div>
		@endforeach
	</div>

	<div id="commentsModal" class="modal">
		<div style="display:none" id="user"></div>
		<div style="display:none" id="reservation"></div>
		<span class="close" onclick="closeCommentPopup()">&times;</span>
		<div class="modal-content">
			<div class="commentModal"></div>
			<label>Palikite komentarą</label>
			<textarea id="comment" name="longText" rows="4" cols="50"></textarea> 
			<button class="reserve" onclick="addNewComment()">Pridėti</button>
		</div>
	</div>

	<div id="editModal" class="modal">
		<div class="modal-content">
			<form id="editForm">
				<span class="close" onclick="closeFeedbackPopup()">&times;</span>
				<h2>Palikti komentarą</h2>
				<div id="serviceId" style="display:none"></div>
				<textarea id="feedback" name="longText" rows="4" cols="50"></textarea> 
				<button type="submit">Pateikti atsiliepimą</button>
			</form>
		</div>
	</div>
		
	<div id="confirmationModal" class="modal">			
		<div class="modal-content">
			<form id="editForm">
				<label id="reservationID" style="display:none"></label>
				<p>Ar tikrai norite atšaukti rezervaciją?<br>Pinigai bus grąžinti Jums per 5 d.d.</p>
				<button type="submit" onclick="cancelReservation()">TAIP</button>
				<button type="decline" onclick="exitWindow()">NE</button>
			</form>
		</div>
	</div>

<script>

	// funkcija skirta sukurti papildomą paslaugą
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
				throw new Error('Failed to receive additional service data');
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

	// funkcija skirta pridėti naują komentarą prie rezervacijos
	function addNewComment(){
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
				throw new Error('Nepavyko gauti komentarų: ' + response.statusText);
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
				throw new Error('Nepavyko gauti komentarų: ' + response.statusText);
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
				else commenter.textContent = "-Aš";

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

	// atidaryti komentarų puslapį vizite
	function commentsWindow(resID, userId) {
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
				else commenter.textContent = "-Aš";

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

	// atidaryti vizito atšaukimo papildomą langą
	function openWindow(resID){
		const window =document.getElementById('confirmationModal');
		const res = document.getElementById('reservationID');
		res.textContent = resID;
		window.style.display = 'block';	
	}

	// uždaryti vizito atšaukimo papildomą langą
	function exitWindow(){
		const window =document.getElementById('confirmationModal');
		window.style.display = 'none';
	}

	// uždaryti komentarų papildomą langą
	function closeCommentPopup(){
		const window =document.getElementById('commentsModal');
		window.style.display = 'none';
	}

	// atšaukti rezervaciją
	function cancelReservation(){
		const resID = document.getElementById('reservationID').textContent;
		console.log(resID);
		
		fetch(`/cancelReservation/${resID}`, {
					method: 'GET',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
					}
				})
			.then(response => {
				if (!response.ok) {
					throw new Error('Klaida atšaukiant rezervaciją');
				}
				location.reload();
				return response.json();
			});
	}

	// atvaizduoti atsiliepimų langą
	function showFeedbackPopup(userId) {
		document.getElementById('editModal').style.display = 'block';
		document.getElementById('serviceId').value = userId;
	}

	document.getElementById('editModal').addEventListener('submit', function(event) {
		event.preventDefault();
		const ID = document.getElementById('serviceId').value;
		const formData = new FormData();
		formData.append('serviceId', ID);
		formData.append('feedback', document.getElementById('feedback').value);
		formData.append('user', '{{ auth()->user()->name }}');

		fetch('/addFeedback', {
			method: 'POST',
			body: formData,
			headers: {
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			}
			})
			.then(response => {
				if (!response.ok) {
					throw new Error('Klaida pridedant atsiliepimą.');
				}
				closeFeedbackPopup();
				return response.json();
			})
			.then(data => {
				})
			.catch(error => {
				console.error('Klaida:', error);
				displayErrorMessage('Klaida pridedant atsiliepimą.');
			});
	});

	// uždaryti atsiliepimų papildomą langą
	function closeFeedbackPopup() {
			document.getElementById('editModal').style.display = 'none';
	}

</script>
</body>
@endsection
