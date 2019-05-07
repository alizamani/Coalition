
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(".btn-submit").click(function(e){

    e.preventDefault();

    var t = $(this);
    var action = t.closest('form').attr('action');

    $.ajax({
        type:'POST',
        url: action,
        data: t.closest('form').serialize(),
        success:function(data){
            $('#tbody').append("<tr>" +
                "<td>" + data.name + "</td>" +
                "<td>" + data.quantity + "</td>" +
                "<td>$" + new Intl.NumberFormat('en-US', { style: 'decimal' }).format(data.price) + "</td>" +
                "<td>" + data.date + "</td>" +
                "<td>$" + new Intl.NumberFormat('en-US', { style: 'decimal' }).format(data.total) + "</td>" +
                "</tr>");
        }
    });


});