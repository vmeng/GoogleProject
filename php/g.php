<?php
$fileName = $argv[1]?$argv[1]:'1.flac';
$rate = $argv[2]?$argv[1]:16000;
echo $fileName."---".$rate."\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.google.com/speech-api/v1/recognize?xjerr=1&client=iPhone&lang=en-US&maxresults=1");
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($fileName));
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: audio/x-flac; rate=".$rate));
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