const CACHE_NAME = 'adminlte-cache-v1';
const urlsToCache = [
    './manifest.json',
    './assets/icons/icon-192.png',
    './assets/icons/icon-512.png',

    // AdminLTE core CSS & JS
    './assets/plugins/fontawesome-free/css/all.min.css',
    './assets/dist/css/adminlte.min.css',
    './assets/plugins/jquery/jquery.min.js',
    './assets/plugins/bootstrap/js/bootstrap.bundle.min.js',
    './assets/dist/js/adminlte.min.js',

    // Optional: include your logo or login bg if needed
    './uploads/logo.png',
    './uploads/cover.png',
];

self.addEventListener('install', function (event) {
    console.log('[Service Worker] Installing and caching the following URLs:');
    urlsToCache.forEach(url => console.log('Caching:', url)); // 🔍 log each path

    event.waitUntil(
        caches.open('adminlte-cache-v1')
            .then(cache => {
                return cache.addAll(urlsToCache);
            })
            .catch(error => {
                console.error('[Service Worker] Cache addAll failed:', error);
            })
    );
});

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(response => {
            return response || fetch(event.request);
        })
    );
});
