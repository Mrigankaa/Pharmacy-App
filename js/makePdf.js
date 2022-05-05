function makeBill(ReportTitle){
    var name = $('#c_name').val();
    var med_name = [];
    var quantity = [];
    var total = [];

    $("#row #item").each(function(){
        med_name.push($(this).text());
    });

    $("#row #qunatity").each(function(){
        quantity.push($(this).val());
    });

    $("#row #total").each(function(){
        total.push($(this).text());
    });

    var page_content = $.innerHTML;
    var print_content = $("#print_content").innerHTML;
    
    print_content = `<div class='h3 text-center text-primary'>${ReportTitle} Report</div><br><div class='container'><h2>Customer Name: ${name}</h2></div>${print_content}`;

    $.innerHTML = print_content;
        window.print();
    $.innerHTML = page_content;
}