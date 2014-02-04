<!-- admin landing page html, inside body tag-->
		<script>
			var arr = window.location.href.split('?state=');
			if (!!arr[1]){ //if something was passed in after '?state='
				switch(arr[1]){
					case 'max':
						msg='Max Size has been updated';
						break;
					case 'adm':
						msg='Administrative Access has been updated';
						break;
					case 'desc':
						msg='Question Description has been updated';
						break;
					case 'del':
						msg='Tables have been reset';
						break;
					case 'sub':
						msg='Question has been added';
						break;
					default:
						msg='Action has been completed';
						break;
				}
				// alert(arr[1]+" "+msg);
				$('body').append('<p id="notice">'+msg+'</p>');
				$('#notice').fadeOut(5000)
			} else {
				// alert('nothing to report');
			}
		</script>
		<header><h1>Admin Setup for the Pollster Web App</h1></header>
