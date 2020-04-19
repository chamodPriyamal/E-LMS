function verifyCaptcha()
{
    var cresponse = grecaptcha.getResponse();
    var request = new XMLHttpRequest();
    request.open("POST","../php/controllers/proxy.php",true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var result = request.responseText;
            return result;
        }
    }
    request.send("response=" + cresponse);
}