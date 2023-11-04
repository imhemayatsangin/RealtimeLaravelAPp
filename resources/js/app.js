import Echo from 'laravel-echo';
import './bootstrap';

window.Echo.private('notifications').listen('UserSessionChanged', (e) => {

const notificationMessage = document.getElementById('notification');

notificationMessage.innerText= e.message;

        notificationMessage.classList.remove('invisible');
        notificationMessage.classList.remove('alert-success');
        notificationMessage.classList.remove('alert-danger');
        notificationMessage.classList.add('alert-' + e.type);


});

window.Echo.channel('users')
.listen('UserCreated', (e)=>{
 const UserElement=document.getElementById('users');
let element= document.createElement('li');
element.setAttribute('id',e.user.id);
element.innerHTML=`${e.user.name} ${e.user.email}`;
UserElement.appendChild(element);

})

.listen('UserUpdated', (e)=>{
    let element=document.getElementById(e.user.id);
    element.innerHTML=`${e.user.name} ${e.user.email}`;

})

.listen('UserDeleted', (e)=>{
    let element=document.getElementById(e.user.id);
    element.parentNode.removeChild(element);

});




