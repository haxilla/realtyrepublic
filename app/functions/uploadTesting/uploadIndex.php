<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>UPLOADER FORM</title>
      <link rel="stylesheet" href="mycss/uploadTest/uploadTest.css">
   </head>
   <body>
      <form>
         <fieldset>
            <legend>Upload Files</legend>
            <input type="file" id="fileBrowse" name="fileBrowse[]" required multiple>
            <input type="submit" id="submit" name="submit" value="Upload">
         </fieldset>
         <div class="bar">
            <span class="bar-fill" id="barfill">
               <span class="bar-fill-text" id="bartext">
               </span>
            </span>
         </div>
         <div id="uploads" class="uploads">
            Uploaded file links will appear here
         </div>
         <script src="myjs/uploadTest/uploadTest.js">
         </script>

         <script>
            //click event
            document.getElementById('submit').addEventListener('click',function(e){
               e.preventDefault();
               //variables
               var f = document.getElementById('fileBrowse');
               barfill = document.getElementById('barfill');
               bartext = document.getElementById('bartext');
               //app
               app.uploader({
                  theFiles: f,
                  progressBar: barfill,
                  progressTest: bartext,
                  processor: 'upload.php',
                  finished: function(data){
                     console.log(data);
                  }
                  error: function(){
                     console.log('Not Working');
                  }
               });
            });
         </script>
      </form>
   </body>
</html>
