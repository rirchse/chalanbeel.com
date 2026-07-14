// Listen for network requests
self.addEventListener('fetch', (event) => {
    // For a dashboard, you usually want to fetch live data from the network
    event.respondWith(fetch(event.request));
});