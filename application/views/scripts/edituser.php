<script type="text/javascript">
	$('#samepassword').click(function(){
    if($(this).is(':checked')){
        $("input[type=password]").each(function(){
        	this.setAttribute('disabled','disabled');
        })
    } else {
        $("input[type=password]").each(function(){
        	this.removeAttribute('disabled');
        })
    }
});
</script>