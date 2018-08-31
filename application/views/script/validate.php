<script type="text/javascript">
		$(document).ready(function(){

			$('#form-user').on('submit',function(){
				$('#form-user').validate({
			        rules: {
			            name: {
			                required: true
			            },
			            email: {
			                required: true
			            }
			        },
			        invalidHandler: function(event, validator) {
			            var errors = validator.numberOfInvalids(); // <- NUMBER OF INVALIDS
			            console.log(errors);
			        },
			        submitHandler: function(f) {
				      	// f.submit();
				    },
				    showErrors: function(errorMap, errorList) {
			            var errors = this.numberOfInvalids(); // <- NUMBER OF INVALIDS

			            console.log(errorMap);
			            $.each(errorMap, function(key, value) {
			                console.log(key);
							var parent = $('[name="' + key + '"]').parent();
							console.log(parent);
			            });

			            this.defaultShowErrors(); // <- ENABLE default MESSAGES
			        }
			    });
			    return false;
			});
		});		
</script>