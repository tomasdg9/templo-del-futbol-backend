self.addEventListener('push', function (event) {
    const data = event.data.json();
    const title = data.title || "Notificación";
    const options = {
        body: data.body,
        icon: data.icon,
        data: { url: data.data.url },
        actions: data.actions,
    };

    event.waitUntil(self.registration.showNotification(title, options));
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    event.waitUntil(clients.openWindow(event.notification.data.url));
});
