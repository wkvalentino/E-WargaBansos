# <center> Welcome E-WargaBantuan </center>
## <span style="color:lightblue"><center>💸Sistem Informasi Tracking Bansos💸<center>

🌐 <span style="color:orange">Tentang Aplikasi </span>

E-WargaBansos adalah aplikasi berbasis web yang digunakan untuk melakukan tracking dan pengelolaan data warga penerima bantuan sosial (bansos) secara terpusat dan terstruktur. Aplikasi ini dirancang untuk membantu pihak terkait dalam memantau data penerima, proses penyaluran, serta memastikan transparansi dan ketepatan distribusi bantuan. Sistem ini juga mendukung RESTful API sebagai penghubung antar sistem, sehingga memungkinkan integrasi data dan pengelolaan informasi secara fleksibel dan efisien.

💡 <span style="color:orange">Fitur Utama 💡

🔐 Login & autentikasi admin <br>
🔍 Tracking data penerima Bansos <br>
📊 Monitoring penyaluran Bansos <br>
🔥 RESTFULL API (sistem CRUD) <br>

♻️ <span style="color:orange">Teknologi yang Digunakan 

* Frontend : HTML, CSS, JavaScript <br>
* Backend : PHP <br>
* Database : MySQL <br>
* Server : APACHE <br>
* API : RESRTFULL API <br>

🗃️ <span style="color:orange">Struktur Folder

<pre>
📂 E-WargaBansos
    📂API/penerima
        count.php
        penerima.php
    📂Login
        index.html
        proses_login.php
   📂 Pencarian
        dashboard.php
        index.html
        koneksi.php
        laporan.html
</pre>



⚙️ <span style="color:orange">Alur Kerja Sistem 

👥 USER<br>
1. Pengguna membuka aplikasi web melalui browser 
2. Pengguna memasukkan NIK untuk mencari data
3. Web mengirimkan request ke server melalui API
4. API memproses request dan mengakses database
5. Server mengirimkan respon dalam format JSON
6. Web menampilkan data kepada pengguna 

👨‍💻 ADMIN<br>
1. Admin melakukan login ke dalam sistem 
2. Web menampilkan dashboard admin
3. Admin mengelola data (tambah, edit, hapus)
4. Sistem mengirim request ke server melalui API 
5. Server mengembalikan respons ke dashboard admin

📸 <span style="color:orange">Dokumentasi RESTFULL API 
* Base URL<br>
http://localhost/E-WargaBansos/api/penerima
* Endpoint<br>
http://localhost/E-WargaBansos/api/penerima/penerima.php<br>
    http://localhost/E-WargaBansos/api/penerima/count.php
* Contoh Request<br>
http://localhost/E-WargaBansos/api/penerima/penerima.php?nik=3571021401000001
* Contoh Response (JSON)<br>
    ```json
    [
    {
        "id_penerima": "1",
        "nik": "3571021401000001",
        "nama": "Budi Santoso",
        "alamat": "Jalan Setono, gang 5, no. 85",
        "rt": "2",
        "rw": "1",
        "desa_kelurahan": "Ngadirejo",
        "kecamatan": "Ngasem",
        "kabupaten_kota": "Kediri",
        "provinsi": "Jawa Timur",
        "id_penyaluran": "2",
        "id_bansos": "2",
        "nama_bansos": "BPNT (Bantuan Pangan Non Tunai)",
        "periode": "2024",
        "status": "Tersalur",
        "waktu": "2025-12-24 09:06:00",
        "lokasi": "Ngadirejo",
        "status_tracking": "Sudah diterima"
    }
    ]

