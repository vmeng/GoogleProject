<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.google.com/speech-api/v1/recognize?xjerr=1&client=iPhone&lang=en-US&maxresults=1");
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('1.flac'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: audio/x-flac; rate=16000"));
$data = curl_exec($ch);
echo $data;
curl_close($ch);
if ($data=json_decode($data,true)) {
 echo "<ul>";
 foreach($data['hypotheses'] as $i) echo "<li>".$i['utterance']."</li>";
 echo "</ul>";
} else {
 echo "<i>error</i>";
 
}
?>