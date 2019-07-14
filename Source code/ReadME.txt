List program client-side

- SABSFaceDetection.py			= Mengambil gambar dan mengirimkan gambar tersebut jika terdeteksi ada wajah



List program server-side

Website

- autoimage.php 			= Auto-refresh pada halaman user-interface client

- autoimageadmin.php			= Auto-refresh pada halaman admin

- deskripsi.php				= Real-time running text pada halaman user-interface client

- index.php				= Halaman utama user-interface client

- admin/index.php			= Halaman utama admin

- dir direktoriiklan			= folder yang berisi konten iklan


Backend

- FaceDatasetCreator.py			= Mengambil wajah yang ingin ditraining untuk dikenali

- trainner.py				= Training wajah pada dataset

- rec.py				= Mengambil gambar yang dikirim client untuk dikenali, dan ditulis di file final.txt

- extracthadoop.py			= Program analisa data berdasarkan final.txt hasilnya dikirim ke client

- final.txt				= hasil analisis gambar yang dikirim client akan ditulis disini

- haarcascade_frontalface_alt.xml	= fitur pada OpenCV yang digunakan untuk mendeteksi wajah

- dir currentFace			= Folder tempat gambar yang dikirim client disimpan

- dir dataset				= Folder tempat hasil FaceDatasetCreator.py disimpan

- dir filerecognizer			= Folder tempat hasil trainner.py disimpan
