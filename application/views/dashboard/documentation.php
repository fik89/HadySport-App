<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Dokumentasi
        </h3>
        <div class="row"> 
            <div class="panel-group" id="accordion">
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse0">
                                Starting</a>
                        </h4>
                    </div>
                    <div id="collapse0" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <h4>Persiapan Toko Online</h4>
                            <ul>
                                <li>1. Setting profil Toko Online Anda
                                    <p>Buka Menu System > Setting Toko > Profil Toko, kemudian klik button update <br> Isikan Semua field, untuk url sosial media jika tidak ada silahkan ketik "null" atau boleh di kosongi saja.
                                     </p>
                                     <p> Pastikan Anda menginputkan e-mail, selain untuk menerima e-mail dari user, e-mail ini akan menerika data transaksi ketika user melakukan pembelian dan selesai sampai ke pembayaran.
                                </li>
                                <li>2. Setting Data Bank
                                    <p>
                                        Buka Menu System > Setting Toko > Data Bank<br>
                                        Data bank ini akan tampil ketika customer akan melakukan pembayaran, customer akan memilih bank yang Anda daftarkan.
                                    </p>
                                </li>
                                <li>3. Konfigurasi E-mail
                                    <p>
                                        Buka Menu System > Setting Toko > E-mail Sender<br>
                                        E-mail sender berfungsi untuk mengirim e-mail kepada user, seperti ketika user melakukan registrasi maupun ketika melakukan belanja.
                                    </p>
                                    <p>
                                        System ini hanya mendukung SMPT Gmail, maka gunakan akun Gmail Anda dan Setting Account Gmail Anda pada less secure App.
                                    </p>
                                </li>
                                <li>4. Konfigurasi Shiping Gateway
                                    <p>
                                        Versi Ecomerce 1.12 support 16 Jasa pengiriman barang. <br>
                                        System ini menggunakan API Rajaongkir Versi PRO, Anda diperkenankan menggunakan API selama masih di support.
                                        Ketika Service mati maka silakan melakukan pembelian layanan ke Rajaongkir.com dan update API Token nya.
                                    </p>
                                    <p>
                                        Akun Rajaongkir Versi PRO support untuk melakukan pengecekan waybill secara realtime.
                                    </p>
                                    <p> Kemudian pada field up cost. artinya Anda dapat menambahkan biaya kirim. ini mengantisipasi perbedaan data dari raja ongkir dengan data kurir.
                                    </p>
                                </li>
                                <li>5. Konfigurasi margin jatuh tempo pembayaran.
                                    <p> ini berguna untuk mengatur jatuh tempo pembayaran setelah customer melakukan checkout tetapi belum melakukan transfer. Anda dapat mengatur jarak jatuh tempo dengan jumlah jam.
                                    </p>
                                </li>
                                <li>6. Setting Pajak.
                                    <p> 
                                        Anda hanya perlu menginputkan angka pada form pajak, system akan mengkonversi dalam persen.
                                        guna pajak ini untuk menghitung keseluruhan order bukan pajak setiap barang.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Katalog > Kategori</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                        Anda dapat menambahkan sub kategori hingga tak terbatas, tetapi akan lebih baik di sesuaikan
                        dengan tampilan menu. semakin dalam subkategori semakin lebar ruang untuk tampilan menu.
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Partner > Rule Partner</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p><strong>Rule partner</strong><br>
                                Rule partner merupakan untuk membuat aturan kepada user yang ingin bergabung dengan online shop Anda.
                                ini bukan berarti User harus registrasi jika akan membeli Produk Anda.
                            </p>
                            <p>
                                Misalnya membuat group partner bernama Member.<br>
                                User Member dibuatkan rule jika mendaftar harus berbayar, maka user harus melakukan pembayaran sebelum dapat
                                menggunakan akunnya dan Admin harus mengaktifkannya setelah user melakukan transfer. <br>
                                ini biasanya untuk user premium, akan mendapatkan potongan harga jika membeli produk Anda.<br>
                                Dalam hal ini, System menyediakan Rule potongan harga dengan 2 (dua) tipe, yaitu potongan dengan prosentase
                                atau potongan dengan jumlah harga. <strong>system potongan ini dikalkulasi sesuai item yang mereka beli
                                karena potongan ini berlaku per item bukan dari total biaya yang mereka belanjakan.</strong>.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Widget</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                <li>1. Chat Button
                                    <p>Chat button Adalah button yang akan tampil pada setiap halaman, Chat button ini mengarah ke akun WhatpApp Anda. nomor WhatsApp yang digunakan Adalah nomor yang Anda inputkan pada setting profil. Widget ini dapat diaktifkan dan di nonaktifkan, sesuai kebutuhan Anda.
                                    </p>
                                </li>
                                <li>2. Share Button
                                    <p>Share button akan tampil pada halaman detail produk. widget ini berfungsi untuk user dapat membagikan produk Anda dimanapun platform user akan membagikan.Widget ini dapat diaktifkan dan di nonaktifkan, sesuai kebutuhan Anda.
                                    </p>
                                </li>
                                <li>3. Facebook Comment
                                    <p>Facebook Comment adalah service dari facebook yang digunakan untuk menyediakan colom komentar, agar user dapat berkomentar maupun memberikan review.</p>
                                    <p>Facebook Comment harus menggunakan token API dari facebook, dengan cara Anda mendaftar sebagai developer pada facebook. caranya Adalah</p>
                                    <p>
                                    <p>1. Jika sudah memiliki akun facebook, maka silahkan login pada situs developer.facebook.com.
                                    <br>2. buatlah aplikasi sesuai nama toko online Anda, jika berhasil maka copy ID aplikasi Anda kedalam field dashboard ini pada menu widget > facebook comment
                                    </p>
                                </li>
                                <li>4. Order Via WhatsApp
                                    <p>Order vie whatsapp akan tampil pada halaman detail produk, customer dapat langsung menghubungi CS Anda via whatsapp. sebelum menggunakan fitur ini Anda harus menambahkan kontak CS pada menu Custommer Service > Tambah CS. Anda dapat menambahkan berapapun jumlah CS. system akan otomatis merotasi CS ketikan mendapatkan Order.CS yang mendapatkan order terkecil maka System akan meprioritaskan CS tersebut ketika ada customer yang menggukanan widget ini.
                                    </p>
                                </li>
                                <li>5. Tracking > FB Pixel
                                    <p>System ini mendukung penggunaan Pixel. guna untuk retargeting iklan Anda di Facebook. Silahkan edit ID Pixel Anda dan aktifkan widget ini 
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                Design > Unggah Banner</a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                <li>1.Unggah Banner
                                    <p>a. Posisi Image
                                        <ul>
                                            <li>Banner Home Slider
                                                <p> Posisi ini digunakan untuk slider pada halaman home, maksimal Anda di perbolehkan 3 gambar saja.<br>
                                                dengan dimensi ideal 1400x544
                                                </p>
                                            </li>
                                            <li>Feature Add Top
                                                <p> Posisi gambar akan tampil di bawah home slider beserta button yang mengarah ke katalog sesuai kategori yang ada pilih. biasanya gambar ini digunakan untuk menampilkan produk-produk unggulan toko ada atau promo yang sedang berlangsung<br>
                                                dimensi gambar ideal 370x280
                                                </p>
                                            </li>
                                            <li>Feature add Bottom
                                                <p> Posisi gambar akan tampil di atas footer di halaman home. biasanya gambar ini digunakan untuk menampilkan produk-produk unggulan toko ada atau promo yang sedang berlangsung.gambar ini dapat digunakan maupun tidak.<br>
                                                dimensi gambar ideal 370x280
                                                </p>
                                            </li>
                                            <li>Logo Toko
                                                <p>Gambar ini sebagai logo toko Anda, akan tampil dimanapun logo di butuhkan. seperti logo pada tampilan header, invoice, dsb. <br>
                                                dimensi height 50px width 120px
                                                </p>
                                            </li>
                                            <li>Banner Title Page
                                                <p>Gambar ini ditampilkan pada halaman katalog, gambar ini harus Anda isi.<br>
                                                dimensi 975x180
                                                </p>
                                            </li>
                                            <li>Icon Title Website
                                                <p> Gambar ini akan tambil pada tab icon browser
                                                </p>
                                            </li>
                                        </ul>
                                    </p>
                                    <p>b. Urutkan Posisi Banner<br>
                                        Menu ini untuk menentukan posisi gambar Anda, 1, 2 atau 3
                                    </p>
                                    <p>c. Link Banner<br>
                                        <ul>
                                            <li>Logo Toko<br>
                                                Jika Anda mengunggah Logo Toko maka pilihlah link ini.
                                            </li>
                                            <li>Kategori<br>
                                                Jika Anda mengunggah gambar featur add top maka pilihlah link sesuai kategori pada tema gambar Anda, ini akan mengarahkan pada katalog produk sesuai dengan kategori link yang Anda pilih.
                                            </li>
                                        </ul>
                                    </p>
                                    <p>d. Text Banner<br>
                                        Text banner di gunakan untuk home slider, text akan tampil pada home slider. selain home slider Anda dapat melewati atau mengosongkan field ini
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                Design > Footer tag line</a>
                        </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>
                                Anda dapat menambahkan 3 keterangan keunggulan Toko Anda, posisi text ini diatas footer pada halaman Home
                            </p>
                        </div>
                    </div>
                </div>
       
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                Transaksi Offline > Input Transaksi & Data Transaksi</a>
                        </h4>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>
                                Modul ini guna untuk melakukan pembelian via offline, Anda memungkinkan untuk
                                melakukan penjualan langsung ke pembeli tanpa pembeli melakukan pembelian online.
                                <br>
                                <strong>Note :</strong> Inputan data ini menggunakan session, akan terjadi double ketika Anda
                                menginputkan cart pada halaman user dan halaman admin secara bersamaan.
                            </p>
                            <p>
                                <strong>Data Transaksi</strong> Dapat Anda hapus namun akan menghapus data keuangan sesuai dengan id order
                            </p>
                        </div>
                    </div>
                </div>
       
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                Transaksi Online > </a>
                        </h4>
                    </div>
                    <div id="collapse7" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>
                                Transaksi Online adalah transaksi pembelian barang dilakukan oleh pembeli melalui halaman website
                                secara online. Pembeli wajib memiliki akun sebelum melakukan pembelian barang. <br>
                                Pembeli dapat melakukan retur barang, membatalkan pesanan.
                            </p>
                            <p>
                                Anda dapat merestock barang jika invoice juga tidak segera di bayar.
                                <strong>Perhatikan ketika Anda akan melakukan restock barang, cek status order terlebih dahulu.</strong>
                            </p>
                        </div>
                    </div>
                </div>
   
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                                Data Keuangan > </a>
                        </h4>
                    </div>
                    <div id="collapse8" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>
                                Data keuangan ini mencatat transaksi offline maupun online, juga mencatat
                                data retur barang jika pada opsi retur memilih retur pengembalian uang.
                                gunakan filter tanggal awal dan tanggal akhir untuk mengetahui pencatatan keuangan Anda dalam periode tertentu.
                            </p>
                        </div>
                    </div>
                </div>

            </div> 
        </div>
    </div>
</div>