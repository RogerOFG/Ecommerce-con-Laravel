const datesCreate = document.querySelectorAll('.datesCreate');
const time = document.querySelectorAll('.timeAvailable');

if (datesCreate.length === time.length) {
    datesCreate.forEach((item, index) => {
        var now = new Date();
        var date = new Date(item.textContent);

        if (isNaN(date)) {
            time[index].textContent = 'Fecha no válida';
            return;
        }

        var day = date.getDate();

        var limitDate = new Date(date);

        limitDate.setDate(day + 4);

        if (now < limitDate) {
            var remainingDays = Math.ceil((limitDate - now) / (1000 * 60 * 60 * 24));
            time[index].textContent = remainingDays + " días hábiles";
        } else if (now.getDate() === limitDate.getDate()) {
            time[index].textContent = "Ultimo dia habil";
        }else {
            time[index].textContent = "Días hábiles superados";
        }
    });
} else {
    console.error('El número de elementos datesCreate y timeAvailable no coincide.');
}
