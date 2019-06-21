<?php
//a function that takes in a string and a list of words to censor
function word_filter($text, $wordlist){
  $state=0;
  $edited_text=$text;
  foreach($wordlist as $word){
    $substate = 0;
    //creates an array containing all the prefixes
    $prefix=[0];
    for($i=1; $i<strlen($word); $i++){
      if($word[$i]==$word[$substate]){
        $substate += 1;
      } else {
        $substate = 0;
      }
      array_push($prefix, $substate);
    }
    for($letter=0; $letter<strlen($edited_text); $letter++){
      //checks if the letter matches the letter of a forbidden word
      if(strtolower($text[$letter])!=strtolower($word[$state])){
        if($state!=0){
          $state=$prefix[$state-1];
        }
      }
      if(strtolower($text[$letter])==strtolower($word[$state])){
        //updates the state
        $state=$state+1;
      //checks if the word is found
        if($state==strlen($word)){
          $edited_text=substr($edited_text, 0, $letter-strlen($word)+1 ) . str_repeat("*", strlen($word)) . substr($edited_text, $letter+1);
          $state = 0;
        }
      }
    }
  }
  //returns the edited string
  return $edited_text;
}

?>
