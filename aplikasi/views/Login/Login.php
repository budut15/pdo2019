<div id="container" class="cls-container">

		
		<div id="bg-overlay" class="bg-img" style="background-image: url(<?= base_url('assets')?>/img/bg-img/bg-img-6.jpg);"></div>

		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3">Account Login</h1>
		                <p>Sign In to your account</p>
		            </div>
		           <form id="log" autocomplete="off">
		                <div class="form-group">
		                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus>
		                </div>
		                <div class="form-group">
		                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
		                </div>
		                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
		            </form>
		        </div>
		    </div>
		</div>

		<div class="demo-bg">
		    <div id="demo-bg-list">
		        <div class="demo-loading"><i class="psi-repeat-2"></i></div>
		        <img class="demo-chg-bg bg-trans" src="<?= base_url('assets')?>/img/bg-img/thumbs/bg-trns.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="<?= base_url('assets')?>/img/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="<?= base_url('assets')?>/img/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="<?= base_url('assets')?>/img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="<?= base_url('assets')?>/img/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="<?= base_url('assets')?>/img/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">
		        <img class="demo-chg-bg active" src="<?= base_url('assets')?>/img/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="<?= base_url('assets')?>/img/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">
		    </div>
		</div>

    </div>
	
	<script>
	function csrf(){
			var url=$('meta[name=csrf]').attr("url_public");
			$.get('<?= base_url('ajax/csrf')?>',function(data){
			$('meta[name=csrf]').attr("content",data);
			});
		}
		$(document).ready(function() {
			$("#username").keyup(function(event){
				if(event.keyCode == 13){
					if($("#username").val()!=''){
					$("#password").focus();
					}
				}
			});
			$("#log").submit(function(){
			var user=$("#username").val();
			var pass=$("#password").val();
			if(user==''){
				toastr.error('Username Masih Kosong.', 'GAGAL!!');
				$("#username").focus();
				return false;
			}else if(pass==''){
				//alert("Password Masih Kosong..");
				//toastr.error('Password Masih Kosong.', 'GAGAL!!');
				$("#password").focus();
				return false;
			}
			$.ajax({
				type: "POST",
				dataType:'json',
				url: "<?= base_url('Auth/check_login')?>",
				data:{username:user,password:pass,"<?= $this->security->get_csrf_token_name(); ?>":$('meta[name=csrf]').attr("content")},
				cache: false,
				success: function(result){
					csrf();
					if(result.balas == 1){
						window.location=result.message;
					}else{
						toastr.error(result.message, 'GAGAL!!');
					}
					

				}
			});
			return false;
		});
		});
	</script>
		
