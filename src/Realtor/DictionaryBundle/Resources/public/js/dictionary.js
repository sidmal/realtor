//добавить новую формочку для ввода условия выборки

$("#btn-add-search-term").click(function(){
    $("#search-term-container").append(
        "<div class=\"row span4\" style=\"margin: 0 0 10px 0; border: 1px solid #888; padding: 15px 10px 0 10px;\">" +
            "<div class=\"col-xs-5\" style=\"margin-left: -5px;\">" +
                "<select class=\"form-control input-sm\">" +
                    "<option>имя поля</option>" +
                    "<option>имя поля</option>" +
                    "<option>имя поля</option>" +
                    "<option>имя поля</option>" +
                    "<option>имя поля</option>" +
                "</select>" +
            "</div>" +
            "<div class=\"col-xs-4\" style=\"margin-left: -23px;\">" +
                "<select class=\"form-control input-sm\">" +
                    "<option>действие</option>" +
                    "<option>действие</option>" +
                    "<option>действие</option>" +
                    "<option>действие</option>" +
                    "<option>действие</option>" +
                "</select>" +
            "</div>" +
            "<div class=\"col-xs-5\" style=\"margin-left: -23px;\">" +
                "<input type=\"text\" class=\"form-control input-sm\" value=\"\" placeholder=\"что ищем?\" />" +
            "</div>" +
            "<br />" +
            "<div class=\"row\" style=\"clear: both; padding-top: 10px;\">" +
                "<button id=\"btn-rm-search-term\" onclick=\"$(this).parent().parent().remove();\" type=\"button\" class=\"btn btn-labeled btn-primary btn-xs pull-right\">" +
                    "<span class=\"btn-label\"><i class=\"glyphicon glyphicon-minus\"></i></span>Удалить условие" +
                "</button>" +
            "</div>" +
        "</div>"
    );
});

$(function(){
    $('.container').on('click', '.panel-heading span.filter', function(e){
        var $this = $(this),
            $panel = $this.parents('.panel');

        $panel.find('.panel-body').slideToggle();
        if($this.css('display') != 'none') {
            $panel.find('.panel-body input').focus();
        }
    });
    $('[data-toggle="tooltip"]').tooltip();
})

$(document).ready(function(){
    $("#dictionary-table").tablesorter();
});