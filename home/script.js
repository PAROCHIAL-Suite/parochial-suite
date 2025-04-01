document.addEventListener('DOMContentLoaded', function() {
    // Calendar functionality
    const calendarDays = document.querySelectorAll('.calendar td[data-date]');
    const eventsList = document.getElementById('events-list');
    
    // Load stats
    fetchStats();
    
    // Load today's events by default
    const today = document.querySelector('.today');
    if (today) {
        today.click();
    }
    
    // Calendar day click handler
    calendarDays.forEach(day => {
        day.addEventListener('click', function() {
            const date = this.getAttribute('data-date');
            fetchEvents(date);
            
            // Update active day
            calendarDays.forEach(d => d.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Fetch events for selected date
    function fetchEvents(date) {
        showLoading();
        
        fetch(`events.php?date=${date}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    displayEvents(data.events, date);
                } else {
                    throw new Error(data.error || 'Unknown error');
                }
            })
            .catch(error => {
                showError(error.message);
            });
    }
    
    // Display events in the events section
    function displayEvents(events, date) {
        if (!events || events.length === 0) {
            eventsList.innerHTML = `
                <div class="empty-state">
                    <span class="material-icons">event_busy</span>
                    <p>No events for ${formatDate(date)}</p>
                </div>
            `;
            return;
        }
        
        let html = '';
        events.forEach(event => {
            html += `
                <div class="event-item">
                    <h4>${event.title}</h4>
                    ${event.event_time ? `<div class="event-time">${formatTime(event.event_time)}</div>` : ''}
                    ${event.description ? `<div class="event-desc">${event.description}</div>` : ''}
                </div>
            `;
        });
        
        eventsList.innerHTML = html;
    }
    
    // Fetch and display statistics
    function fetchStats() {
        fetch('stats.php')
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateStats(data.stats);
                } else {
                    throw new Error(data.error || 'Unknown error');
                }
            })
            .catch(error => {
                console.error('Error loading stats:', error);
            });
    }
    
    // Update stat cards with data
    function updateStats(stats) {
        document.getElementById('total-events').querySelector('h3').textContent = stats.totalEvents;
        document.getElementById('upcoming-events').querySelector('h3').textContent = stats.upcomingEvents;
        document.getElementById('users-count').querySelector('h3').textContent = stats.usersCount;
        document.getElementById('active-projects').querySelector('h3').textContent = stats.activeProjects;
    }
    
    // Helper functions
    function formatDate(dateString) {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    }
    
    function formatTime(timeString) {
        return timeString.substring(0, 5); // Simple format HH:MM
    }
    
    function showLoading() {
        eventsList.innerHTML = `
            <div class="empty-state">
                <span class="material-icons">hourglass_empty</span>
                <p>Loading events...</p>
            </div>
        `;
    }
    
    function showError(message) {
        eventsList.innerHTML = `
            <div class="empty-state">
                <span class="material-icons">error_outline</span>
                <p>Error: ${message}</p>
            </div>
        `;
    }
    
    // Add event button functionality
    document.getElementById('add-event').addEventListener('click', function() {
        alert('Add event functionality would go here');
        // In a real implementation, this would open a modal/form
    });
});