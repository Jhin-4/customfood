function showNutritionalInformation() {
    var modal = document.getElementById('modal-container');
    modal.style.display = 'block';
}

function hideModal() {
    var modal = document.getElementById('modal-container');
    modal.style.display = 'none';
}

function calculateCalories() {
    var checkboxes = document.querySelectorAll('input[name="selected[]"]');
    var totalCalories = 0;

    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            var row = checkbox.closest('tr');
            var calories = parseInt(row.querySelector('td:nth-child(3)').textContent);

            totalCalories += calories;
        }
    });

    document.getElementById('total-calories').textContent = totalCalories;
    updateSelectedIds();
}

function updateSelectedIds() {
    var checkboxes = document.querySelectorAll('input[name="selected[]"]');
    var selectedIds = [];

    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            selectedIds.push(checkbox.value);
        }
    });

    // Filtrar los elementos vacíos antes de asignarlos al campo oculto
    selectedIds = selectedIds.filter(function (id) {
        return id !== '';
    });

    document.getElementById('selected_ids').value = selectedIds.join(',');
}
