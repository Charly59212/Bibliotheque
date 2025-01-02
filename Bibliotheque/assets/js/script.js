/*---------------------Header Navigation--------------------------*/
// Close the navigation menu by removing the active class
function closeMenu() {
    const navLinks = document.getElementById('navLinks'); // Selects the element containing the navigation links
    navLinks.classList.remove('active'); // Remove active CSS class to hide menu
}

// Clode all dropdowns by removing the show class
function closeDropdown() {
    const dropdownContents = document.querySelectorAll('.dropdown-content'); // Select all dropdown content
    dropdownContents.forEach(content => content.classList.remove('show')); // Remove the show class from each dropdown
}

// Global event listener to close menus/dropdowns when a click is detected elsewhere
document.addEventListener('click', function (event) {
    const hamburger = document.querySelector('.hamburger'); // Select the hamburger button to open/close the menu
    const navLinks = document.getElementById('navLinks'); // Select the navigation links container
    const dropdowns = document.querySelectorAll('.dropdown'); // Select all dropdowns

    // Checks if the click is outside the navigation menu and hamburger button
    if (hamburger && navLinks) { // Check if items exist before continuing
        if (!navLinks.contains(event.target) && !hamburger.contains(event.target)) { 
            closeMenu(); // Close the navigation menu
            }
        }

        if (dropdowns.length > 0) { // Check if items exist before continuing
        let isDropdownClick = false; // Checks if a dropdown was clicked
        dropdowns.forEach(dropdown => {
            if (dropdown.contains(event.target)) { 
                isDropdownClick = true; // If a click is detected in a dropdown, we mark it as such
            }
        });

        // If no click in the dropdown, it remains closed
        if (!isDropdownClick) {
            closeDropdown();
        }
    }
});

// Opens or closes the navigation menu by toggling the active class
function toggleMenu() {
    const navLinks = document.getElementById('navLinks'); // Select the navigation links container
    navLinks.classList.toggle('active'); // Add or remove the active class
}

// Open or close the dropdown
function toggleDropdown(element, event) {
    event.preventDefault(); // Prevents default link behavior
    const dropdownContent = element.nextElementSibling; // Select the next item in dropdown content
    dropdownContent.classList.toggle('show'); // Toggle show class
}

/*-------------------Bouton scroll to top--------------------*/
// Show or hide the top of page button
window.addEventListener("scroll", function () {
    const scrollToTopButton = document.getElementById("scroll-to-top"); // Select the Back to Top button
    if (window.scrollY > 100) { // If the user has scrolled more than 100 pixels
        scrollToTopButton.style.display = "block"; // Show the button
    } else {
        scrollToTopButton.style.display = "none"; // Hide the button
    }
});

/*---------------------Bootstrap Messages-------------------*/
// Deletes alerts after 3 seconds
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(alert => alert.remove()); // Remove all elements with class alert
}, 3000); // 3 seconds delay

/*-------------------Profile page tooltips-----------------*/
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search); // variable to read URL parameters

    // Managing success notifications
    if (urlParams.has('success')) { // Checks if the success parameter is present in the URL.
        const successMessage = urlParams.get('success') === 'password' // Assigns a message based on the value of success
            ? 'Mot de passe modifié avec succès !' // If it is the correct password, the message indicates success
            : 'Modification effectuée avec succès !'; // Otherwise it displays a generic message
        showNotification(successMessage); // Shows the notification with the appropriate message

        // Clean up the URL keeping the current path
        window.history.replaceState({}, document.title, window.location.pathname); // Prevent notifications from repeating if refresh
    }

    // Handling error notifications
    if (urlParams.has('error')) { // Check if the error parameter is present in the URL
        const errorType = urlParams.get('error'); // Retrieves the value associated with the error parameter
        if (errorType === 'incorrect_password') { 
            showNotification('Mot de passe actuel incorrect.', 'error'); // Error message if incorrect password.
        } else if (errorType === 'password_error') {
            showNotification('Les mots de passe ne correspondent pas.', 'error'); // Error message if incompatible passwords
        }

        window.history.replaceState({}, document.title, window.location.pathname); // Clean up the URL keeping the current path
    }
});

// Displaying notifications
function showNotification(message, type = 'success') { // Select notification item
    const notification = document.getElementById('notification'); // Defines the message to display
    notification.textContent = message;

    // Styles
    notification.className = 'notification'; // Resets the element class
    if (type === 'error') {
        notification.classList.add('error'); // Add a style in case of error
    }
    notification.style.display = 'block'; // Show notification
    setTimeout(() => { // Hide notification after 3 seconds
        notification.style.display = 'none';
    }, 3000);
}

/*-----------------------------Footer--------------------------*/
// List of quotes to display randomly in the footer
const citations = [
    { text: "Lire, c'est rêver les yeux ouverts.", author: "Marcel Proust" },
    { text: "Un livre est un ami qui ne trompe jamais.", author: "Voltaire" },
    { text: "La lecture est une amitié.", author: "Marcel Proust" },
    { text: "Lire, c’est agrandir son âme.", author: "Voltaire" },
    { text: "Les livres sont des clés pour des mondes inconnus.", author: "E. Zola" },
    { text: "Chaque livre est un voyage.", author: "Albert Camus" },
    { text: "Un lecteur aujourd'hui, un leader demain.", author: "Margaret Fuller" },
    { text: "Lire, c'est vivre mille vies.", author: "George R.R. Martin" },
    { text: "Un livre bien choisi est un bon compagnon.", author: "Douglas Jerrold" },
    { text: "Les livres nous aident à voler au-delà de nous-mêmes.", author: "G. Flaubert" },
    { text: "L'imagination est plus importante que le savoir.", author: "Albert Einstein" },
    { text: "Les livres sont des fenêtres ouvertes sur le monde.", author: "Céline" },
    { text: "Lire, c'est apprendre à voir.", author: "Julie Annen" },
    { text: "Un livre peut changer une vie.", author: "J.P. Sartre" },
    { text: "Les livres guérissent l’âme.", author: "Léon Abric" },
    { text: "La lecture est un refuge.", author: "A. Dumas" },
    { text: "Lire, c'est se libérer.", author: "Paul Adam" },
    { text: "Un bon livre n'a pas de fin.", author: "G. Arnaud" },
    { text: "Les mots sont des ailes pour l'esprit.", author: "R.D. Cumming" },
    { text: "Ouvrir un livre, c'est allumer une lumière.", author: "Molière" }
];

// Random selection of a quote
const citation = citations[Math.floor(Math.random() * citations.length)];

// Insertion of the quote in the footer after loading the page
document.addEventListener("DOMContentLoaded", () => {
    const quoteContainer = document.getElementById("random-quote"); // Select the footer element to display the quote
    quoteContainer.innerHTML = `<p>"${citation.text}" <em>(${citation.author})</em></p>`; // Add quote to HTML
});