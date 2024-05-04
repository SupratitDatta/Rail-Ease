const sections = document.querySelectorAll('div[id$="_section"]');

sections.forEach(section => {
    if (section.id !== 'login_section') {
        section.style.display = 'none';
    }
});

function showSection(sectionId) {
    sections.forEach(section => {
        if (section.id === sectionId) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
}

function cancelTicket(ticketId) {
    fetch('../PHP Files/cancel_ticket.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', 
        },
        body: 'cancel_ticket_id=' + ticketId, 
    })
    .then(response => response.text())
    .then(result => {
        alert("Ticket cancelled successfully");
        fetchBookingHistory();
    })
    .catch(error => console.error('Error cancelling ticket:', error));
}

function fetchBookingHistory() {
    fetch('../PHP Files/booking_history.php')
    .then(response => response.json())
    .then(data => {
        showSection('history_section');

        const tbody = document.getElementById('booking_history_body');
        tbody.innerHTML = '';

        data.forEach(booking => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${booking['TicketID']}</td>
                <td>${booking['TrainID']}</td>
                <td>${booking['BookingDate']}</td>
                <td>${booking['UserName']}</td>
                <td>${booking['Departure']}</td>
                <td>${booking['Destination']}</td>
                <td>${booking['SeatType']}</td>
                <td>${booking['Fare']}</td>
                <td>${booking['Status']}</td>
                <td><button onclick="cancelTicket(${booking['TicketID']})">Cancel</button></td>
            `;
            tbody.appendChild(row);
        });
    })
    .catch(error => console.error('Error fetching booking history:', error));
}

// Fetch booking history data initially
fetchBookingHistory();
