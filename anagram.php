<?php

// LLoading the word file from text file into an array
$words = file('english_programming_challenge.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// calling an array to store sorted letter and anagram as values
    $anagramGroups = [];

    // Processing each word in the dictionary
    foreach ($words as $word) {
        // Keeping simple the word by trimming the whitespace and making the word lowercase
        $word = strtolower(trim($word));

        // Sorting the letters of the word alphabetically
        $sortedWord = str_split($word);
        sort($sortedWord);
        $sortedWord = implode('', $sortedWord);

        // Group anagrams together under the sorted letters as the key
        if (!isset($anagramGroups[$sortedWord])) {
            $anagramGroups[$sortedWord] = [];
        }
        $anagramGroups[$sortedWord][] = $word;
    }

    $filteredGroups = array_filter($anagramGroups, function($group) {
        return count($group) > 1;
    });
    
    usort($filteredGroups, function($a, $b) {
        return count($b) - count($a);
    });

    // Display sorted anagram groups and count
echo "Anagram groups from highest to lowest:\n";
$anagramCount = 0;
foreach ($filteredGroups as $group) {
    $anagramCount++;
    echo "Anagrams (" . count($group) . "): " . implode(', ', $group) . PHP_EOL;
}

echo "Total anagram groups found: $anagramCount" . PHP_EOL;
?>