</div>
<footer id="footer">
            
            <div class="hide-fixed pull-right pad-rgt">
                <strong>Version</strong> <?= $about['VERSION']?>
            </div>
            <p class="pad-lft">&#0169; 2019 Personal Development Budut Komputer Copyright &copy; 2019 All rights reserved.</p>
  </footer>

 <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
 </div>

<div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Modal Heading</h4>
                </div>

                <!--Modal body-->
                <div class="modal-body">
                    <p class="text-semibold text-main">Bootstrap Modal Vertical Alignment Center</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                    <br>
                    <p class="text-semibold text-main">Popover in a modal</p>
                    <p>This
                        <button class="btn btn-sm btn-warning demo-modal-popover add-popover" data-toggle="popover" data-trigger="focus" data-content="And here's some amazing content. It's very engaging. right?" data-original-title="Popover Title">button</button>
                        should trigger a popover on click.
                    </p>
                    <br>
                    <p class="text-semibold text-main">Tooltips in a modal</p>
                    <p>
                        <a class="btn-link text-bold add-tooltip" href="#" data-original-title="Tooltip">This link</a> and
                        <a class="btn-link text-bold add-tooltip" href="#" data-original-title="Tooltip">that link</a> should have tooltips on hover.
                    </p>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

 
<div class="modal fade " data-backdrop="static" data-keyboard="true"  id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content sn-bg-4">
        <div class="modal-header primary-color white-text">
            <h4 class="title">
                <i class="fa fa-pencil-alt"></i> Login Form</h4>
            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="md-form form-sm">
                <i class="fa fa-envelope prefix"></i>
                <input type="text" id="user" autocomplete='off' class="form-control form-control-sm">
                <label for="user">Username</label>
            </div>

            <!-- Material input email -->
            <div class="md-form form-sm">
                <i class="fa fa-lock prefix"></i>
                <input type="password" id="pass" class="form-control form-control-sm">
                <label for="pass">Password</label>
            </div>

            <div class="text-center mt-4 mb-2">
                <button class="btn btn-primary" data-loading-text="Loading..." id="saveLogin" ><i class="fas fa-paper-plane"></i> Send
                </button>
				
            </div>

        </div>
    </div>
</div>
</div>



<script src="<?= base_url('assets')?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets')?>/js/nifty.min.js"></script>
    <script src="<?= base_url('assets')?>/js/demo/nifty-demo.min.js"></script>
    <script src="<?= base_url('assets')?>/js/demo/dashboard.js"></script>
	<script src="<?= base_url('assets')?>/plugins/toastr-master/build/toastr.min.js"></script>
	<script src="<?= base_url('assets')?>/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="<?= base_url('assets')?>/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="<?= base_url('assets')?>/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="<?= base_url('assets')?>/plugins/noUiSlider/nouislider.min.js"></script>
    <script src="<?= base_url('assets')?>/plugins/select2/js/select2.min.js"></script>
    <script src="<?= base_url('assets')?>/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?= base_url('assets')?>/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

</body>
</html>