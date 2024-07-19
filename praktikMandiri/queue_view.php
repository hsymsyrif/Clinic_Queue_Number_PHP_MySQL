<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg, #4f46e5, #3b82f6);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <header class="bg-white shadow-md">
        <div class="container mx-auto py-6 px-4">
            <h1 class="text-4xl font-bold text-gray-800 text-center">PRAKTIK MANDIRI DR. LINA SISWANTO</h1>
            <p class="bg-blue-100 text-blue-800 text-2xl font-bold p-4 rounded-lg mt-6 text-center border border-blue-800">DAFTAR ANTRIAN HARI INI (<?php echo date('d-m-Y'); ?>)</p>
        </div>
    </header>
    <div class="container mx-auto mt-5 px-4 flex-grow">
        <div class="mt-6">
            <table class="table-auto w-full bg-white rounded-lg shadow-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Nomor Antrian</th>
                        <th class="px-4 py-2">Nama Pasien</th>
                        <th class="px-4 py-2">Jam Kedatangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr class="bg-gray-100 border-b">
                            <td class="px-4 py-2 text-center"><?php echo str_pad($row['queue_number'], 2, '0', STR_PAD_LEFT); ?></td>
                            <td class="px-4 py-2 text-center"><?php echo $row['name']; ?></td>
                            <td class="px-4 py-2 text-center"><?php echo date('H:i', strtotime($row['arrival_time'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-6 text-right">
            <a href="index.html" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500">KEMBALI</a>
        </div>
    </div>
    <footer class="bg-white shadow-lg">
        <div class="container mx-auto py-4 px-4 text-center">
            <p class="text-gray-600 font-semibold">&copy; 2024 Ismi Nur Fitria.</p>
        </div>
    </footer>
</body>

</html>