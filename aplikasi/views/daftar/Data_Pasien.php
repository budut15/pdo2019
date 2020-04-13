 <div id="content-container">
				 <div id="page-head">
                    <div id="page-title">
                        <h1 class="page-header text-overflow"><?= $title?></h1>
                    </div>
                    <ol class="breadcrumb">
					<li><a href="<?= base_url('Dashboard')?>"><i class="demo-pli-home"></i></a></li>
					<li><?= $this->uri->segment(1)?></li>
					<li class="active"><a href="<?= base_url($this->uri->segment(1)."/".$this->uri->segment(2))?>"><?= $title?></a></li>
                    </ol>
                </div>				
                <div id="page-content">
					<div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title"><?= $json['t_cari']?>
							</h3>
					    </div>
					    <div class="panel-body">
					       <div class="row">                                    
									                                  
                                        <div class="col-md-2">
										<div class="form-group">  
                                            <input type="search" placeholder="<?= $json['rm']?>" autocomplete='off' value='' id='NOMR'  class="form-control"/>
                                        </div>                                         
                                        </div>                                         
                                        <div class="col-md-5">
										<div class="form-group">  
                                            <input type="search" value='' id='NAMA' autocomplete='off' placeholder="<?= $json['nama']?>" class="form-control"/>
                                        </div>   
                                        </div>   
                                        <div class="col-md-5">
										<div class="input-group">
                                            <input type="search" value='' id='ALAMAT' autocomplete='off' placeholder="<?= $json['alamat']?>" class="form-control"/>
											<span class="input-group-btn">
											<button class="btn btn-info" type="button" id="btn-search"><?= $json['cari']?></button>
											</span>
                                        </div>                                      
                                        </div>                                                                                                                                   
                                  
                                    </div>
						</div>
					</div>
					<div class="panel">
					<div class="panel-body">
					<div class="table-responsive">
					<div class="view_data">
					Data
					</div>
					</div>
					</div>
					</div>
				
				
				</div>
				</div>
				
				<script>
$(document).ready(function(){
	
var hasil=[$('#NOMR').val(),$('#NAMA').val(),$('#ALAMAT').val()];
searchWithPagination(1,'Daftar/List_Data_Pasien',hasil);

$('#btn-search').on('click', function() {
var hasil=[$('#NOMR').val(),$('#NAMA').val(),$('#ALAMAT').val()];
searchWithPagination(1,'Daftar/List_Data_Pasien',hasil);
});

$('#NOMR,#NAMA,#ALAMAT').on('keyup', function(e) {
	var hasil=[$('#NOMR').val(),$('#NAMA').val(),$('#ALAMAT').val()];
	if (e.which == 13) {
		if($(this).val()!=""){
		searchWithPagination(1,'Daftar/List_Data_Pasien',hasil);
		}
	}
});
});
</script>