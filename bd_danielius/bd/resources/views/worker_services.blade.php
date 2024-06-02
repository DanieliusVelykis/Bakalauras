<?php
$userId = false; 
?>
@if (Auth::check()) 
	<?php $userId =  auth()->user()->id;  ?>
@endif
@extends('layout')

@section('title', 'Danieliaus paslaugos')

@section('content')
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
		<div class="main">
			<div class="welcomeText">Šis puslapis skirtas valdyti papildomas paslaugas</div>
			<div class="add"><button onclick="showAddPopup()">Pridėti paslaugą</button></div>
            <table class="worker-service-list">
    <thead>
        <tr>
            <th>Paslaugos pavadinimas</th>
            <th>Kaina</th>
            <th>Tipas</th>
            <th>Darbuotojas</th>
            <th>Veiksmai</th>
        </tr>
    </thead>
    <tbody>
    @foreach($workerServices as $service)
        <tr id="service_{{ $service->id }}" class="worker-service-item">
            <td>{{$service->workerServiceTitle}}</td>
            <td>{{$service->workerPrice}}</td>
            <td>{{$service->workerServiceType}}</td>
            <td>{{$service->workerName}}</td>
            <td class="service-actions non-editable">
                <button class="edit-button" onclick="toggleEdit({{$service->id}},{{$service->workerId}})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="delete-button" onclick="deleteService({{$service->id}})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
		</div>

        <div id="addModal" class="modal">
			<div class="modal-content">
				<span class="close" onclick="closeAddPopup()">&times;</span>
				<h2>Pridėti paslaugą</h2>
				<form id="editForm">
					<div id="errorMessage" style="display: none; color: red; margin-bottom:10px;"></div>
					<input type="text" id="name" name="name" placeholder="Paslaugos pavadinimas">
					<input type="number" id="price" name="price" placeholder="Kaina">
                    <select name="type">
                        <option value="Plaukų stilistas">Plaukų stilistas</option>
                        <option value="Visažistas">Visažistas</option>
                    </select>
					<button type="submit">Išsaugoti</button>
				</form>
			</div>
		</div>

<script>

    // pridedant papildomą paslaugą laukiama, kol vartotojas išsaugos pakitimus
    document.getElementById('addModal').addEventListener('submit', function(event) {
        var selectElement = document.querySelector('select[name="type"]');
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var selectedValue = selectedOption.value;

        const userID = <?php echo json_encode($userId); ?>;
		event.preventDefault();
		const formData = new FormData();
		formData.append('workerId', userID);
		formData.append('workerPrice', document.getElementById('price').value);
		formData.append('workerServiceTitle', document.getElementById('name').value);
		formData.append('workerServiceType', selectedValue);

		fetch('/addWorkerService', {
		method: 'POST',
		body: formData,
		headers: {
		'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	    }
	    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Klaida saugant pakitimus');
            }
            document.getElementById('price').value = "";
            document.getElementById('name').value = "";
            closeAddPopup();
            window.location.reload();
            return response.json();
        })
        .then(data => {
            })
        .catch(error => {
            console.error('Klaida saugant pakitimus', error);
        });
	});

    // uždaryti papildomo paslaugos pridėjimo langą
	function closeAddPopup() {
		document.getElementById('addModal').style.display = 'none';
	}

    // atvaizduoti papildomą paslaugos pridėjimo langą
    function showAddPopup() {
		document.getElementById('addModal').style.display = 'block';
	}

    // globalūs kintamieji duomenų pildymui ir atnaujinimui/komunikacijai su vidiniu serveriu
    var serviceName = "";
    var servicePrice = "";
    var serviceType = "";
    var serviceWorker = "";

    // papildomos paslaugos koregavimo funkcija
    function toggleEdit(serviceId, workerId) {
        var row = document.getElementById('service_' + serviceId);
        var cells = row.querySelectorAll('td');

        if (row.getAttribute('data-edit-mode') === 'true') {
            return;
        }

        cells.forEach(function(cell, index) {
            if (!cell.classList.contains('non-editable')) {
                if (!cell.hasAttribute('data-original-content')) {
                    cell.setAttribute('data-original-content', cell.textContent);
                }
                var currentValue = cell.textContent.trim();
                cell.innerHTML = '<input type="text" value="' + currentValue + '">';
            }
        });

        row.querySelector('.edit-button').innerHTML = '<button class="save-button" onclick="saveChanges(' + serviceId + ',' + workerId +')"><i class="fas fa-save"></i></button>';
        row.querySelector('.delete-button').innerHTML = '<button class="close-button" onclick="closeChanges(' + serviceId + ')"><i class="fas fa-times"></i></button>';
        row.setAttribute('data-edit-mode', 'true');
    }

    // uždaryti koregavimo langą
    function closeChanges(serviceId) {
        var row = document.getElementById('service_' + serviceId);
        var cells = row.querySelectorAll('td');

        cells.forEach(function(cell) {
            if (!cell.classList.contains('non-editable') && cell.hasAttribute('data-original-content')) {
                cell.innerHTML = cell.getAttribute('data-original-content');
                cell.removeAttribute('data-original-content'); 
            }
        });

        row.querySelector('.edit-button').innerHTML = '<button class="edit-button" onclick="toggleEdit(' + serviceId + ')"><i class="fas fa-edit"></i></button>';
        row.querySelector('.delete-button').innerHTML = '<button class="close-button" onclick="deleteService(' + serviceId + ')"><i class="fas fa-trash-alt"></i></button>';
        row.removeAttribute('data-edit-mode');
    }

    // išsaugoti vartotojo padarytus pakitimus
    function saveChanges(serviceId, workerId) {
        var row = document.getElementById('service_' + serviceId);
        var cells = row.querySelectorAll('td');

        cells.forEach(function(cell, index) {
            if (!cell.classList.contains('non-editable')) {
                var input = cell.querySelector('input');
                if (input) {
                    
                    var value = input.value.trim();
                    if (index === 0) serviceName = value;
                    if (index === 1) servicePrice = value;
                    if (index === 2) serviceType = value;
                    if (index === 3) serviceWorker = value;
                    cell.innerHTML = value;
                }
            }
        });

        fetch(`/editWorkerServices`,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                workerServiceId: serviceId,
                workerId: workerId,
                workerPrice: servicePrice,
                workerServiceTitle:serviceName,
                workerServiceType:serviceType
            })})
            .then(response => {
                if(!reponse.ok){
                    throw new Error('Failed to edit service data');
                }else{
                    closeChanges(serviceId);
                }
            })
        row.querySelector('.edit-button').innerHTML = '<button class="edit-button" onclick="toggleEdit(' + serviceId + ')"><i class="fas fa-edit"></i></button>';
        row.querySelector('.delete-button').innerHTML = '<button class="close-button" onclick="deleteService(' + serviceId + ')"><i class="fas fa-trash-alt"></i></button>';

    }

    // ištrinti papildomą paslaugą
    function deleteService(serviceId) {
        if (!window.confirm('Ar tikrai norite pašalinti šią paslaugą?')) {
            return;
        }

        fetch(`/deleteWorkerService/${serviceId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                workerServiceId: serviceId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Klaida ištrinant papildomą paslaugą');
            }
            return response.json();
        })
        .then(data => {
            var row = document.getElementById('service_' + serviceId);
            if (row && row.parentNode) {
                row.parentNode.removeChild(row);
            }
        })
        .catch(error => {
            console.error('Klaida:', error);
        });
    }

</script>
@endsection
