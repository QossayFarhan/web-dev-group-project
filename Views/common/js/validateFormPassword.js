function validatePassword()
{
	var password = document.getElementById('password').value;
	var confirmPassword = document.getElementById('c_password').value;
	if(password != confirmPassword)
	{
		document.getElementById('passwordValidate').style.display = 'inline';
		return false;
	}
	document.getElementById('passwordValidate').style.display = 'none';
	return true;
}