
document.addEventListener('DOMContentLoaded', () => {

    /* BOOKING FORM VALIDATION */
    const bookForm = document.querySelector('form[action$="handle_booking.php"]');

    if (bookForm) {
        const bookError = document.getElementById('bookError');

        function showBookError(msg) {
            if (bookError) {
                bookError.textContent = msg;
                bookError.style.display = 'block';
            } else {
                alert(msg);
            }
        }

        bookForm.addEventListener('submit', (e) => {
            if (bookError) bookError.style.display = 'none';

            const name = document.getElementById('client_name').value.trim();
            const address = document.getElementById('address').value.trim();
            const date = document.getElementById('event_date').value;
            const type = document.getElementById('event_type').value;
            const phone = document.getElementById('phone').value.trim();

            if (!/^[a-zA-Z\s]{2,30}$/.test(name)) {
                e.preventDefault();
                showBookError("Name must contain only letters (2 to 30 characters).");
                return;
            }

            if (address.length < 5) {
                e.preventDefault();
                showBookError("Address must be at least 5 characters.");
                return;
            }

            const today = new Date().toISOString().split("T")[0];
            if (!date || date < today) {
                e.preventDefault();
                showBookError("Event date cannot be in the past.");
                return;
            }

            if (type === "") {
                e.preventDefault();
                showBookError("Please choose an event type.");
                return;
            }

            if (!/^[0-9]{7,15}$/.test(phone)) {
                e.preventDefault();
                showBookError("Phone number must be 7 to 15 digits.");
                return;
            }
        });
    }

    /* EVENTS SEARCH & FILTER  */
    const searchInput = document.getElementById('eventSearch');
    const eventsGrid = document.getElementById('eventsGrid');

    if (searchInput && eventsGrid) {
        const cards = Array.from(eventsGrid.querySelectorAll('.event-card'));

        function normalize(str) {
            return str.toLowerCase();
        }

        function applyFilter() {
            const term = normalize(searchInput.value);

            cards.forEach(card => {
                const title = card.querySelector('h3')?.textContent || "";
                const desc = card.querySelector('p')?.textContent || "";
                const type = card.dataset.eventType || "";

                const haystack = normalize(title + " " + desc + " " + type);

                card.style.display = haystack.includes(term) ? "" : "none";
            });
        }

        searchInput.addEventListener('input', applyFilter);
    }

    /* REGISTER FORM VALIDATION */
    const registerForm = document.getElementById('registerForm');

    if (registerForm) {
        const errorBox = document.getElementById('registerError');

        function showRegisterError(msg) {
            errorBox.textContent = msg;
            errorBox.style.display = 'block';
        }

        registerForm.addEventListener('submit', (e) => {
            errorBox.style.display = 'none';

            const fullName = document.getElementById('full_name').value.trim();
            const email = document.getElementById('email').value.trim();
            const pwd = document.getElementById('password').value;
            const confirm = document.getElementById('confirm_password').value;

            if (fullName.length < 2) {
                e.preventDefault();
                showRegisterError("Name must be at least 2 characters.");
                return;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                showRegisterError("Please enter a valid email.");
                return;
            }

            if (pwd.length < 6) {
                e.preventDefault();
                showRegisterError("Password must be at least 6 characters.");
                return;
            }

            if (pwd !== confirm) {
                e.preventDefault();
                showRegisterError("Passwords do not match.");
                return;
            }
        });
    }

    /* LOGIN FORM VALIDATION*/
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        const errorBox = document.getElementById('loginError');

        function showLoginError(msg) {
            errorBox.textContent = msg;
            errorBox.style.display = 'block';
        }

        loginForm.addEventListener('submit', (e) => {
            errorBox.style.display = 'none';

            const email = document.getElementById('email').value.trim();
            const pwd = document.getElementById('password').value;

            if (email === "" || pwd === "") {
                e.preventDefault();
                showLoginError("Email and password are required.");
                return;
            }
        });
    }
});
