// Check for dark mode preference
function initDarkMode() {
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        updateThemeColor('dark');
    } else {
        document.documentElement.classList.remove('dark');
        updateThemeColor('light');
    }
}

// Update the theme-color meta tag for mobile browsers
function updateThemeColor(theme) {
    const darkMeta = document.querySelector('meta[name="theme-color"][media="(prefers-color-scheme: dark)"]');
    const lightMeta = document.querySelector('meta[name="theme-color"][media="(prefers-color-scheme: light)"]');

    if (theme === 'dark') {
        if (darkMeta) darkMeta.setAttribute('content', '#303446'); // frappe-base
    } else {
        if (lightMeta) lightMeta.setAttribute('content', '#ffffff'); // white
    }
}

// Toggle dark/light mode
function toggleDarkMode() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
        updateThemeColor('light');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
        updateThemeColor('dark');
    }

    // Dispatch an event that the theme has changed
    const themeChangeEvent = new CustomEvent('theme-changed', {
        detail: { theme: localStorage.theme }
    });
    document.dispatchEvent(themeChangeEvent);
}

// Setup event listeners with event delegation to work on all devices including mobile
function setupEventListeners() {
    // Using event delegation for better mobile support
    document.addEventListener('click', function(e) {
        // Find the closest toggle button to the event target (handles clicks on the button or its children)
        const toggleButton = e.target.closest('#dark-mode-toggle');
        if (toggleButton) {
            toggleDarkMode();
            e.preventDefault();
        }
    }, false);
}

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    initDarkMode();

    // Remove direct event listener to avoid duplicate handlers
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    if (darkModeToggle) {
        darkModeToggle.removeEventListener('click', toggleDarkMode);
    }

    // Setup the delegated event listener
    setupEventListeners();

    // Listen for system preference changes
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    prefersDarkScheme.addEventListener('change', (e) => {
        // Only update if user hasn't manually set a preference
        if (!('theme' in localStorage)) {
            if (e.matches) {
                document.documentElement.classList.add('dark');
                updateThemeColor('dark');
            } else {
                document.documentElement.classList.remove('dark');
                updateThemeColor('light');
            }
        }
    });
});

// Export functions for use elsewhere
window.toggleDarkMode = toggleDarkMode;
window.initDarkMode = initDarkMode;
