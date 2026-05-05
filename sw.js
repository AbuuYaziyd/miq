var filesToCache = [
    "/",
    "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
    "https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap",
    "https://kit.fontawesome.com/ea9d69aa5c.js",
    "./assets/css/style.css",
    "./assets/css/style-rtl.css",
    "./assets/js/main.js",
    "./assets/js/main-rtl.js",
];

self.addEventListener("install", e => {
    e.waitUntil(
        caches.open("static").then(cache =>{
            return cache.add(filesToCache);
        })
    );
});

/* Serve cached content when offline */
self.addEventListener('fetch', function(e) {
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});