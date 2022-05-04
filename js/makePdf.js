function makeBill(ReportTitle){
    // var name = document.getElementById('c_name').value;

    var page_content = $.innerHTML;
    var print_content = $("#print_content").innerHTML;
    
    var print_content = "<div class='h3 text-center text-primary'>" + ReportTitle + " Report</div><br>" + print_content;

    $.innerHTML = print_content;
    window.print();
    $.innerHTML = page_content;
}