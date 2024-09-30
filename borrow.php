<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['book_id'];
    if (borrowBook($bookId)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Gagal meminjam buku. Stok mungkin habis.";
    }
}

$books = loadBooks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto py-20 px-32">
        <h1 class="text-3xl font-bold mb-6 text-center">Pinjam Buku</h1>
        <?php if (isset($error)): ?>
        <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="borrow.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="book_id">
                    Pilih Buku
                </label>
                <select name="book_id" id="book_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php foreach ($books as $book): ?>
                    <option value="<?php echo $book['id']; ?>"><?php echo $book['title']; ?> (Stok:
                        <?php echo $book['stock']; ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Pinjam
                </button>
            </div>
        </form>
        <a href="dashboard.php" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">Kembali ke
            Dashboard</a>
    </div>
</body>

</html>