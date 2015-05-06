
function show_message(message)
{
    $('popup_message').innerHTML = message;
    new Effect.BlindDown('popup_message', {duration: .2});
    //new Effect.SlideDown(element)
    var t = setTimeout("new Effect.BlindUp('popup_message', {duration: .2});", 5000);
}

var ajax_loader = "<div align=\"center\"><img src=\"images/ajax_loader.gif\" /></div>";


function submit_ajax_form(url, fields, onSuccess)
{
    var params = "?";
    for (var i = 0; i < fields.length; i++)
    {
        if (i > 0)
            params += "&";
        params += fields[i] + "="+encodeURIComponent($F(fields[i]));
    }
    new Ajax.Request(url, {
        method: "post",
        parameters: params,
        onSuccess: function(transport) {
            var response = transport.responseText.split(";");

            if (response[0] == "success")
            {
                show_message(response[1]);
                Dialog.closeInfo();
                if (typeof onSuccess == 'function')
                {
                    onSuccess();
                }
            }
            else
            {
                $('form_errors').innerHTML = response[1];
                new Effect.Appear('form_errors');
            }
        }
    });
}