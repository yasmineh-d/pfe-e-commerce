document.addEventListener('DOMContentLoaded', function() {
    // --- Your existing variables ---
    const searchIconLink = document.getElementById('search-icon-link');
    const searchOverlay = document.getElementById('search-overlay');
    const closeSearchBtn = document.getElementById('close-search');
    const searchInput = document.getElementById('search-input');
    
    // --- NEW: Get a reference to the search submit button ---
    const searchSubmitBtn = document.querySelector('.search-submit-btn');
  
    // --- Your existing function to open the search overlay ---
    function openSearch() {
      searchOverlay.classList.add('active');
      // Focus the input field for immediate typing
      // setTimeout is used to wait for the transition to finish
      setTimeout(() => searchInput.focus(), 300); 
    }
  
    // --- Your existing function to close the search overlay ---
    function closeSearch() {
      searchOverlay.classList.remove('active');
    }

    // --- NEW: This function will handle the actual search action ---
    function performSearch() {
        // 1. Get the text from the input field and remove any extra spaces from the start/end.
        const query = searchInput.value.trim();

        // 2. Check if the user actually typed something.
        if (query) {
            // 3. If they did, redirect them to a search results page.
            //    We use encodeURIComponent to make sure special characters (like '&' or spaces) are handled correctly in the URL.
            window.location.href = `search_results.php?query=${encodeURIComponent(query)}`;
        }
    }
  
    // --- Your existing event listeners ---
    if (searchIconLink) {
      searchIconLink.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the link from navigating to "#"
        openSearch();
      });
    }
  
    if (closeSearchBtn) {
      closeSearchBtn.addEventListener('click', closeSearch);
    }
  
    if (searchOverlay) {
      searchOverlay.addEventListener('click', function(e) {
          if (e.target === searchOverlay) {
              closeSearch();
          }
      });
    }
  
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
        closeSearch();
      }
    });

    // --- NEW: Add event listeners for the search action ---

    // 1. Listen for a click on the search button (the magnifying glass icon)
    if (searchSubmitBtn) {
        searchSubmitBtn.addEventListener('click', performSearch);
    }

    // 2. Listen for the 'Enter' key being pressed inside the input field
    if (searchInput) {
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent any default browser action
                performSearch();
            }
        });
    }
});