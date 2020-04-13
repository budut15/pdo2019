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
					        <h3 class="panel-title"><?= $json['t_cari']?></h3>
						</div>
					    <div class="panel-body">
						<div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-8 table-toolbar-left">
												<div class="form-group"> 
												<select name="KDPOLY" id="kdpoly" class="selectpicker" required>
                            	<option value=""> Klinik </option>
                                <?php
								
                                $qrypoly = q("SELECT * FROM m_poly where status='0' ORDER BY kode ASC");
                                foreach ($qrypoly as $listpoly) {
                                    ?>
                                <option value="<?php echo $listpoly['kode'];?>" ><?php echo $listpoly['nama'];?></option>
                                    <?php } ?>
                            </select>
							</div>
							<div class="form-group"> 
							<select  name="carabayar" id="carabayar" class="selectpicker" required>
                            	<option value=""> Carabayar </option>
                                <?php
                                $ss = q("select * from m_carabayar where status='0' order by kode desc");
                               foreach ($ss as $ds) {
                                   echo "<option value=".$ds['KODE'].">".$ds['NAMA']."</option>";
								   
								   } ?>
                            </select> 
					                                
					                            </div>
					                            </div>
					                            <div class="col-md-4 table-toolbar-right">
					                               <div class="form-group"> 
					                                 <div id="datarange" class="pull-right" style="background: #fff; cursor: pointer;">
    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
    <span></span> <b class="caret"></b>
</div>                                     
</div>                                     
<input type="hidden" name="tanggal" id="tanggal" value="" class="form-control" />
<input type="hidden" name="tanggal2" id="tanggal2" value="" class="form-control" />
					                                </div>
					                            
					                        </div>
					                    </div>

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
					<div id="view_data"></div>
				
				
				</div>
				</div>
<script>
$(document).ready(function(){
	
var hasil=[$('#NOMR').val(),$('#NAMA').val(),$('#ALAMAT').val(),$('#tanggal').val(),$('#tanggal2').val(),$('#kdpoly').val(),$('#carabayar').val()];
searchWithPagination(1,'Daftar/List_Data_Rajal',hasil);
	
	$('#datarange').on('apply.daterangepicker', function(ev, picker){
		var hasil=[$('#NOMR').val(),$('#NAMA').val(),$('#ALAMAT').val(),$('#tanggal').val(),$('#tanggal2').val(),$('#kdpoly').val(),$('#carabayar').val()];
		searchWithPagination(1,'Daftar/List_Data_Rajal',hasil);
	});	
	$('#btn-search').on('click', function() {
	var hasil=[$('#NOMR').val(),$('#NAMA').val(),$('#ALAMAT').val(),$('#tanggal').val(),$('#tanggal2').val(),$('#kdpoly').val(),$('#carabayar').val()];
	searchWithPagination(1,'Daftar/List_Data_Rajal',hasil);
	});
	
	$('select').on('change', function() {
	var hasil=[$('#NOMR').val(),$('#NAMA').val(),$('#ALAMAT').val(),$('#tanggal').val(),$('#tanggal2').val(),$('#kdpoly').val(),$('#carabayar').val()];
	searchWithPagination(1,'Daftar/List_Data_Rajal',hasil);
	});
	
	$('#NOMR,#NAMA,#ALAMAT').on('keyup', function(e) {
	var hasil=[$('#NOMR').val(),$('#NAMA').val(),$('#ALAMAT').val(),$('#tanggal').val(),$('#tanggal2').val(),$('#kdpoly').val(),$('#carabayar').val()];
	if (e.which == 13) {
		if($(this).val()!=""){
		searchWithPagination(1,'Daftar/List_Data_Rajal',hasil);
		}
	}
});
});
</script>