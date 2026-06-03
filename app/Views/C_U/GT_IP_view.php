<?= $this->extend("layouts/app") ?>

<?= $this->section("content") ?>
<div class="page-heading">
    <!-- validations start -->
    <section id="input-validation">
        <div class="row" align="left">
            <div class="col-1">
            </div>
            <div class="col-1">
                <div class="row">
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">AUTO MACHINE 1</h4>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;">NIK: <?= session()->get("WM_CODE") ?></h5>
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;">FULL NAME: <?= session()->get("WM_NAME") . " " .session()->get("WM_SURNAME") ?></h5>
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;">GROUP: <?= session()->get("GROUP") ?></h5>
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;">SHIFT: <?= session()->get("SHIFT") ?></h5>
                </div>
            </div>
        </div>
        <div class="row" align="center">
            <div class="col-12">
                <div class="row">
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">INPUT GT IPCODE</h4>
                    <div class="col-12">
                        <form action="/worker/get_ip" method="post">
                            <input style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" id="MAT_IP_CODE" name="MAT_IP_CODE" placeholder="MAT_IP_CODE" autofocus required autocomplete="off" maxlength="5">
                            <input type="hidden" name="id" id="id" value="-">
                            <div class="container1"></div>
                        
                            <div class="data"></div>
                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
                        
                        </form>
                    </div>
					
                    <h5 class="card-title" style="font-size: 200%; color: #FFF017;">PLEASE INPUT GT IPCODE</h4>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->
	<script>
		$(document).ready(function(){
			load_data();
			load_id();
			function load_data(keyword)
			{
				$.ajax({
					method:"POST",
					url:"../chIP.php",
					data: {keyword:keyword},
					success:function(hasil)
					{
						if(hasil.length > 0){
							$('.data').html(hasil);
							console.log('Hasil');
							$('form').unbind( 'submit' );
						}else{
							$('.data').html(hasil);
							console.log('Kosong');
							$('form').submit( function(e){
								e.preventDefault();
							});
						}
					}
				});
		 	};
			function load_id(id)
			{
				$.ajax({
					method:"POST",
					url:"../chID.php",
					data: {id:id},
					success:function(hasil)
					{
						if(hasil.length > 0){
							$('.data').html(hasil);
							console.log('ID Hasil');
							$('form').unbind( 'submit' );
						}else{
							$('.data').html(hasil);
							console.log('ID Kosong');
							$('form').submit( function(e){
								e.preventDefault();
							});
						}
					}
				});
		 	};
			function load_reid(id)
			{
				$.ajax({
					method:"POST",
					url:"../reID.php",
					data: {id:id},
					success:function(hasil)
					{
						if(hasil.length > 0){
							$('.data').html(hasil);
							console.log('ID Hasil');
							$('form').unbind( 'submit' );
						}else{
							$('.data').html(hasil);
							console.log('ID Kosong');
							$('form').submit( function(e){
								e.preventDefault();
							});
						}
					}
				});
		 	};
			$('#MAT_IP_CODE').keyup(function(){
	    		var keyword = $("#MAT_IP_CODE").val();
	    		var id = $("#id").val();
                var wrapper = $(".container1");
                if(keyword === 'i'){
                    var element = document.getElementById("id"); // notice the change
                    element.parentNode.removeChild(element);
                    $(wrapper).append('<input style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" name="id" id="id" placeholder="INPUT ID" required autofocus autocomplete="off">'); //add input box
                    $('#id').focus();
                    $('#id').keyup(function(){
                        var id = $("#id").val();
                        load_id(id);
                    });
                }else if(keyword === 'r'){
                    var element = document.getElementById("id"); // notice the change
                    element.parentNode.removeChild(element);
                    $(wrapper).append('<input style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" name="id" id="id" placeholder="INPUT ID" required autofocus autocomplete="off">'); //add input box
                    $('#id').focus();
                    $('#id').keyup(function(){
                        var id = $("#id").val();
                        load_reid(id);
                    });
                }else{
                    var element = document.getElementById("id"); // notice the change
                    element.parentNode.removeChild(element);
                    $(wrapper).append('<input type="hidden" name="id" id="id" value="-">'); //add input box
				    load_data(keyword);
                }
			});
		});
	</script>

</div>
<?= $this->endSection() ?>
