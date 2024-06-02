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
					</div>
					<div class="action-buttons">
			<button onclick="showAddFilePopup({{$reservation->id}})" style="{{ $reservation->file ? '' : 'background-color: green;' }}">Pridėti failą</button>
		</div>

				</div>
	@endforeach
	</div>

		<div id="editModal" class="modal">
			<div class="modal-content">
				<span class="close" onclick="closeAddFilePopup()">&times;</span>
				<h2>Pridėti failą</h2>
                    <div style="display:none" id="reserveId"></div>
					<form id="file-upload-form">
						<input id="file-upload" type="file"/>
						<div id="selected-files"></div>
						<button type="submit">Išsaugoti</button>
					</form>
			</div>
		</div>

<script>

	//atvaizduoti failo pridėjimo papildomą langą
	function showAddFilePopup(userId) {
		document.getElementById('editModal').style.display = 'block';
		document.getElementById('reserveId').value = userId;
	}

	// vartotojui paspaudus failo pridėjimą - išsiųsti informaciją į vidinį serverį
	document.getElementById('editModal').addEventListener('submit', function(event) {
		event.preventDefault();
        const ID = document.getElementById('reserveId').value;
		const fileInput = document.getElementById('file-upload');
		const formData = new FormData();
		formData.append('id', ID);
		formData.append('file', document.getElementById('file-upload').files[0]);

		fetch('/addFile', {
			method: 'POST',
			body: formData,
			headers: {
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			}
			})
			.then(response => {
				if (!response.ok) {
					throw new Error('Failed to update user data');
				}
				closeAddFilePopup();
				window.location.reload();
				return response.json();
			})
			.then(data => {
				})
			.catch(error => {
				console.error('Error updating user:', error);
				displayErrorMessage('Koreguojamas el. paštas ir (arba) tel. numeris yra jau užimtas.');
			});
	});

	// uždaryti failo pridėjimo langą
	function closeAddFilePopup() {
		document.getElementById('editModal').style.display = 'none';
	}

	//suformatuoti peržiūrą pridėjus/pašalinus failą
    document.getElementById("file-upload").addEventListener("change", function() {
		var input = this;
		var selectedFiles = "";
		for (var i = 0; i < input.files.length; i++) {
			selectedFiles += input.files[i].name;
		}
		var fileSelectedElement = document.getElementById("file-selected");
		if (fileSelectedElement) {
			fileSelectedElement.innerHTML = "Files selected";
		}
		var selectedFilesElement = document.getElementById("selected-files");
		if (selectedFilesElement) {
			selectedFilesElement.innerHTML = selectedFiles;
			selectedFilesElement.style = "margin-bottom:10px;"
		}
	});
</script>
</body>
@endsection
