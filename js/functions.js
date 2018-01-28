function displayError(){

        $("div.form-group").addClass("has-error");
        $("div.alert").show("slow").delay(4000).hide("slow");
        return false;
};