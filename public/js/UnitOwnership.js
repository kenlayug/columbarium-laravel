$().ready(function(){
    var update = $("#update");
    var initial = update.is(":checked");
    var topics  = $("#update-ownership")[initial ? "removeClass" : "addClass"]("hide");
    var topicsInputs = topic.find("input").attr("disables", !initial);

    update.click(function(){
        topics[this.checked ? "removeClass" : "addClass"]("hide");
        topicsInputs.attr("disabled", !this.checked);
    });
});