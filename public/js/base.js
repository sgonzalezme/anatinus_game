
    $(document).ready(function() {
        $('table').DataTable({
            responsive: true,
            pageLength: 25,
            'order': [[0, 'desc']],
//            "columnDefs": [
//               { "searchable": false, "targets": 3 },
//               { "sortable": false, "targets": 3 }
//             ]
        });
    
        
        // BRANDS
    
	    $('input[name="repetir_pass"], input[name="pass"]' ).on('blur, keyup', function(){
	    	var pass = $('input[name="pass"]').val();
	    	var pass2 = $('input[name="repetir_pass"]').val();
	    	
	    	if(pass.length > 0 && pass2.length > 0 && pass == pass2){
	    		$('._passwords').addClass('has-success');
	    		$('._passwords').removeClass('has-error');
	    		$('button[type="submit"]').prop( "disabled", false );
	    	} else if(pass.length == 0 && pass2.length == 0 ){
	    		$('._passwords').removeClass('has-success');
	    		$('._passwords').removeClass('has-error');
	    		$('button[type="submit"]').prop( "disabled", false );
	    	}else {
	    		$('._passwords').removeClass('has-success');
	    		$('._passwords').addClass('has-error');
	    		$('button[type="submit"]').prop( "disabled", true );
	    	}
	    });
	    
	    // NEW BRAND
	    $('#_imagen').on('change', function(e){
	    	var input = e.target;
	    	var reader = new FileReader();
	    	reader.onload = function(){
	    		var base64 = reader.result;
	    		$('#_preview').attr("src", base64);
	    	};
	    	reader.readAsDataURL(input.files[0]);
	    });
	    
	    
    });
