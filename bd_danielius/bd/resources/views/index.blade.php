<?php
$userIsLoggedIn = false; 
?>
@if (Auth::check()) 
	<?php $userIsLoggedIn = true; ?>
@endif

@extends('layout')
@section('title', 'Danieliaus paslaugos')
@section('content')
	<body class="font-sans antialiased dark:bg-black dark:text-white/50">
		<div class="main">
			<div class="welcomeText">Šiame puslapyje galite rasti visą informaciją<br>apie mano teikiamas paslaugas, jų kainas ir laisvus laikus rezervacijai.</div>
			@if(auth()->check() && auth()->user()->role!="Vartotojas")
			<div class="add"><button onclick="showAddPopup()">Pridėti paslaugą</button></div>
			@endif
				<div class="service-list">
				@foreach($services as $service)
				<div id="service_{{ $service->id }}" class="service-item">
					<img src="{{$service->image}}">
					<h4>{{$service->name}}</h4>
					<p>{{$service->description}}</p>
					<b style="display: inline;font-size:14px;margin-left:10px;margin-bottom:10px;">Kaina:</b><p style="display: inline;">{{$service->price}}</p>
					<button style="margin-top:20px;" onclick="showService({{$service->id}});showViewPopup();loadCalendar({{$service->id}})">PLAČIAU</button>
					@if(auth()->check() && auth()->user()->role!="Vartotojas")
					<button onclick="showServiceEdit({{$service->id}});showViewPopupEdit({{$service->id}})">KOREGUOTI</button>
					<button class="delete" onclick="deleteService({{$service->id}})">PAŠALINTI</button>
					@endif
					</div>
				@endforeach
			</div>
		</div>

		<div id="addModal" class="modal">
			<div class="modal-content">
				<span class="close" onclick="closeAddPopup()">&times;</span>
				<h2>Pridėti paslaugą</h2>
				<form id="editForm">
					<div id="errorMessage" style="display: none; color: red; margin-bottom:10px;"></div>
					<input type="text" id="name" name="name" placeholder="Pavadinimas">
					<input type="text" id="description" name="description" placeholder="Trumpas aprašymas">
					<input type="number" id="price" name="price" placeholder="Kaina">
					<textarea id="detailed_description" name="longText" rows="4" cols="50"></textarea> <label for="file-upload" class="custom-file-upload" style="margin-bottom:20px;">
					<span>Parinkti nuotrauką</span>
					<input id="file-upload" type="file"/>
					<div id="selected-files"></div>
					<button type="submit">Išsaugoti</button>
				</form>
			</div>
		</div>

		<div id="showModal" class="modal">
			<div class="modal-content">
				<h2>Paslaugos peržiūra</h2>
				<form id="editForm">
				<span class="close" onclick="closeShowPopup()">&times;</span>
					<div id="errorMessage" style="display: none; color: red; margin-bottom:10px;"></div>
					<label>Pavadinimas</label>
					<input type="text" id="names" name="name" placeholder="Pavadinimas" readonly>
					<label>Trumpas aprašymas</label>
					<input type="text" id="descriptions" name="description" placeholder="Trumpas aprašymas" readonly>
					<label>Paslaugos kaina</label>
					<input type="number" id="prices" name="price" placeholder="Kaina" readonly>
					<label>Detalus aprašymas</label>
					<textarea id="detailed_descriptions" name="longText" rows="4" cols="50" readonly></textarea> 
					<h2>Rezervacija</h2> 
					<div class="calendar">
						<div class="month" id="monthLabel">{{ date('F', mktime(0, 0, 0, $currentMonth, 1)) }} {{ $currentYear }}</div>
						<div class="navigation">
							<button id="prevMonthBtn" class="timeBtn">Praeitas mėnuo</button>
							<button id="nextMonthBtn" class="timeBtn">Sekantis mėnuo</button>
						</div>
						<div class="days"></div>
					</div>
				<button type="submit" onclick="closeShowPopup()">Uždaryti</button>
				</form>
			</div>

			<div id="availability" class="availabilityModal">
				<div class="modal-content-availability">
					<span class="close" onclick="closeTab()">&times;</span>
					<h2>Laisvi laikai</h2>
					<ul id="availableTimesList"></ul>
					<h2>Užimti laikai</h2>
					<ul id="takenTimesList"></ul>
				</div>
			</div>

		<div id="reservationOptions" class="optionsModal">
			<label id="reservationDate" style="display:none;"></label>
			<label id="reservedTime" style="display:none;"></label>
			<label id="serviceIds" style="display:none"></label>
			<label id="additionalServices" style="display:none"></label>
			<span class="close" onclick="closeTabOption()">&times;</span>
			<h3>Visažisto paslaugos</h3>
			<div class="scroll-container">
				@foreach($workerServicesVisaz as $service)
				<label>
				<input type="checkbox" onchange="addPrice(this, {{ $service->workerPrice }})" id="service{{ $service->id }}"> {{ $service->workerServiceTitle }} <br> {{ $service->workserServiceDescription }} <br> {{ $service->workerPrice }}
				</label>
				@endforeach
			</div>
			<h3>Plaukų stilisto paslaugos</h3>
			<div class="scroll-container" style="margin-bottom:20px">
				@foreach($workerServicesStyle as $service)
				<label>
				<input type="checkbox" onchange="addPrice(this, {{ $service->workerPrice }})" id="service{{ $service->id }}"> {{ $service->workerServiceTitle }} <br> {{ $service->workserServiceDescription }} <br> {{ $service->workerPrice }}
				</label>
				@endforeach
			</div>
			<label>Paslaugos pilna kaina <label style="margin-left:10px;"id="priceToPay"></label></label>
			<label>Apmokėjimo tipas</label>
			<select name="paymentType">
				<option value="Apmokėta iš karto">Apmokėti pilną sumą</option>
				<option value="Mokėta dalimis">Apmokėti 20 procentų</option>
			</select>
			<label>Palikite komentarą fotografui</label>
			<textarea id="comment" name="longText" rows="4" cols="50"></textarea> 
			<button class="reserve" onclick="reserve()">REZERVUOTI</button>
		</div>
		</div>

		<div id="showModalEdit" class="modal">
			<div class="modal-content">
				<span class="close" onclick="closeShowPopupEdit()">&times;</span>
				<h2>Paslaugos koregavimas</h2>
				<form id="editFormActual">
					<div id="errorMessageEdit" style="display: none; color: red; margin-bottom:10px;"></div>
					<label>Pavadinimas</label>
					<input type="text" id="namesEdit" name="name" placeholder="Pavadinimas">
					<label>Trumpas aprašymas</label>
					<input type="text" id="descriptionsEdit" name="description" placeholder="Trumpas aprašymas">
					<label>Paslaugos kaina</label>
					<input type="number" id="pricesEdit" name="price" placeholder="Kaina">
					<label>Detalus aprašymas</label>
					<textarea id="detailed_descriptionsEdit" name="longText" rows="4" cols="50"></textarea> 
					<button type="submit" onclick="closeShowPopupEdit()">Išsaugoti</button>
				</form>
			</div>
		</div>

