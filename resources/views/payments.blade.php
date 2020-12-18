<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"
        integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ=="
        crossorigin="anonymous"></script>
    <script>
        // Enable pusher logging - don't include this in production
        

    </script>
    <title>Document</title>
</head>

<body>
    <h1 class="text-center">Kledo Payment</h1>
    <hr>
    <div class="container">
        @yield('content');
    <div class="alert-view"></div>
    </div>
    <script>
        const btnDelete = document.querySelector('.btn-delete')
        const checkDelete = document.querySelectorAll('#checkbox-delete')
        var checkedRows = [];
        let alertView = document.querySelector('.alert-view');
        console.log(document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        for (i = 0; i < checkDelete.length; i++) {
            checkDelete[i].addEventListener('change', function() {
                checkedRows.push(parseInt(this.getAttribute('data-id')))
                console.log(this.getAttribute('data-id'));
            })
        }

        Pusher.logToConsole = true;

        var pusher = new Pusher('e3563faa44d674394141', {
            cluster: 'ap1',
            encrypt: true
        });

var channel = pusher.subscribe('laravel-web-notifications');
        channel.bind('App\\Events\\PaymentNotifications', function(data) {
            alertView.innerHTML += `<div class="alert alert-success mt-2" role="alert">
                ${data.message}
                </div>`;
        });
        btnDelete.addEventListener('click', function() {
            for (i = 0; i < checkedRows.length; i++) {
                console.log();
                let id = checkedRows[i];
                $.ajax({
                    url: "http://localhost:8000/payments-delete/" + id,
                    type: 'DELETE',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    data: {
                        id: JSON.stringify(checkedRows)
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                })
                if(i === checkedRows.length - 1) {
                    setTimeout(() => {
                        alertView.innerHTML += `<div class="alert alert-success mt-2" role="alert">
                Semua data berhasil dihapus!
                </div>`
                    }, 3000);;
                }
            }
        });

    </script>
</body>

</html>