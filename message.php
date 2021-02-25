<?php
//database
$conn = mysqli_connect("localhost", "needyamin", "Yamin143", "chatbot") or die("Database Error");

//catch message ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");

// if user query matched to database query
if(mysqli_num_rows($run_query) > 0){
    $fetch_data = mysqli_fetch_assoc($run_query);
    //storing data replay
    $replay = $fetch_data['replies'];
    echo $replay;

///////// Mycode start
if(isset($replay)){
	$txt=$replay;
	$txt=htmlspecialchars($txt);
	$txt=rawurlencode($txt);
	$html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-IN');
	$player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
	echo $player;
}
//////////////// mycode end


}else{
   echo "Sorry can't be able to understand your question!";

  ///////// Mycode start
    $not_found="Sorry can't be able to understand your question!";
	$txt=$not_found;
	$txt=htmlspecialchars($txt);
	$txt=rawurlencode($txt);
	$html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-IN');
	$player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
	echo $player;
//////////////// mycode end

}

?>
