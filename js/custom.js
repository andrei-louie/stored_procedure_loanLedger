jQuery(document).ready(function(){
     $("body").on("click", "#print_pdf", function () {
        var tbody = $("#tbl_members tbody");
        if (tbody.children().length > 0) {
            html2canvas($('#tbl_members')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Loan Ledger Report.pdf");
                }
            });
        } else {
            alert("You don't have any data to be print!");
          }
      });
    jQuery('.date-own').datepicker({
        minViewMode: 2,
        format: 'yyyy'
    });

    let form = $("#form_members"),
        tbody_data = $("#responseData");
    form.on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: 'inc/getmemberloantransaction.php',
            data: {
                'q': 'get-loans',
                'member_id': $("#memberList").val(),
                'fiscal_year': $("#fiscal_year").val(),
            },
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data)
                tbody_data.html("");
                $.each(data, function (i, row) {
                    tbody_data.append(`<tr>
                        <td>`+row['memberid']+`</td>
                        <td>`+row['transdate']+`</td>
                        <td>`+row['loan']+`</td>
                        <td>`+row['payment']+`</td>
                        <td>`+row['balance']+`</td>
                        </tr>`);
                });
            },
            error: function (e) {
                console.warn(e);
            }
        })
    });
    $('#memberList').on('change',function(e){
        e.preventDefault();
        var data = $(this).serialize();
       $.ajax({
             url: 'inc/getmemberloantransaction.php',
             data: {
                'views':'get-membername',
                'member_id': $("#memberList").val(),
            },
            type: 'POST',
            dataType: 'json',
             success: function(data) {
                 console.log(data)
                $("#showMembername").html("");
                $.each(data, function(i,rows) {
                    $("#showMembername").append('<h3 class="getFullname">'+rows["membername"]+'</h3>');
                });
             },
             error: function (e) {
                console.warn(e);
            }
        });
    });
});