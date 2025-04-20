<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <title>TTS Demo</title>
  </head>
  <body>
    <input id="text"><button onclick="say();">Parler</button><br>
    <audio controls id="tts">
  </body>
  <script>
  
  function say() {
    text = document.getElementById('text').value;
    document.getElementById('tts').src = "/judy/tts.php?t=" + btoa(text);
    document.getElementById('tts').play();
  }
  
  </script>
</html>
