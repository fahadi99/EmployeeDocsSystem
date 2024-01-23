

const staticCacheName = 'site-static-v4';
const dynamicCacheName = 'site-dynamic-v4';
var version = 'v1::';

const assets = [

  '/',
  '/master.blade.php',
  '/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
  '/assets/plugins/global/plugins.bundle.css',
  '/assets/plugins/custom/prismjs/prismjs.bundle.css',
  '/assets/css/pages/login/login-2.css',
  '/assets/css/style.bundle.css',
  '/assets/css/custom.bundle.css',
  '/assets/plugins/custom/datatables/datatables.bundle.css',
  '/images/hrldigital.ico',
  '/assets/css/themes/layout/header/base/light.css',
  '/assets/css/themes/layout/header/menu/light.css',
  '/assets/css/themes/layout/brand/dark.css',
  '/assets/css/themes/layout/aside/dark.css',
  '/assets/plugins/global/plugins.bundle.js',
  '/assets/plugins/custom/prismjs/prismjs.bundle.js',
  '/assets/js/scripts.bundle.js',
  '/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
  '/assets/js/pages/features/calendar/external-events.js',
  '/assets/js/pages/widgets.js',
  '/assets/plugins/custom/datatables/datatables.bundle.js',
  '/assets/js/pages/crud/datatables/advanced/multiple-controls.js',
  '/assets/js/pages/features/cards/tools.js',
  '/assets/js/pages/crud/forms/widgets/select2.js',
  '/assets/js/pages/crud/forms/widgets/bootstrap-switch.js',
  '/assets/js/pages/crud/forms/editors/summernote.js',
  'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700',
  'https://fonts.gstatic.com/s/materialicons/v47/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2'
];

const limitCacheSize = (name, size) => {
    caches.open(name).then(cache => {
      cache.keys().then(keys => {
        if(keys.length > size){
          cache.delete(keys[0]).then(limitCacheSize(name, size));
        }
      });
    });
  };

  // install event
  self.addEventListener('install', evt => {

       caches
          .open(version + 'fundamentals')
          .then(function(cache) {
            return cache.addAll(assets);
          })
          .then(function() {
            console.log('WORKER: install completed');
          })

  });

  // activate event
  self.addEventListener('activate', evt => {

    evt.waitUntil(
      caches.keys().then(keys => {
        return Promise.all(keys
          .filter(key => key !== staticCacheName && key !== dynamicCacheName)
          .map(key => caches.delete(key))
        );
      })
  );
  });
  
  // fetch events
  self.addEventListener('fetch', function(evt) {

    if(evt.request.method === "GET" ){
      evt.respondWith(
        caches.match(evt.request).then(cacheRes => {
          return cacheRes || fetch(evt.request).then(fetchRes => {
            return caches.open(dynamicCacheName).then(cache => {
              cache.put(evt.request.url, fetchRes.clone());

              limitCacheSize(dynamicCacheName, 15);
              return fetchRes;
            })
          });
        }).catch(() => {
          if(evt.request.url.indexOf('.php') > -1){
            return caches.match('/resources/views/errors/404.blade.php');
          }
        })
      );

    }
   
})
