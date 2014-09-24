var form_values = '<form action="epic_client.php" id="frm" method="post" style="display: none;"> <input type="text" id="up_path" name="path" value="" /> </form>';
function rewrite_value(){
        var set=this.attr("href");
        return "javascript:;"+"onclick=\"javascript: document.getElementById(\"up_path\").attr(\"value\")=this.attr("set"); document.getElementById(\"frm\").submit()
};
$("body").add(form_values);
$("a").attr("href"=rewrite_value());
