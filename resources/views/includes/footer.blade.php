<!-- Footer -->
   <footer class="footer">
      <div class="text-center">
         <!-- © <?= date('Y'); ?> Copyright -->
         <ul>
            <li>
               <a href="https://www.facebook.com/aslam.cse.ctg" target="_blank">
                  <img src="{{asset('UserPhoto/admin.jpg')}}" alt="No Image" width="50">
               </a>
            </li>
            <li>
               <a href="http://aslambd.ml/" target="_blank">Developer & Designer's All concept By </a><br>
               <a href="https://www.facebook.com/aslam.cse.ctg" target="_blank">Md Aslam Hossain</a>
            </li>
         </ul>
      </div>
   </footer>
   <!-- Footer -->


<!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>
   <script src="{{ asset('js/jquery.min.js') }}" defer></script>
   <script src="{{ asset('js/bootstrap.js') }}" defer></script>

   {{-- add singer --}}
   <script>
      $('#datepicker').datepicker({
         uiLibrary: 'bootstrap'
      });
   </script>

   {{-- Add song --}}

   <script type="text/javascript">
      $(document).ready(function(){
         $('#song_Type_Id').on('change',function(){
            var countryID = $(this).val();
            if(countryID){
               $.ajax({
                  type:'POST',
                  url:'{{ asset('ajax/ajaxData.blade.php') }}',
                  data:'songTypeId='+countryID,
                  success:function(html){
                     $('#singer_Name_Id').html(html);
                  }
               }); 
            }else{
               $('#singer_Name_Id').html('<option value="">Select country first</option>');
            }
         });
      });
   </script>

   <script type="text/javascript">
      window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
          });
      }, 5000);
   </script>

   <script type="text/javascript">
      $(".alert").each(function(){
        var txt =  $(this).text().replace(/\s+/g,' ').trim() ;
        $(this).text(txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase());
      });
   </script>
