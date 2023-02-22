<table align="center" style="margin: 20px; border: 1px solid green; width: 80%">
	<tr align="center">
	    @php
	     $basic_info   =  DB::table('basic_info_manages')->where('id',1)->first();
	    @endphp
		<td>
			<img src="{{ asset( 'images/'.$basic_info->logo) }}">
		</td>
	</tr>
	<tr align="center">
		<td>
			<h3 style="color: green;">User Feed Back From Website https://kab-bd.com</h3> 
			<br>	
			<span>Name : {{   Session::get('user_name') }} </span><br>
			<span>Email : {{   Session::get('email') }} </span><br>
			<span>Phone : {{   Session::get('number') }} </span><br>
			<span>Messege : {{   Session::get('message') }} </span>
			</h3>
		</td>
	</tr>
</table>