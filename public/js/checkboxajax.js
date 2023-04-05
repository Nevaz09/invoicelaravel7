//checkbox ajax 
$("#chkpilihsemua").click(function(){
    var isChecked = $(this).prop("checked");
    $("#example1 tr:has(td)").find("input[type='checkbox']").prop('checked', isChecked);
});
// ajax hapus semua
$("#example1 tr:has(td)").find("input[type='checkbox']").click(function(){
    var isChecked = $(this).prop("checked");
    var isHeaderChecked = $("#chkpilihsemua").prop("checked");
    if (isChecked===false && isHeaderChecked) {
        $("#chkpilihsemua").prop("checked", isChecked);
    }else{
        $("#example1 tr:has(td)").find("input[type='checkbox']").each(function(){
            if ($(this).prop("checked") === false) {
                isChecked = false;
            }
        });
        $("#chkpilihsemua").prop("checked", isChecked);
    }
});