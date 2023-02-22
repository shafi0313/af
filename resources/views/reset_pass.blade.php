

<table align="center" style="margin: 20px; border: 1px solid green; width: 80%">
	<tr align="center">
		<td>
			<img src="https://ordypremier.net/images/811579334794.png">
		</td>
	</tr>

	<tr align="center">
		<td>
			<h3 style="color: green;">Hello, {{   Session::get('user_name') }}! To reset your password 
				<a style="background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;" href="https://ordypremier.net//password-reset-confirm/{{   Session::get('user_id') }}/{{   Session::get('key') }}"> Click Here </a></h3>
		</td>
	</tr>
</table>