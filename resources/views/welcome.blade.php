<html>
assaassa
<!-- firebase integration started -->

<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-functions.js"></script>
<script src="firebase-messagiasdasdng-sw.js"></script>


<!-- firebase integration end -->

<!-- Comment out (or don't include) services that you don't want to use -->
<!-- <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-storage.js"></script> -->

<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-analytics.js"></script>


<script>
    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyDIpj9O7UM2Wc6Bddk0zgxuSFrHBfdqrLk",
        authDomain: "laravel-17-fcm.firebaseapp.com",
        projectId: "laravel-17-fcm",
        storageBucket: "laravel-17-fcm.appspot.com",
        messagingSenderId: "294103981263",
        appId: "1:294103981263:web:be2add7719a3478ad4ebba",
        measurementId: "G-R1E381076K"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    //firebase.analytics();
    const messaging = firebase.messaging();
    messaging
        .requestPermission()
        .then(function () {
//MsgElem.innerHTML = "Notification permission granted."
            console.log("Notification permission granted.");

            // get the token in the form of promise
            return messaging.getToken()
        })
        .then(function(token) {
            // print the token on the HTML page
            console.log(token);



        })
        .catch(function (err) {
            console.log("Unable to get permission to notify.", err);
        });

    messaging.onMessage(function(payload) {
        console.log(payload);
        var notify;
        notify = new Notification(payload.notification.title,{
            body: payload.notification.body,
            icon: payload.notification.icon,
            tag: "Dummy"
        });
        console.log(payload.notification);
    });

    //firebase.initializeApp(config);
    var database = firebase.database().ref().child("/users/");

    database.on('value', function(snapshot) {
        renderUI(snapshot.val());
    });

    // On child added to db
    database.on('child_added', function(data) {
        console.log("Comming");
        if(Notification.permission!=='default'){
            var notify;

            notify= new Notification('CodeWife - '+data.val().username,{
                'body': data.val().message,
                'icon': 'bell.png',
                'tag': data.getKey()
            });
            notify.onclick = function(){
                alert(this.tag);
            }
        }else{
            alert('Please allow the notification first');
        }
    });

    self.addEventListener('notificationclick', function(event) {
        event.notification.close();
    });


</script>
</html>