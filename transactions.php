<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transactionId = $_POST['transaction_id'];
    returnBook($transactionId);
}

$transactions = loadTransactions();
$books = loadBooks();

$bookTitles = [];
foreach ($books as $book) {
    $bookTitles[$book['id']] = $book['title'];
}

$activeTransactions = array_filter($transactions, function($transaction) {
    return strtotime($transaction['return_date']) >= strtotime('today');
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto py-20 px-32">
        <h1 class="text-3xl font-bold mb-6 text-center">Transaksi Peminjaman</h1>
        <table class="w-full bg-white shadow-md rounded-xl mb-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-indigo-700 font-semibold text-white">ID</th>
                    <th class="py-2 px-4 bg-indigo-700 font-semibold text-white">Judul Buku</th>
                    <th class="py-2 px-4 bg-indigo-700 font-semibold text-white">Tanggal Pinjam</th>
                    <th class="py-2 px-4 bg-indigo-700 font-semibold text-white">Tanggal Kembali</th>
                    <th class="py-2 px-4 bg-indigo-700 font-semibold text-white">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activeTransactions as $transaction): ?>
                <tr class="text-center hover:bg-gray-100 border-b border-gray-200">
                    <td class="py-2 px-4"><?php echo $transaction['id']; ?></td>
                    <td class="py-2 px-4"><?php echo $bookTitles[$transaction['book_id']] ?? 'Unknown'; ?></td>
                    <td class="py-2 px-4"><?php echo $transaction['borrow_date']; ?></td>
                    <td class="py-2 px-4"><?php echo $transaction['return_date']; ?></td>
                    <td class="py-2 px-4">
                        <form action="transactions.php" method="post">
                            <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
                            <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded">Kembalikan</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">Kembali ke
            Dashboard</a>
    </div>
</body>

</html>