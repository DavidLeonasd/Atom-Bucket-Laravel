<html>
    <head>
        <title>Atom-Pocket</title>     
        <style>
            table, th, td {
                border: 1px solid black
            }
        </style>   
    </head>
    <body>
        <div class="header">
        Dompet "{nama}"<br>
        </div>
        <div class="sidebar">
            master
            <ul>
                <li><a href="/dompet">dompet</a></li>
                <li><a href="/kategori">kategori</a></li>
            </ul>
            transaksi
            <ul>
                <li>dompet masuk</li>
                <li>dompet keluar</li>
            </ul>
            laporan
            <ul>
                <li>Laporan Transaksi</li>
            </ul>
        </div>

        <div class="content">
            @include('message')
            @yield('content')
        </div>
        <div class="footer">
            Maju Bersama Atomic Indonesia
        </div>
    </body>
</html>