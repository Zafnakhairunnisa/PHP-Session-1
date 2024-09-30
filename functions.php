<?php
function loadBooks() {
    $booksFile = 'books.json';
    if (file_exists($booksFile)) {
        $booksJson = file_get_contents($booksFile);
        return json_decode($booksJson, true);
    }
    return [];
}

function saveBooks($books) {
    $booksFile = 'books.json';
    $booksJson = json_encode($books, JSON_PRETTY_PRINT);
    file_put_contents($booksFile, $booksJson);
}

function loadTransactions() {
    $transactionsFile = 'transactions.json';
    if (file_exists($transactionsFile)) {
        $transactionsJson = file_get_contents($transactionsFile);
        return json_decode($transactionsJson, true);
    }
    return [];
}

function saveTransactions($transactions) {
    $transactionsFile = 'transactions.json';
    $transactionsJson = json_encode($transactions, JSON_PRETTY_PRINT);
    file_put_contents($transactionsFile, $transactionsJson);
}

function borrowBook($bookId) {
    $books = loadBooks();
    $transactions = loadTransactions();

    foreach ($books as &$book) {
        if ($book['id'] == $bookId && $book['stock'] > 0) {
            $book['stock']--;
            $borrowDate = date('Y-m-d');
            $returnDate = date('Y-m-d', strtotime('+7 days'));
            $transaction = [
                'id' => uniqid(),
                'book_id' => $bookId,
                'borrow_date' => $borrowDate,
                'return_date' => $returnDate
            ];
            $transactions[] = $transaction;
            
            saveBooks($books);
            saveTransactions($transactions);
            return true;
        }
    }
    return false;
}

function returnBook($transactionId) {
    $books = loadBooks();
    $transactions = loadTransactions();

    foreach ($transactions as &$transaction) {
        if ($transaction['id'] == $transactionId) {
            foreach ($books as &$book) {
                if ($book['id'] == $transaction['book_id']) {
                    $book['stock']++;
                    break;
                }
            }
            
            $transactions = array_filter($transactions, function($t) use ($transactionId) {
                return $t['id'] != $transactionId;
            });
            
            saveBooks($books);
            saveTransactions($transactions);
            return true;
        }
    }
    return false;
}
?>