<?php

$resultText = ""; // Initialize an empty result string

// Check if the file was uploaded
if (isset($_POST['submit'])) {
    // Read the uploaded file
    $file = $_FILES['dictionary']['tmp_name'];
    $words = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Initialize an associative array to store sorted letters as keys and anagrams as values
    $anagramGroups = [];

    // Process each word in the dictionary
    foreach ($words as $word) {
        // Normalize the word by trimming whitespace and converting to lowercase
        $word = strtolower(trim($word));

        // Sort the letters of the word alphabetically
        $sortedWord = str_split($word);
        sort($sortedWord);
        $sortedWord = implode('', $sortedWord);

        // Group anagrams together under the sorted letters as the key
        if (!isset($anagramGroups[$sortedWord])) {
            $anagramGroups[$sortedWord] = [];
        }
        $anagramGroups[$sortedWord][] = $word;
    }

    // Filter and sort the anagram groups
    // change the count number to check the anagram. for better responding i have written this >5
    $filteredGroups = array_filter($anagramGroups, function($group) {
        return count($group) > 2;
    });
    
    usort($filteredGroups, function($a, $b) {
        return count($b) - count($a);
    });

    // Now we will Store results in $resultText which we created at the beginning of the code
    foreach ($filteredGroups as $group) {
        $resultText .= "Anagrams (" . count($group) . "): " . implode(', ', $group) . "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Abdullah Awwal, php Web Developer" name="keywords">
    <title>Anagram Finder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Upload Dictionary File</h1>
        <form id="uploadForm" method="POST" enctype="multipart/form-data">
            <input type="file" name="dictionary" accept=".txt" required>
            <button type="submit" name="submit">Find Anagrams</button>
        </form>
        <div class="loader" id="loader"></div>
    </div>

    <div class="result" id="resultDiv">
        <h1>Anagram group from highest to lowest </h1>
        <p class="anagramresult" id="anagramResult">
            <?php echo $resultText; ?>
        </p>
    </div>

    

    <script src="advance.js"></script>
</body>
</html>