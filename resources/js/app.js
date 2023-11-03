import Echo from 'laravel-echo';
import './bootstrap';

window.Echo.channel('notifications').listen('UserSessionChanged', (e) => {

const notificationMessage = document.getElementById('notification');

notificationMessage.innerText= e.message;

        notificationMessage.classList.remove('invisible');
        notificationMessage.classList.remove('alert-success');
        notificationMessage.classList.remove('alert-danger');
        notificationMessage.classList.add('alert-' + e.type);


});


