<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Rawat Jalan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background: linear-gradient(90deg, #4f46e5, #3b82f6);
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .modal {
            display: none;
        }

        .modal.active {
            display: flex;
        }
    </style>
</head>

<body>
    <header class="bg-white shadow-md">
        <div class="container mx-auto py-6 px-4">
            <h1 class="text-4xl font-bold text-gray-800 text-center">PRAKTIK MANDIRI DR. LINA SISWANTO</h1>
            <p class="bg-blue-100 text-blue-800 text-2xl font-bold p-4 rounded-lg mt-6 text-center border border-blue-800">FORMULIR ANTRIAN</p>
        </div>
    </header>
    <main>
        <div class="container mx-auto mt-4 px-4">
            <form id="registrationForm" method="post" class="bg-white p-6 rounded-lg shadow-lg mt-6 mb-6 space-y-6" onsubmit="return showConfirmationModal()">
                <div>
                    <label for="name" class="text-gray-700 font-semibold">Nama:</label>
                    <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan Nama Lengkap Anda">
                    <p id="nameError" class="text-red-500 hidden">Nama tidak boleh kosong.</p>
                </div>
                <div>
                    <label for="phone" class="text-gray-700 font-semibold">Telepon:</label>
                    <input type="text" name="phone" id="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="(+62)">
                    <p id="phoneError" class="text-red-500 hidden">Nomor telepon harus dimulai dengan 62 dan hanya berisi angka.</p>
                </div>
                <div>
                    <label for="address" class="text-gray-700 font-semibold">Alamat:</label>
                    <textarea name="address" id="address" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan Alamat Anda"></textarea>
                    <p id="addressError" class="text-red-500 hidden">Alamat tidak boleh kosong.</p>
                </div>
                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-500">DAFTAR</button>
                    <a href="index.html" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500">KEMBALI</a>
                </div>
            </form>

            <!-- Modal Konfirmasi -->
            <div id="confirmationModal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
                <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md space-y-4">
                    <div class="flex justify-center items-center mb-4">
                        <h2 class="bg-red-100 text-red-800 text-2xl font-bold p-4 rounded-lg mt-6 text-center border border-red-800">KONFIRMASI PENDAFTARAN</h2>
                    </div>
                    <p class="text-center mb-4">Apakah data yang anda masukkan sudah benar?</p>
                    <ul class="border border-gray-300 rounded-lg p-4">
                        <li class="flex mb-2">
                            <span class="font-semibold mr-1">Nama:</span>
                            <span id="confirmName"></span>
                        </li>
                        <li class="flex mb-2">
                            <span class="font-semibold mr-1">Nomor Telepon:</span>
                            <span id="confirmPhone"></span>
                        </li>
                        <li class="flex mb-2">
                            <span class="font-semibold mr-1">Alamat:</span>
                            <span id="confirmAddress"></span>
                        </li>
                    </ul>
                    <p class="bg-yellow-100 text-yellow-800 p-4 rounded-lg mt-4 text-center">Apabila Menekan Tombol Konfirmasi Maka Reservasi Tidak Bisa Dibatalkan</p>
                    <div class="flex justify-between mt-6">
                        <button id="confirmSubmit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Konfirmasi</button>
                        <button id="cancelSubmit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Batal</button>
                    </div>
                </div>
            </div>

            <?php if ($registered) : ?>
                <div id="successModal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
                    <div class="bg-white p-8 shadow-lg">
                        <div class="flex items-center mb-4">
                            <h2 class="bg-blue-100 text-blue-800 text-2xl font-bold p-4 rounded-lg mt-6 text-center border border-blue-800 w-full">PRAKTIK MANDIRI DR.LINA SISWANTO</h2>
                        </div>
                        <p class="text-center mb-4">Terima kasih telah mendaftar,</p>
                        <p class="text-center mb-4">Berikut adalah detail pendaftaran Anda:</p>
                        <ul class="border border-gray-300 rounded-lg p-4 mt-4">
                            <li class="flex mb-2">
                                <span class="font-semibold mr-1">Nama:</span>
                                <span><?php echo $details['name']; ?></span>
                            </li>
                            <li class="flex mb-2">
                                <span class="font-semibold mr-1">Nomor Telepon:</span>
                                <span><?php echo $details['phone']; ?></span>
                            </li>
                            <li class="flex mb-2">
                                <span class="font-semibold mr-1">Alamat:</span>
                                <span><?php echo $details['address']; ?></span>
                            </li>
                            <hr class="my-2 border-gray-300"> <!-- Garis pembatas -->
                            <li class="flex mb-2">
                                <span class="font-semibold mr-1">Nomor Antrian:</span>
                                <span><?php echo str_pad($details['queue_number'], 2, '0', STR_PAD_LEFT); ?></span>
                            </li>
                            <li class="flex">
                                <span class="font-semibold mr-1">Jam Kedatangan:</span>
                                <span><?php echo date('H:i', strtotime($details['arrival_time'])); ?></span>
                            </li>
                        </ul>
                        <p class="bg-yellow-100 text-yellow-800 p-4 rounded-lg mt-4 text-center">Silahkan datang pada jam kedatangan yang telah ditentukan dan tunjukkan nomor antrian ini kepada petugas.</p>
                        <div class="flex justify-center mt-6">
                            <button id="closeModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tutup</button>
                        </div>
                    </div>
                </div>
            <?php elseif ($error) : ?>
                <div id="errorModal" class="modal active fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
                    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md text-center">
                        <div class="mb-4">
                            <h2 class="text-2xl font-bold text-red-700">Pendaftaran Gagal</h2>
                        </div>
                        <p class="mb-4"><?php echo $errorMessage; ?></p>
                        <div class="flex justify-center mt-6">
                            <button id="closeErrorModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">OK</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <footer class="bg-white shadow-lg mt-10">
            <div class="container mx-auto py-4 px-4 text-center">
                <p class="text-gray-600 font-semibold">&copy; 2024 Ismi Nur Fitria.</p>
            </div>
        </footer>
    </main>

    <script>
        function showConfirmationModal() {
            var nameInput = document.getElementById('name').value;
            var phoneInput = document.getElementById('phone').value;
            var addressInput = document.getElementById('address').value;

            var phonePattern = /^[0-9]+$/;
            var phoneStartPattern = /^62/;

            var valid = true;

            if (nameInput === '') {
                document.getElementById('nameError').classList.remove('hidden');
                valid = false;
            } else {
                document.getElementById('nameError').classList.add('hidden');
            }

            if (phoneInput === '') {
                document.getElementById('phoneError').textContent = "Nomor telepon tidak boleh kosong.";
                document.getElementById('phoneError').classList.remove('hidden');
                valid = false;
            } else if (!phonePattern.test(phoneInput) || !phoneStartPattern.test(phoneInput)) {
                document.getElementById('phoneError').textContent = "Nomor telepon harus dimulai dengan 62 dan hanya berisi angka.";
                document.getElementById('phoneError').classList.remove('hidden');
                valid = false;
            } else {
                document.getElementById('phoneError').classList.add('hidden');
            }

            if (addressInput === '') {
                document.getElementById('addressError').classList.remove('hidden');
                valid = false;
            } else {
                document.getElementById('addressError').classList.add('hidden');
            }

            if (!valid) {
                return false;
            }

            document.getElementById('confirmName').textContent = nameInput;
            document.getElementById('confirmPhone').textContent = phoneInput;
            document.getElementById('confirmAddress').textContent = addressInput;

            document.getElementById('confirmationModal').classList.add('active');
            return false; // Prevent form submission
        }

        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.remove('active');
            document.getElementById('registrationForm').submit(); // Submit form
        });

        document.getElementById('cancelSubmit').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.remove('active');
        });

        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($registered) : ?>
                document.getElementById('successModal').classList.add('active');
            <?php endif; ?>

            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('successModal').classList.remove('active');
                window.location.href = 'index.html';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($error) : ?>
                document.getElementById('errorModal').classList.add('active');
            <?php endif; ?>

            document.getElementById('closeErrorModal').addEventListener('click', function() {
                document.getElementById('errorModal').classList.remove('active');
            });
        });
    </script>
</body>

</html>