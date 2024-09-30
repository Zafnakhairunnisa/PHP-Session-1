<?php
include 'functions.php';
$books = loadBooks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto py-20 px-32">
        <h1 class="text-3xl font-bold mb-6 text-center">Dashboard Perpustakaan</h1>
        <a href="borrow.php" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Pinjam Buku</a>
        <a href="transactions.php" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block ml-2">Lihat
            Transaksi</a>
        <table class="w-full bg-white shadow-md rounded-xl mb-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-indigo-700 font-semibold text-white">ID</th>
                    <th class="py-2 px-4 bg-indigo-700 font-semibold text-white">Judul</th>
                    <th class="py-2 px-4 bg-indigo-700 font-semibold text-white">Penulis</th>
                    <th class="py-2 px-4 bg-indigo-700 font-semibold text-white">Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr class="text-center hover:bg-gray-100 border-b border-gray-200">
                    <td class="py-2 px-4"><?php echo $book['id']; ?></td>
                    <td class="py-2 px-4"><?php echo $book['title']; ?></td>
                    <td class="py-2 px-4"><?php echo $book['author']; ?></td>
                    <td class="py-2 px-4"><?php echo $book['stock']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>