<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>

$(document).ready(function(){
    var locale = 2;
    @if(App::getLocale()=="en")
        locale = 1;
    @endif
    
    $.ajax({url: "https://tmp.camagrimarket.org/api/website/report/latest_product_export?locale="+locale, success: function(result){
        $("#daily1").html(result);
        exportTableToCSV("recent_price.csv");
    }});

      function exportTableToCSV(filename) {
        console.log(filename);
    // Export Excel
        var $rows = $('#daily1').find('tr:has(td),tr:has(th)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row), $cols = $row.find('td,th');

                return $cols.map(function (j, col) {
                    var $col = $(col), text = $col.text();

                    return text.replace(/"/g, '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            csvData = "data:text/csv;charset=utf-8,%EF%BB%BF" + encodeURI(csv);
            //console.log(csvData);
            // alert("みどりいろ".toUnicode());
            console.log(csv);

            if (window.navigator.msSaveBlob) { // IE 10+
                //alert('IE' + csv);
                window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/csv;charset=utf-8;"}), "csvname.csv")
            }
            else {
                // console.log($(this));
                $("#xx").attr({ 'download': filename, 'href': csvData, 'target': '_blank' });
                var win = window.open(csvData, '_blank');
                /*
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    alert('Please allow popups for this website');
                }
                */
            }
    }
});
</script>
</head>
<body>
    <a href="#" id="xx" class="pl-2" download="recent_price.csv">ទាញយក <span class="fa fa-file-excel"></span></a>
    <div id="export">
        <div class="row">
            <div class="col-6 col-sm-6 col-xs-12 text-center header">
                <img src="https://tmp.amis.org.kh/assets/img/maff-logo.png" width="100" alt=""><br>
                ក្រសួងកសិកម្ម រុក្ខាប្រមាញ់ និងនេសាទ<br>
                មន្ទីរកសិកម្ម រុក្ខាប្រមាញ់ និងនេសាទ
            </div>
            <div class="col-6 col-sm-6 col-xs-12 text-center header">
                ព្រះរាជាណាចក្រកម្ពុជា<br>
                ជាតិ សាសនា ព្រះមហាក្សត្រ
            </div>
        </div>
        <br>
        <h6 class="font-weight-bold text-center">តារាងព័ត៌មានតម្លៃកសិផលលក់ដុំ</h6>
        <div class="row">
            <div class="col-md-12 col-sm-12  col-xs-12 p-5">
                <table class="table table-striped" id="daily1">
                    
                </table>
            </div>
        </div>
    </div>

</body>
</html>