<script>

	// rezervuoti, kai klientas pasirenka rezervacijos detales
	function reserve()
	{
		var selectElement = document.querySelector('select[name="paymentType"]');
		var selectedOption = selectElement.options[selectElement.selectedIndex];
		var selectedValue = selectedOption.value;
		const additionalServicesElement = document.getElementById('additionalServices');
		const priceToPayElement = document.getElementById('priceToPay');
		const dateReservedElement = document.getElementById('reservationDate');
		const timeReservedElement = document.getElementById('reservedTime');
		const serviceIdsElement = document.getElementById('serviceIds');
		const commentElement = document.getElementById('comment');
		const additionalServices = additionalServicesElement ? additionalServicesElement.textContent : '';
		const price = priceToPayElement ? priceToPayElement.textContent : '';
		const date = dateReservedElement ? dateReservedElement.textContent : '';
		const time = timeReservedElement ? timeReservedElement.textContent : '';
		const servisas = serviceIdsElement ? serviceIdsElement.textContent : '';
		const commentValue = commentElement ? commentElement.value : '';

		@auth
		const userId = '{{ auth()->user()->id }}';
		@endauth

		const additionalServicesToSend = additionalServices.trim() === '' ? '' : additionalServices;
		const commentToSend = commentValue.trim() === '' ? '' : commentValue;

		fetch('http://localhost:8888/api/orders', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({ 
				price: price, 
				date: date, 
				time: time, 
				serviceId: servisas, 
				paymentType: selectedValue, 
				userId: userId,
				comment: commentToSend,
				additionalServices: additionalServicesToSend
			})
		})
		.then(response => {
			if (!response.ok) {
				throw new Error('Klaida rezervuojant: ' + response.statusText);
			}
			return response.json();
		})
		.then(data => {
			const approvalUrl = data.links.find(link => link.rel === 'approve').href;
			window.location.replace("http://localhost:8888");
		})
		.catch(error => {
			console.error('Rezervacijos klaida:', error);
		});
	}

	// kainos koregavimas pridedant/atsisakant papildomų paslaugų
	function addPrice(checkbox, price) {
        const isChecked = checkbox.checked;
        const serviceID = checkbox.id.replace('service', '');
        const additionalServicesElement = document.getElementById('additionalServices');
        let included = additionalServicesElement.textContent;
        let priceToPayElement = document.getElementById('priceToPay');
        let currentPrice = parseFloat(priceToPayElement.textContent);

        if (isChecked) {
            if (!included.includes(serviceID)) {
                currentPrice += price;
                included += serviceID + ',';
            }
        } else {
            included = included.replace(serviceID + ',', '');
            currentPrice -= price;
        }
        additionalServicesElement.textContent = included;
        priceToPayElement.textContent = currentPrice.toFixed(0);
    }

	// funkcija leidžianti atidaryti galimus pasirinkti laikus rezervacijai
	function openModal(availableTimes, takenTimes, dateSelected, serviceId) {
		const availableTimesList = document.getElementById('availableTimesList');
		const takenTimesList = document.getElementById('takenTimesList');

		availableTimesList.innerHTML = '';
		takenTimesList.innerHTML = '';

		takenTimes.forEach((time) => {
		const parts = time.split(':');
		const hours = parts[0];
		const minutes = parts[1];
   		const formattedTime = hours + ':' + minutes;

		const li = document.createElement('li');
		li.textContent = formattedTime;
		li.classList.add('time-slot', 'taken');
		li.onclick = function () {
			alert('Šis laikas jau užimtas: ' + formattedTime);
		};
		takenTimesList.appendChild(li);
	});

    availableTimes.forEach((time) => {
	const formattedTakenTimes = takenTimes.map(takenTime => takenTime.split(':').slice(0, 2).join(':'));

	if (!formattedTakenTimes.includes(time)) {
		const li = document.createElement('li');
        li.textContent = time;
        li.classList.add('time-slot', 'available');
        li.onclick = function () {
            const userIsLoggedIn = <?php echo json_encode($userIsLoggedIn); ?>;
            if (!userIsLoggedIn) {
                alert("Norint užsirezervuoti laiką turite būti prisijungę prie sistemos!\nJei dar neturite paskyros užsiregistruokite.");
            } else {
				fetch(`/showService/${serviceId}`, {
					method: 'GET',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
					}
				})
				.then(response => {
				if (!response.ok) {
					throw new Error('Klaida...');
				}
				return response.json();
				})
				.then(data => {
					const priceField = document.getElementById('priceToPay');
					const dateField = document.getElementById('reservationDate');
					const timeField = document.getElementById('reservedTime');
					const serviceField = document.getElementById('serviceIds');
					timeField.textContent = time;
					dateField.textContent = dateSelected;
					priceField.textContent = data.price;
					serviceField.textContent = serviceId;
					priceField.style.fontWeight = 'bold';
				});
				const reserve = document.getElementById('reservationOptions');
				reserve.style.display = 'block';
        	}
        };
        availableTimesList.appendChild(li);
        }
    });
    const timesForReservation = document.getElementById('availability');
    timesForReservation.style.display = 'block';
	}

	// funkcija leidžianti užkrauti kalendorių rezervacijos pasirinkimui
	function loadCalendar(serviceId){
		const prevMonthBtn = document.getElementById('prevMonthBtn');
		const nextMonthBtn = document.getElementById('nextMonthBtn');
		let currentMonth = {{ $currentMonth }};
		let currentYear = {{ $currentYear }};

		updateCalendar(serviceId); 

		prevMonthBtn.addEventListener('click', function (event) {
			event.preventDefault();
			currentMonth--;
			if (currentMonth < 1) {
				currentMonth = 12;
				currentYear--;
			}
			updateCalendar(serviceId);
		});

		nextMonthBtn.addEventListener('click', function (event) {
			event.preventDefault();
			currentMonth++;
			if (currentMonth > 12) {
				currentMonth = 1;
				currentYear++;
			}
			updateCalendar(serviceId);
	});

	function updateCalendar(serviceId) {
		fetch(`/get-calendar/${currentYear}/${currentMonth}`)
			.then(response => response.json())
			.then(data => {
				const lithuanianMonths = [
		'Sausis', 'Vasaris', 'Kovas', 'Balandis', 'Gegužė', 'Birželis',
		'Liepa', 'Rugpjūtis', 'Rugsėjis', 'Spalis', 'Lapkritis', 'Gruodis'
	];

	document.querySelector('.month').textContent =lithuanianMonths[data.month - 1] + ' ' + data.year;
	document.querySelector('.days').innerHTML = data.daysHtml;

	const dates = document.querySelectorAll('.day');
	dates.forEach(date => {
		date.addEventListener('click', function() {		
			const selectedDay = date.textContent.trim();
			const paddedMonth = String(currentMonth).padStart(2, '0'); 
			const paddedDay = String(selectedDay).padStart(2, '0'); 
			const selectedDate = `${currentYear}-${paddedMonth}-${paddedDay}`;
			const today = new Date();
			const selectedDates = new Date(selectedDate);

			// neleisti parinkti šiandienos arba praėjusios datos
			if (selectedDates <= today) {
				alert('Pasirinkta data turi būti vėlesnė nei šiandien!');
				return;
			}

			fetch(`/get-available-times/${selectedDate}/${serviceId}`)
			.then(response => response.json())
			.then(times => {
				let availableTimes = times.availableTimes;
				let takenTimes = times.takenTimes;
				openModal(availableTimes,takenTimes, selectedDate,serviceId);
			})
			.catch(error => {
				console.error('Klaida išgaunant laisvus laikus:', error);
			});
		});
	});
	});
	}
	}

	// uždaryti papildomą laisvų laikų pasirinkimo langą
	function closeTab() {
		const timesForReservation = document.getElementById('availability');
		timesForReservation.style.display = 'none';
	}

	// atvaizduoti paslaugą
	function showService(serviceId){
		fetch(`/showService/${serviceId}`, {
		method: 'GET',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		}
		})
		.then(response => {
			if (!response.ok) {
				throw new Error('Klaida išgaunant paslaugos duomenis');
			}
			return response.json();
		})
		.then(data => {
			document.getElementById('names').value = data.name;
			document.getElementById('descriptions').value = data.description;
			document.getElementById('prices').value = data.price;
			document.getElementById('detailed_descriptions').value = data.detailed_description;
			})
		.catch(error => {
			console.error('Klaida:', error);
			displayErrorMessage('Klaida atvaizduojant paslaugą.');
		});
	}

	// ištrinti paslaugą
	function deleteService(serviceId){
		const formData = {
		serviceId:serviceId
		};
		fetch(`/deleteService/${serviceId}`, {
			method: 'POST',
			headers: {
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			},
			body: JSON.stringify(formData)
		})
		.then(response => {
			if (!response.ok) {
				throw new Error('Failed to delete service data');
			}
			$('#service_' + serviceId).remove();
		})
		.then(data => {
			})
		.catch(error => {
			console.error('Error deleting service:', error);
		});
	}

	// failų formatavimas pridėjus prie lango
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

	// klaidų atvaizdavimas vartotojui
	function displayErrorMessage(message) {
		const errorMessageElement = document.getElementById('errorMessage');
		errorMessageElement.textContent = message;
		errorMessageElement.style.display = 'block';
	}

	// klaidų išvalymas po atvaizdavimo
	function clearErrorMessage() {
		const errorMessageElement = document.getElementById('errorMessage');
		errorMessageElement.textContent = '';
		errorMessageElement.style.display = 'none';
	}

	// paslaugos pridėjimo papildomas langas
	function showAddPopup() {
		document.getElementById('addModal').style.display = 'block';
	}

	// paslaugos pridėjimo papildomo lango uždarymas
	function closeAddPopup() {
		document.getElementById('addModal').style.display = 'none';
	}

	// paslaugos papildomos peržiūros lango atidarymas
	function closeShowPopup() {
		document.getElementById('showModal').style.display = 'none';
	}

	// paslaugos papildomos peržiūros lango uždarymas
	function closeShowPopupEdit() {
		document.getElementById('showModalEdit').style.display = 'none';
	}

	// rezervacijos papildomo puslapio uždarymas
	function closeTabOption() {
		document.getElementById('reservationOptions').style.display = 'none';
	}

	// rezervacijos papildomų duomenų atvaizdavimas
	function showViewPopup() {
		document.getElementById('showModal').style.display = 'block';
	}

	// paslaugos koregavimo langas
	function showViewPopupEdit(servisoId) {
		document.getElementById('showModalEdit').style.display = 'block';
		document.getElementById('errorMessageEdit').value = servisoId;
	}

	// signalui perduoti į vidinį serverį, kai pakoreguojami paslaugos duomenys
	document.getElementById('editForm').addEventListener('submit', function(event) {
		event.preventDefault();
		const fileInput = document.getElementById('file-upload');
		const formData = new FormData();
		formData.append('name', document.getElementById('name').value);
		formData.append('description', document.getElementById('description').value);
		formData.append('price', document.getElementById('price').value);
		formData.append('detailed_description', document.getElementById('detailed_description').value);
		formData.append('image', document.getElementById('file-upload').files[0]);

		fetch('/addService', {
			method: 'POST',
			body: formData,
			headers: {
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			}
		})
		.then(response => {
			if (!response.ok) {
				throw new Error('Klaida koreguojant paslaugą');
			}
			closeAddPopup();
			return response.json();
		})
		.then(data => {
			})
		.catch(error => {
			console.error('Klaida koreguojant paslaugą:', error);
			displayErrorMessage('Klaida koreguojant paslaugą.');
		});
	});

	// rezervacijos lango koregavimui išgaunami paslaugos duomenys
	function showServiceEdit(serviceId){
		fetch(`/showService/${serviceId}`, {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			}
		})
		.then(response => {
			if (!response.ok) {
				throw new Error('Klaida gaunant paslaugos duomenis');
			}
			return response.json();
		})
		.then(data => {
			document.getElementById('namesEdit').value = data.name;
			document.getElementById('descriptionsEdit').value = data.description;
			document.getElementById('pricesEdit').value = data.price;
			document.getElementById('detailed_descriptionsEdit').value = data.detailed_description;
			})
		.catch(error => {
			console.error('Klaida gaunant paslaugos duomenis:', error);
			displayErrorMessage('Klaida gaunant paslaugos duomenis.');
		});
	}

	// pakoregavus duomenis laukiama signalo, kol vartotojas paspaus išsaugoti
	document.getElementById('editFormActual').addEventListener('submit', function(event) {
		event.preventDefault();
		const fileInput = document.getElementById('file-upload');
		const formData = new FormData();
		formData.append('id',document.getElementById('errorMessageEdit').value);
		formData.append('name', document.getElementById('namesEdit').value);
		formData.append('description', document.getElementById('descriptionsEdit').value);
		formData.append('price', document.getElementById('pricesEdit').value);
		formData.append('detailed_description', document.getElementById('detailed_descriptionsEdit').value);

		fetch('/editService', {
		method: 'POST',
		body: formData,
		headers: {
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		}
		})
		.then(response => {
			if (!response.ok) {
				throw new Error('Klaida koreguojant');
			}
			closeAddPopup();
			return response.json();
		})
		.then(data => {
			const uID = document.getElementById('errorMessageEdit').value
			const userElement = document.querySelector(`#service_${uID}`);
			console.log(userElement);
			if (userElement) {
				userElement.querySelector('h4').textContent = document.getElementById('namesEdit').value;
				userElement.querySelector('p:nth-of-type(1)').textContent = document.getElementById('descriptionsEdit').value;
				userElement.querySelector('p:nth-of-type(2)').textContent = document.getElementById('pricesEdit').value;
				}
				closeShowPopupEdit();
		})
		.catch(error => {
			console.error('Error updating user:', error);
			displayErrorMessage('Koreguojamas el. paštas ir (arba) tel. numeris yra jau užimtas.');
		});
	});
</script>
</body>
</html>
@endsection
