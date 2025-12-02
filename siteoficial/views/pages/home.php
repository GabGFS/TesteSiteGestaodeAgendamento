<?php
// Home view com calendário, seleção de horários, serviços e eventos
?>
<div class="flex flex-col lg:flex-row gap-8">

    <div class="w-full lg:w-1/3">
        <!-- Calendário e horários -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Horários Disponíveis</h2>
                <div class="flex items-center gap-2">
                    <button id="prev-month" class="px-2 py-1 bg-gray-100 rounded">◀</button>
                    <div id="current-month" class="font-medium"></div>
                    <button id="next-month" class="px-2 py-1 bg-gray-100 rounded">▶</button>
                </div>
            </div>
            <div id="calendar-days" class="grid grid-cols-7 gap-1 text-sm"></div>
            <div class="mt-4">
                <p class="text-sm text-gray-600">Data selecionada: <span id="selected-date-time">Nenhuma data/horário selecionado</span></p>
                <input type="hidden" id="selected-date-time-input" name="selected-date-time" />
            </div>
            <div class="mt-4" id="time-slots-container">
                <div id="time-slots" class="grid grid-cols-3 gap-2 mt-2"></div>
            </div>
        </div>


    </div>

    <div class="w-full lg:w-2/3">

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Novo Agendamento</h2>
            <form id="appointment-form" method="POST" action="?r=clientes/create">
                <input type="hidden" id="selected-service-type-input" name="service-type" value="">
                <input type="hidden" id="selected-datetime-hidden" name="selected-datetime" value="">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Cliente</label>
                        <input type="text" id="client-name" name="nome" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                        <input type="email" id="client-email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                        <input type="tel" id="client-phone" name="celular" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Serviço</label>
                        <div class="relative inline-block w-full">
                            <button id="service-btn" type="button" class="w-full text-left px-3 py-2 border border-gray-200 rounded-md bg-gray-50 flex items-center justify-between">
                                <span id="service-btn-text">Selecione um serviço</span>
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </button>
                            <div id="service-options" class="hidden absolute left-0 right-0 mt-2 bg-white border rounded-md shadow z-40">
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100 service-option" data-service="individual">Psicoterapia Individual</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100 service-option" data-service="couple">Psicoterapia de Casal</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100 service-option" data-service="group">Grupo de Apoio à Bariátricas</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100 service-option" data-service="career">Orientação Profissional</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100 service-option" data-service="lecture">Palestras</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                    <textarea id="appointment-notes" name="observacoes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md">Agendar</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Calendar and date handling
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const currentMonthEl = document.getElementById('current-month');
    const calendarDays = document.getElementById('calendar-days');

    function renderCalendar() {
        calendarDays.innerHTML = '';
        const monthNames = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
        currentMonthEl.textContent = `${monthNames[currentMonth]} ${currentYear}`;
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();

        for (let i = firstDay - 1; i >= 0; i--) {
            const d = document.createElement('div');
            d.className = 'text-center py-2 text-gray-400';
            d.textContent = prevMonthDays - i;
            calendarDays.appendChild(d);
        }

        const today = new Date();
        for (let i = 1; i <= daysInMonth; i++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'text-center py-2 cursor-pointer calendar-day rounded-full hover:bg-gray-100';
            if (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                dayElement.classList.add('bg-pink-100','font-medium');
            }
            dayElement.textContent = i;
            dayElement.addEventListener('click', function () {
                document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('bg-pink-500','text-white'));
                this.classList.add('bg-pink-500','text-white');
                const selectedDate = new Date(currentYear, currentMonth, i);
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById('selected-date-time').textContent = selectedDate.toLocaleDateString('pt-BR', options);
                document.getElementById('selected-date-time-input').value = '';
                document.getElementById('selected-datetime-hidden').value = '';
                generateTimeSlots();
            });
            calendarDays.appendChild(dayElement);
        }

        const totalCells = 42;
        const remainingCells = totalCells - (firstDay + daysInMonth);
        for (let i = 1; i <= remainingCells; i++) {
            const d = document.createElement('div');
            d.className = 'text-center py-2 text-gray-400';
            d.textContent = i;
            calendarDays.appendChild(d);
        }
    }

    prevMonthBtn.addEventListener('click', function () {
        currentMonth--;
        if (currentMonth < 0) { currentMonth = 11; currentYear--; }
        renderCalendar();
    });
    nextMonthBtn.addEventListener('click', function () {
        currentMonth++;
        if (currentMonth > 11) { currentMonth = 0; currentYear++; }
        renderCalendar();
    });

    renderCalendar();

    // Time slots
    const timeSlotsContainer = document.getElementById('time-slots');
    function generateTimeSlots() {
        timeSlotsContainer.innerHTML = '';
        for (let hour = 8; hour <= 18; hour++) {
            const timeSlot = document.createElement('button');
            timeSlot.className = 'py-2 px-1 bg-white border border-gray-300 rounded-md text-sm hover:bg-indigo-50';
            const timeString = `${hour}:00 - ${hour + 1}:00`;
            timeSlot.textContent = timeString;
            timeSlot.addEventListener('click', function () {
                document.querySelectorAll('#time-slots button').forEach(s => s.classList.remove('bg-pink-500','text-white','border-pink-700'));
                this.classList.add('bg-pink-500','text-white','border-pink-700');
                const selectedDateEl = document.querySelector('.calendar-day.bg-pink-500');
                if (selectedDateEl) {
                    const day = parseInt(selectedDateEl.textContent);
                    const selectedDate = new Date(currentYear, currentMonth, day);
                    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
                    const dateString = selectedDate.toLocaleDateString('pt-BR', options);
                    const selectedTime = this.textContent.split(' - ')[0];
                    document.getElementById('selected-date-time').textContent = `${dateString} às ${selectedTime}`;
                    document.getElementById('selected-date-time-input').value = `${dateString} ${selectedTime}:00`;
                    document.getElementById('selected-datetime-hidden').value = document.getElementById('selected-date-time-input').value;
                }
            });
            timeSlotsContainer.appendChild(timeSlot);
        }
    }

    // Service selection
    const serviceBtn = document.getElementById('service-btn');
    const serviceOptions = document.getElementById('service-options');
    const serviceBtnText = document.getElementById('service-btn-text');
    const selectedServiceInput = document.getElementById('selected-service-type-input');

    // Toggle menu services
    serviceBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        serviceOptions.classList.toggle('hidden');
    });

    // Select an option
    document.querySelectorAll('.service-option').forEach(opt => {
        opt.addEventListener('click', function (e) {
            e.preventDefault();
            const serviceKey = this.getAttribute('data-service');
            const serviceLabel = this.textContent.trim();
            serviceBtnText.textContent = serviceLabel;
            selectedServiceInput.value = serviceKey;
            serviceOptions.classList.add('hidden');
            // add visual feedback on selection (pink)
            serviceBtn.classList.add('bg-pink-50');
        });
    });

    // Close services menu when clicking outside
    document.addEventListener('click', function (ev) {
        if (!serviceBtn.contains(ev.target) && !serviceOptions.contains(ev.target)) {
            serviceOptions.classList.add('hidden');
        }
    });

    // View toggle day/week
    const viewWeekBtn = document.getElementById('view-week');
    const dayAppointments = document.querySelector('#appointments-list > div:not(#week-appointments)');
    const weekAppointments = document.getElementById('week-appointments');

    viewWeekBtn.addEventListener('click', function () {
        // alterna exibição da semana
        const isHidden = weekAppointments.classList.contains('hidden');
        if (isHidden) {
            dayAppointments.classList.add('hidden');
            weekAppointments.classList.remove('hidden');
            viewWeekBtn.classList.add('bg-pink-500','text-white');
        } else {
            dayAppointments.classList.remove('hidden');
            weekAppointments.classList.add('hidden');
            viewWeekBtn.classList.remove('bg-pink-500','text-white');
        }
    });

    // Basic form submission: ensure date/time/service selected
    const appointmentForm = document.getElementById('appointment-form');
    appointmentForm.addEventListener('submit', function (e) {
        const dt = document.getElementById('selected-datetime-hidden').value;
        const srv = document.getElementById('selected-service-type-input').value;
        if (!dt || !srv) {
            e.preventDefault();
            alert('Por favor selecione uma data/hora e o serviço antes de agendar.');
            return false;
        }
    });
});

</script>