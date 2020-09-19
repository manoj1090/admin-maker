		<script src="<?php echo base_url('assets/theme/js/custom.js'); ?>"></script>
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
		<script src="<?php echo base_url('assets/theme/js/customization.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/bootstrap-notify/bootstrap-notify.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/bootstrap-iconpicker-1.10.0/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
		<input type="hidden" id="userId" value="<?= $this->session->userdata('userData')['id']; ?>">

		<?php $this->load->view('common/modal'); ?>
		<script>
		  $(document).ready(function() {
		    // * type can be success, danger, warning, info 
		    <?php 
		    if(isset($this->session->get_userdata()['alert_msg'])) {
		    ?>
		        $msg = '<?php echo $this->session->get_userdata()['alert_msg']['msg']; ?>';
		        $type = '<?php echo $this->session->get_userdata()['alert_msg']['type']; ?>';
		        mka_alert($type, $msg);
		    <?php 
			  $this->session->unset_userdata('alert_msg');
		    } 
			 
		    ?>

			var controller = '<?php echo $this->router->fetch_class(); ?>';

			//console.log(controller);
			if( controller == 'customize' ) {
				controller = 'projects';
			} 
			$('#menu-' + controller).addClass('active');
		  });
		</script> 
	</body>
</html>