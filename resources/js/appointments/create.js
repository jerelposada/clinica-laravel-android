let $doctor,$date,$specialty,$hours,iradio;
$(function () {
     $specialty = $('#specialty');
    $doctor = $('#doctor');
    $date = $('#date');
    $hours = $('#hours');
    $specialty.change(() => {
        const specialtyId = $specialty.val();
        const url = `/specialties/${specialtyId}/doctors`;
        $.getJSON(url, onDoctorsLoaded)
    })

    $doctor.change(loadHours);
    $date.change(loadHours);
});

function onDoctorsLoaded(doctors) {
    let htmlOptions = '';
    doctors.forEach(doctor => {
        htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`;
    });

    $doctor.html(htmlOptions);
    loadHours();
}

function loadHours(){
    const selectedDate = $date.val();
    const doctorId = $doctor.val();
    const url = `/schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours)
}

function displayHours(data){
    if(!data.MorningIntervals && !data.AfternoonIntervals){
        const mesageAlert= alert('Lo sentimos','no se encontraron horas disponibles para el medico en el día selecionado')
       $hours.html(mesageAlert);
        return;
    }
    let htmlHours = "";
    iradio = 0;
    if (data.MorningIntervals){
        data.MorningIntervals.forEach(interval =>{
            htmlHours +=getRadioIntervalHtml(interval);
        });
    }
    if (data.AfternoonIntervals){
        data.AfternoonIntervals.forEach(interval =>{
            htmlHours +=getRadioIntervalHtml(interval);
        });
    }
    $hours.html(htmlHours);
}

function alert(mesageOne,mesageTwo){
  const messajeAlert =`<div class="alert alert-danger" role="alert">
        <strong> ${mesageOne}</strong> ${mesageTwo}
    </div> `;

  return messajeAlert;
}

function  getRadioIntervalHtml(interval){
    const text = `${interval.start} - ${interval.end}`;
   return `<div class="custom-control custom-radio mb-3">
        <input type="radio" id="interval-${iradio}" value="${interval.start}" required name="scheduled_time"  class="custom-control-input">
            <label class="custom-control-label" For="interval-${iradio++}">${text}</label>
    </div> `;
}
