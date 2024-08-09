<?php 

function bangWord($text){
	$words = explode(" ", $text);
	$lastWord = array_pop($words);
	$modifiedText = implode(" ", $words);

	//echo "Ostatnie słowo: " . $lastWord . "<br>";
	//echo "Tekst po usunięciu ostatniego słowa: " . $modifiedText;
	return array('last_word' => $lastWord, 'new_text' => $modifiedText);
}

function breakTitlesByNewLine($titlesString) {
    $titlesArray = explode("\n", $titlesString);
    return $titlesArray;
}

function removeFirstWordAndSpace($string) {
	$first_space = strpos($string, ' ');
	if ($first_space !== false) {
	    $string = substr($string, $first_space + 1);
	}
	return $string; 
}

function cleanStr($string){
	$pattern = '/(\d*,?\d+mm)|(\d+,?\d*cm)/';
	$replacement = '';

	$cleaned_string = preg_replace($pattern, $replacement, $string);
	$cleaned_string = preg_replace('/\s*,\s*/', ', ', $cleaned_string);
	$cleaned_string = preg_replace('/,(\s*,)*/', ', ', $cleaned_string);

	return $cleaned_string;
}

function dupRemove($string){
	$words = explode(', ', $string);
	$uniqueWords = array_unique($words);
	$filteredString = implode(', ', $uniqueWords);
	return $filteredString;
}

function removeStringWithCharacter($char, $str){
    $words = explode(" ", $str);
    $filteredWords = array_filter($words, function($word) use ($char){
        return strpos($word, $char) === false;
    });
    return implode(" ", $filteredWords);
}

function endsWithWord($string, $word) {
	$stringArray = explode(" ", $string);
	$lastWord = end($stringArray);
	
	return $lastWord === $word;
}

function removeLastWord($string) {
	$words = explode(" ", $string);
	array_pop($words);
	
	return implode(" ", $words);
}

function checkLastWordIs($string, $checkedWord) {
	$stringArray = explode(" ", $string);
	$lastWord = end($stringArray);
	if($checkedWord == $lastWord){
		return 1;
	}else{
		return 0;
	}
}

function checkLastWordRegex($string, $regex) {
	$stringArray = explode(" ", $string);
	$lastWord = end($stringArray);
	
	return preg_match($regex, $lastWord);
}

function checkRegex($string, $regex) {
    $words = explode(" ", $string);
    foreach ($words as $word) {
        if (preg_match($regex, $word)) {
            return true;
        }
    }
    return false;
}

function countRegex($string, $regex) {
	$count = 0;
    $words = explode(" ", $string);
    foreach ($words as $word) {
        if (preg_match($regex, $word)) {
            $count++;
        }
    }
    return $count;
}

function removeStr($str, $removeStr){
	$result = str_replace($removeStr, "", $str);
	return $result;
}
  
