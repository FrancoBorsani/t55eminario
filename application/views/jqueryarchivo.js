$(function(){
    $('#submit-buttons').click(function(){
        $( "#result" ).load( "<?php echo base_url('Welcome/index')?>" );
    })
})