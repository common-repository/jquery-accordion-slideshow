function JaS_submit()
{
	if(document.JaS_form.JaS_Gallery.value=="")
	{
		alert(JaS_adminscripts.JaS_Gallery)
		document.JaS_form.JaS_Gallery.focus();
		return false;
	}
	else if(document.JaS_form.JaS_Location.value=="")
	{
		alert(JaS_adminscripts.JaS_Location)
		document.JaS_form.JaS_Location.focus();
		return false;
	}
	else if(document.JaS_form.JaS_timeout.value=="" || isNaN(document.JaS_form.JaS_timeout.value))
	{
		alert(JaS_adminscripts.JaS_timeout)
		document.JaS_form.JaS_timeout.focus();
		document.JaS_form.JaS_timeout.select();
		return false;
	}
	else if(document.JaS_form.JaS_width.value=="" || isNaN(document.JaS_form.JaS_width.value))
	{
		alert(JaS_adminscripts.JaS_width)
		document.JaS_form.JaS_width.focus();
		document.JaS_form.JaS_width.select();
		return false;
	}
	else if(document.JaS_form.JaS_height.value=="" || isNaN(document.JaS_form.JaS_height.value))
	{
		alert(JaS_adminscripts.JaS_height)
		document.JaS_form.JaS_height.focus();
		document.JaS_form.JaS_height.select();
		return false;
	}
	else if(document.JaS_form.JaS_slideWidth.value=="" || isNaN(document.JaS_form.JaS_slideWidth.value))
	{
		alert(JaS_adminscripts.JaS_slideWidth)
		document.JaS_form.JaS_slideWidth.focus();
		document.JaS_form.JaS_slideWidth.select();
		return false;
	}
	else if(document.JaS_form.JaS_slideHeight.value=="" || isNaN(document.JaS_form.JaS_slideHeight.value))
	{
		alert(JaS_adminscripts.JaS_slideHeight)
		document.JaS_form.JaS_slideHeight.focus();
		document.JaS_form.JaS_slideHeight.select();
		return false;
	}
	else if(document.JaS_form.JaS_tabWidth.value=="" || isNaN(document.JaS_form.JaS_tabWidth.value))
	{
		alert(JaS_adminscripts.JaS_tabWidth)
		document.JaS_form.JaS_tabWidth.focus();
		document.JaS_form.JaS_tabWidth.select();
		return false;
	}
	else if(document.JaS_form.JaS_speed.value=="" || isNaN(document.JaS_form.JaS_speed.value))
	{
		alert(JaS_adminscripts.JaS_speed)
		document.JaS_form.JaS_speed.focus();
		document.JaS_form.JaS_speed.select();
		return false;
	}
}

function JaS_delete(id)
{
	if(confirm(JaS_adminscripts.JaS_delete))
	{
		document.frm_JaS_display.action="options-general.php?page=jquery-accordion-slideshow&ac=del&did="+id;
		document.frm_JaS_display.submit();
	}
}	

function JaS_redirect()
{
	window.location = "options-general.php?page=jquery-accordion-slideshow";
}

function JaS_help()
{
	window.open("http://www.gopiplus.com/work/2011/12/21/jquery-accordion-slideshow-wordpress-plugin/");
}