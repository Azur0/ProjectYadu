<!-- Start section desktop notifications -->
// request permission on page load
document.addEventListener('DOMContentLoaded', function () {
    if (!Notification) {
        alert('Desktop notifications not available in your browser. Try a different browser.');
        return;
    }

    if (Notification.permission !== "granted")
        Notification.requestPermission();
});

function notifyMe(event, logo, message) {
    if (Notification.permission !== "granted")
        Notification.requestPermission();
    else {
        let notification = new Notification(event, {
            // icon: `{{ asset('images/logoCircle.png')}}`,
            icon: logo,
            body: `${message.firstName} ${message.lastName}: ${message.body}`,
        });

        notification.onclick = function () {
            window.open(window.location.href);
        };
    }
}
<!-- End section desktop notifications -->