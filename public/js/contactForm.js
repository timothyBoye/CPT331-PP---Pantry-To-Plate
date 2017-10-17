//  Contact Form Submit

$("#contact-form").submit(function(e)
{

    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    console.log("SUBMMMIT", formURL, postData);
    $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR)
            {
                //data: return data from server
                console.log("SUCCESS", data);
                $('#submit-form-contact').fadeOut(1000);
                $('#success').fadeIn(1000);
                // hide the form / fade it out?

                // show the message
                //div.html(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                //if fails
                console.log("FAILED");

                // show the error in a div
            }
        });
    e.preventDefault(); //STOP default action
    //e.unbind(); //unbind. to stop multiple form submit.
})
