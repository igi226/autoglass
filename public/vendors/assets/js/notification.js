class Notification {
    static show = (data) => {
        let notification = document.querySelector('#notification');
        notification.classList.remove('show');
        document.querySelector('.notification-message').innerHTML = data.message;
        document.querySelector('.notification-timestamp').innerHTML = data.timestamp;
        notification.onclick = () => {
            window.location.href = data.url;
        }
        notification.classList.add('show');
        let audio = new Audio('../../../common/drop.mp3');
        audio.play();
        setTimeout(() => {
            notification.classList.remove('show');
        }, 10000)
    }
}