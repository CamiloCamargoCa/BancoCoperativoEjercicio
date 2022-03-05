

    <!-- JavaScript bootstrap -->
    <script src="../../js/jquery-3.4.0.min.js" type="text/javascript"></script>

     <!-- JavaScript bootstrap -->
    <script src="../../plugins/bootstrap-4.3.1-dist/js/bootstrap.min.js" type="text/javascript"></script>
   
	<script type="text/javascript">

		$(document).ready(function() {

			// modal para iniciar sesion
			$('#inisesion').click(function() {
				$('#exampleModalCenter').on('shown.bs.modal', function () {
				  $('#myInput').trigger('focus')
				});
			});

		});

	</script>


	
  </body>

</html>